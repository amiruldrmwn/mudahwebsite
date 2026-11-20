<?php

namespace Tests\Feature;

use App\Models\MediaMeta;
use App\Models\Page;
use App\Models\User;
use App\Sections\DefaultContent;
use App\Support\Site;
use App\Support\SiteImages;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MediaTest extends TestCase
{
    use RefreshDatabase;

    private const SVG = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10" onload="alert(1)"><script>alert(2)</script><circle cx="5" cy="5" r="4" fill="red"/><image href="https://evil.test/x.png"/></svg>';

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    /** A noisy photo, so it compresses like a real one. */
    private function photo(string $name, int $width, int $height, string $type = 'jpg'): UploadedFile
    {
        $image = imagecreatetruecolor($width, $height);

        for ($i = 0; $i < 4000; $i++) {
            imagefilledellipse($image, random_int(0, $width), random_int(0, $height), 40, 40, random_int(0, 0xFFFFFF));
        }

        ob_start();
        $type === 'png' ? imagepng($image) : imagejpeg($image, null, 95);

        return UploadedFile::fake()->createWithContent($name, (string) ob_get_clean());
    }

    public function test_guests_cannot_open_the_library()
    {
        $this->get(route('media.index'))->assertRedirect(route('login'));
        $this->postJson(route('media.store'))->assertUnauthorized();
    }

    public function test_large_photos_are_shrunk_and_saved_as_webp()
    {
        $path = $this->actingAs(User::factory()->create())
            ->postJson(route('media.store'), ['file' => $this->photo('Foto Toko (1).JPG', 3000, 2000)])
            ->assertOk()->json('path');

        $this->assertMatchesRegularExpression('#^media/foto-toko-1-[a-z0-9]{6}\.webp$#', $path);
        [$width, $height, $type] = getimagesize(Storage::disk('public')->path($path));
        $this->assertSame([1920, 1280, IMAGETYPE_WEBP], [$width, $height, $type]);
    }

    public function test_svgs_are_cleaned_of_scripts_and_outside_references()
    {
        $path = $this->actingAs(User::factory()->create())
            ->postJson(route('media.store'), ['file' => UploadedFile::fake()->createWithContent('ikon.svg', self::SVG)])
            ->assertOk()->json('path');

        $this->assertStringEndsWith('.svg', $path);
        $svg = Storage::disk('public')->get($path);
        $this->assertStringContainsString('<circle', $svg);
        $this->assertStringNotContainsString('script', $svg);
        $this->assertStringNotContainsString('onload', $svg);
        $this->assertStringNotContainsString('evil.test', $svg);
    }

    public function test_broken_svgs_and_other_files_are_refused()
    {
        $this->actingAs(User::factory()->create());

        $this->postJson(route('media.store'), ['file' => UploadedFile::fake()->createWithContent('a.svg', '<svg><unclosed')])->assertUnprocessable();
        $this->postJson(route('media.store'), ['file' => UploadedFile::fake()->create('a.pdf')])->assertUnprocessable();
    }

    public function test_the_library_lists_images_with_where_they_are_used()
    {
        $this->actingAs(User::factory()->create());
        $used = $this->postJson(route('media.store'), ['file' => $this->photo('hero.jpg', 800, 600)])->json('path');
        $spare = $this->postJson(route('media.store'), ['file' => $this->photo('lain.jpg', 800, 600)])->json('path');
        Page::query()->create(['title' => 'Beranda', 'slug' => 'beranda', 'sections' => [['id' => 'a', 'type' => 'hero', 'data' => ['image' => $used]]]]);

        $media = collect($this->getJson(route('media.index'))->assertOk()->json('media'))->keyBy('path');

        $this->assertSame('Beranda', $media[$used]['used_in'][0]['label']);
        $this->assertStringEndsWith('/admin/pages/'.Page::where('slug', 'beranda')->value('id'), $media[$used]['used_in'][0]['href']);
        $this->assertSame([], $media[$spare]['used_in']);
        $this->assertSame(800, $media[$spare]['width']);
        $this->get(route('media.index'))->assertInertia(fn ($page) => $page->component('media/Index')->has('media', 2));
    }

    public function test_only_unused_library_images_can_be_deleted()
    {
        $this->actingAs(User::factory()->create());
        $used = $this->postJson(route('media.store'), ['file' => $this->photo('hero.jpg', 400, 300)])->json('path');
        $spare = $this->postJson(route('media.store'), ['file' => $this->photo('lain.jpg', 400, 300)])->json('path');
        Page::query()->create(['title' => 'Layanan', 'slug' => 'layanan', 'sections' => [['id' => 'a', 'type' => 'services', 'data' => ['items' => [['image' => $used]]]]]]);
        Storage::disk('public')->put('site/logo.png', 'x');

        $this->postJson(route('media.destroy'), ['path' => $used])->assertUnprocessable()->assertJsonPath('errors.path.0', fn ($m) => str_contains($m, 'Layanan'));
        $this->postJson(route('media.destroy'), ['path' => $spare])->assertOk();
        $this->postJson(route('media.destroy'), ['path' => 'site/logo.png'])->assertNotFound();
        $this->postJson(route('media.destroy'), ['path' => 'media/../site/logo.png'])->assertNotFound();

        Storage::disk('public')->assertExists([$used, 'site/logo.png']);
        Storage::disk('public')->assertMissing($spare);
    }

    public function test_svg_logos_are_accepted_and_cleaned_and_png_logos_stay_png()
    {
        $user = User::factory()->create();
        $settings = ['site_name' => 'PT Maju', 'primary_color' => '#112233'];

        $this->actingAs($user)->post(route('site.update'), [...$settings, 'logo' => UploadedFile::fake()->createWithContent('logo.svg', self::SVG)])->assertSessionHasNoErrors();
        $svg = Storage::disk('public')->get(app(Site::class)->get('logo'));
        $this->assertStringNotContainsString('script', $svg);

        $this->post(route('site.update'), [...$settings, 'logo' => $this->photo('logo.png', 2400, 800, 'png')])->assertSessionHasNoErrors();
        $logo = app(Site::class)->get('logo');
        $this->assertStringEndsWith('.png', $logo);
        $this->assertSame([1024, 341], array_slice(getimagesize(Storage::disk('public')->path($logo)), 0, 2));
    }

    public function test_replacing_a_file_updates_every_page_and_the_logo()
    {
        $this->actingAs(User::factory()->create());
        $old = $this->postJson(route('media.store'), ['file' => $this->photo('lama.jpg', 400, 300)])->json('path');
        $page = Page::query()->create(['title' => 'Galeri', 'slug' => 'galeri', 'sections' => [['id' => 'a', 'type' => 'gallery', 'data' => ['items' => [['image' => $old], ['image' => 'demo/x.jpg']]]]]]);
        app(Site::class)->put(['logo' => $old]);
        MediaMeta::query()->create(['path' => $old, 'alt' => 'Toko kami']);

        $new = $this->postJson(route('media.replace'), ['path' => $old, 'file' => $this->photo('baru.png', 300, 200, 'png')])->assertOk()->json('path');

        $this->assertStringStartsWith('media/baru-', $new);
        $this->assertSame([$new, 'demo/x.jpg'], array_column($page->fresh()->sections[0]['data']['items'], 'image'));
        $this->assertSame($new, app(Site::class)->get('logo'));
        $this->assertSame('Toko kami', MediaMeta::query()->find($new)?->alt);
        $this->assertNull(MediaMeta::query()->find($old));
        Storage::disk('public')->assertMissing($old);
        Storage::disk('public')->assertExists($new);
        $this->postJson(route('media.replace'), ['path' => 'demo/x.jpg', 'file' => $this->photo('b.jpg', 10, 10)])->assertNotFound();
    }

    public function test_descriptions_are_saved_and_listed()
    {
        $this->actingAs(User::factory()->create());
        $path = $this->postJson(route('media.store'), ['file' => $this->photo('foto.jpg', 100, 100)])->json('path');

        $this->postJson(route('media.describe'), ['path' => $path, 'alt' => '  Ruang tunggu klinik  '])->assertOk();

        $this->assertSame('Ruang tunggu klinik', MediaMeta::query()->find($path)?->alt);
        $this->assertSame('Ruang tunggu klinik', $this->getJson(route('media.index'))->json('media.0.alt'));
        $this->postJson(route('media.describe'), ['path' => 'media/../.env', 'alt' => 'x'])->assertNotFound();
    }

    public function test_section_images_load_lazily_after_the_first_section_and_get_alt_text()
    {
        MediaMeta::query()->create(['path' => 'media/toko-abc123.webp', 'alt' => 'Depan toko "Maju"']);
        SiteImages::flush();
        $html = '<img src="/storage/media/toko-abc123.webp" alt="" class="a"><img src="/storage/media/servis-hp-x1y2z3.webp" alt=""><img src="/storage/media/IMG_2024-q1w2e3.jpg" alt=""><img src="/storage/demo/a.jpg" alt="Judul" loading="eager">';

        $first = SiteImages::section($html, 0);
        $later = SiteImages::section($html, 2);

        $this->assertStringContainsString('fetchpriority="high" src="/storage/media/toko-abc123.webp"', $first);
        $this->assertSame(1, substr_count($first, 'fetchpriority'));
        $this->assertStringNotContainsString('loading="lazy"', $first);
        $this->assertSame(3, substr_count($later, 'loading="lazy"'));
        $this->assertStringContainsString('loading="eager"', $later);
        $this->assertStringContainsString('alt="Depan toko &quot;Maju&quot;"', $later);
        $this->assertStringContainsString('alt="Servis hp"', $later);
        $this->assertStringContainsString('IMG_2024-q1w2e3.jpg" alt=""', $later);
        $this->assertStringContainsString('alt="Judul"', $later);
        $this->assertSame(4, substr_count($later, 'decoding="async"'));
    }

    public function test_the_live_site_renders_with_finished_images()
    {
        DefaultContent::install('PT Maju');

        $this->get('/')->assertOk()->assertSee('decoding="async"', false)->assertSee('loading="lazy"', false);
    }

    public function test_a_logo_can_be_picked_from_the_library()
    {
        $this->actingAs(User::factory()->create());
        $settings = ['site_name' => 'PT Maju', 'primary_color' => '#112233'];
        $this->post(route('site.update'), [...$settings, 'logo' => $this->photo('logo.png', 300, 100, 'png')]);
        $uploaded = app(Site::class)->get('logo');
        $library = $this->postJson(route('media.store'), ['file' => $this->photo('logo-baru.jpg', 300, 100)])->json('path');

        $this->post(route('site.update'), [...$settings, 'logo_path' => $library])->assertSessionHasNoErrors();
        $this->assertSame($library, app(Site::class)->get('logo'));
        Storage::disk('public')->assertMissing($uploaded);

        // Replacing a library logo with an upload keeps the library image.
        $this->post(route('site.update'), [...$settings, 'logo' => $this->photo('lagi.png', 300, 100, 'png')]);
        Storage::disk('public')->assertExists($library);

        // A path outside the library is ignored.
        $this->post(route('site.update'), [...$settings, 'logo_path' => '../.env'])->assertSessionHasNoErrors();
        $this->assertStringStartsWith('site/', app(Site::class)->get('logo'));
    }
}
