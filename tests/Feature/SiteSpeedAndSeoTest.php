<?php

namespace Tests\Feature;

use App\Models\Page;
use App\Models\User;
use App\Sections\DefaultContent;
use App\Support\ImageSizes;
use App\Support\PageCache;
use App\Support\Site;
use App\Support\SiteImages;
use App\Support\StructuredData;
use App\Support\Themes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SiteSpeedAndSeoTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
        DefaultContent::install('PT Maju');
    }

    /** @return list<array<string, mixed>> */
    private function jsonLd(string $html): array
    {
        preg_match_all('#<script type="application/ld\+json">(.*?)</script>#s', $html, $m);

        return array_map(fn (string $json) => json_decode($json, true, flags: JSON_THROW_ON_ERROR), $m[1]);
    }

    public function test_pages_describe_the_business_to_google()
    {
        app(Site::class)->put(['theme' => 'klinik', 'address' => "Jl. Merdeka 1\nBandung", 'contact_phone' => '022-123', 'social_instagram' => 'https://instagram.com/maju', 'site_name' => 'Klinik </script><script>alert(1)</script>']);
        DefaultContent::install('Klinik Maju', true, Themes::all()['klinik']['preset']);

        $home = $this->get('/')->assertOk()->getContent();
        $this->assertStringNotContainsString('<script>alert(1)', $home);
        $blocks = collect($this->jsonLd($home))->keyBy('@type');

        $this->assertSame('Jl. Merdeka 1, Bandung', $blocks['MedicalClinic']['address']['streetAddress']);
        $this->assertSame(['https://instagram.com/maju'], $blocks['MedicalClinic']['sameAs']);
        $this->assertSame('Klinik </script><script>alert(1)</script>', $blocks['MedicalClinic']['name']);
        $this->assertArrayHasKey('WebSite', $blocks->all());

        $faq = Page::query()->get()->first(fn (Page $p) => collect($p->sections)->contains('type', 'faq'));
        $inner = collect($this->jsonLd($this->get('/'.$faq->slug)->getContent()))->keyBy('@type');
        $this->assertSame($faq->title, $inner['BreadcrumbList']['itemListElement'][1]['name']);
        $this->assertNotEmpty($inner['FAQPage']['mainEntity'][0]['acceptedAnswer']['text']);
    }

    public function test_template_types_and_demos()
    {
        $this->assertSame('Bakery', StructuredData::typeOf('kue'));
        $this->assertSame('GovernmentOrganization', StructuredData::typeOf('instansi'));
        $this->assertSame('Person', StructuredData::typeOf('cv'));
        $this->assertSame('Organization', StructuredData::typeOf('korporat'));

        config(['compro.demo' => true]);
        $this->assertSame([], $this->jsonLd($this->get('/?tema=kue')->getContent()));
    }

    public function test_analytics_and_pixels_are_added_from_their_ids()
    {
        $admin = User::factory()->create();
        $settings = ['site_name' => 'PT Maju', 'primary_color' => '#112233'];

        $this->actingAs($admin)->post(route('site.update'), [...$settings, 'ga_id' => '<script>'])->assertSessionHasErrors('ga_id');
        $this->post(route('site.update'), [...$settings, 'ga_id' => ' g-abc123xyz ', 'meta_pixel_id' => '123456789012345', 'tiktok_pixel_id' => 'cabc1234567890', 'gtm_id' => 'gtm-k9x8z7'])->assertSessionHasNoErrors();
        $this->assertSame('G-ABC123XYZ', app(Site::class)->get('ga_id'));

        // Admins don't count themselves.
        $this->get('/')->assertDontSee('googletagmanager.com/gtag', false);

        $this->post(route('logout'));
        $this->get('/')
            ->assertSee('gtag/js?id=G-ABC123XYZ', false)
            ->assertSee("fbq('init',\"123456789012345\")", false)
            ->assertSee('ttq.load("CABC1234567890")', false)
            ->assertSee("'dataLayer',\"GTM-K9X8Z7\"", false);
    }

    public function test_visitors_get_a_cached_page_that_any_admin_change_refreshes()
    {
        $page = Page::query()->where('is_home', true)->firstOrFail();
        $title = $page->sections[0]['data']['title'];
        $this->get('/')->assertSee($title, false);

        // Changed behind the site's back (no model events): visitors still get the kept page.
        $sections = $page->sections;
        $sections[0]['data']['title'] = 'Judul Baru Sekali';
        Page::query()->whereKey($page->id)->update(['sections' => json_encode($sections)]);
        $this->get('/')->assertDontSee('Judul Baru Sekali');

        // Any save in the admin starts a new version.
        $this->actingAs(User::factory()->create())->post(route('pages.reorder'), ['ids' => Page::query()->pluck('id')->all()]);
        $this->post(route('logout'));
        $this->get('/')->assertSee('Judul Baru Sekali');
    }

    public function test_each_visitor_gets_their_own_form_token_from_a_cached_page()
    {
        $first = $this->get('/kontak')->getContent();
        $this->flushSession();
        $second = $this->get('/kontak')->getContent();

        preg_match('/name="_token"[^>]*value="([^"]+)"/', $first, $a);
        preg_match('/name="_token"[^>]*value="([^"]+)"/', $second, $b);
        $this->assertNotEmpty($a[1] ?? null);
        $this->assertNotSame($a[1], $b[1] ?? null);
        $this->assertSame(session()->token(), $b[1]);
        $this->assertStringNotContainsString('__compro_csrf__', $second);
    }

    public function test_photos_get_smaller_copies_offered_in_srcset()
    {
        $image = imagecreatetruecolor(2000, 1000);
        ob_start();
        imagejpeg($image);
        $path = $this->actingAs(User::factory()->create())
            ->postJson(route('media.store'), ['file' => UploadedFile::fake()->createWithContent('toko.jpg', (string) ob_get_clean())])
            ->json('path');

        foreach (ImageSizes::WIDTHS as $width) {
            Storage::disk('public')->assertExists("sizes/{$width}/{$path}.webp");
        }

        $html = SiteImages::section('<img src="/storage/'.$path.'" alt="">', 1);
        $this->assertStringContainsString('480w', $html);
        $this->assertStringContainsString('/storage/'.$path.' 1920w', $html);
        $this->assertStringContainsString('sizes="100vw"', $html);

        // The library list stays the same, and deleting removes the copies.
        $this->assertCount(1, $this->getJson(route('media.index'))->json('media'));
        $this->postJson(route('media.destroy'), ['path' => $path])->assertOk();
        Storage::disk('public')->assertMissing("sizes/480/{$path}.webp");
    }

    public function test_the_command_makes_copies_for_photos_the_pages_use()
    {
        $photo = Page::query()->get()->flatMap(fn (Page $p) => collect($p->sections)->pluck('data.image'))->first(fn ($i) => is_string($i) && str_ends_with($i, '.jpg'));

        $this->artisan('compro:image-sizes')->assertSuccessful();

        Storage::disk('public')->assertExists("sizes/480/{$photo}.webp");
        $this->assertNotNull(ImageSizes::srcset($photo));
    }

    public function test_fonts_are_served_by_the_site_once_fetched()
    {
        $css = public_path('fonts/korporat.css');
        $kept = is_file($css) ? (string) file_get_contents($css) : null;
        File::delete($css);
        $this->get('/')->assertSee('fonts.bunny.net/css', false);

        File::ensureDirectoryExists(dirname($css));
        File::put($css, "@font-face { font-family: 'Inter'; src: url(/fonts/files/inter.woff2) format('woff2'); }");

        try {
            PageCache::flush();
            $this->get('/')->assertSee('src: url(/fonts/files/inter.woff2)', false)->assertDontSee('fonts.bunny.net', false);
        } finally {
            $kept === null ? File::delete($css) : File::put($css, $kept);
        }
    }
}
