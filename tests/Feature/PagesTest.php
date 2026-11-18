<?php

namespace Tests\Feature;

use App\Models\Message;
use App\Models\Page;
use App\Models\User;
use App\Sections\DefaultContent;
use App\Sections\SectionTypes;
use App\Support\Site;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        DefaultContent::install('PT Uji Coba');
    }

    public function test_default_pages_render_in_every_theme()
    {
        foreach (['korporat', 'modern', 'minimalis'] as $theme) {
            app(Site::class)->put(['theme' => $theme]);

            $this->get('/')->assertOk()->assertSee('Solusi profesional untuk pertumbuhan bisnis Anda')->assertSee("theme-{$theme}", false)->assertSee('/storage/demo/hero-tower.jpg', false);
            $this->get('/tentang')->assertOk()->assertSee('Mengenal lebih dekat PT Uji Coba')->assertSee('Hendra Gunawan');
            $this->get('/layanan')->assertOk()->assertSee('Alur Kerja Sama');
            $this->get('/proyek')->assertOk()->assertSee('Galeri Proyek');
            $this->get('/kontak')->assertOk()->assertSee('Kirim Pesan');
        }
    }

    public function test_home_slug_and_drafts_are_not_public()
    {
        $this->get('/beranda')->assertNotFound();
        $this->get('/tidak-ada')->assertNotFound();

        Page::where('slug', 'tentang')->update(['published' => false]);
        $this->get('/tentang')->assertNotFound();
        $this->actingAs(User::factory()->create())->get('/tentang')->assertOk();
    }

    public function test_contact_form_keeps_the_message()
    {
        $this->from('/kontak')->post(route('contact.send'), [
            'name' => 'Andi', 'email' => 'andi@example.com', 'body' => 'Minta penawaran.',
        ])->assertRedirect('/kontak')->assertSessionHas('contact_sent');

        $this->assertSame('Minta penawaran.', Message::sole()->body);
    }

    public function test_contact_form_drops_bots()
    {
        $this->post(route('contact.send'), [
            'name' => 'Bot', 'email' => 'bot@example.com', 'body' => 'spam', 'website' => 'http://spam.test',
        ])->assertSessionHas('contact_sent');

        $this->assertSame(0, Message::count());
    }

    public function test_sections_are_cleaned()
    {
        $clean = SectionTypes::clean(['type' => 'hero', 'data' => [
            'title' => '  Halo  ',
            'button_url' => 'javascript:alert(1)',
            'image' => '../../etc/passwd',
            'unknown' => 'x',
        ]]);

        $this->assertSame('Halo', $clean['data']['title']);
        $this->assertSame('', $clean['data']['button_url']);
        $this->assertSame('', $clean['data']['image']);
        $this->assertArrayNotHasKey('unknown', $clean['data']);
        $this->assertNull(SectionTypes::clean(['type' => 'script']));
    }

    public function test_markdown_html_is_stripped()
    {
        $page = Page::where('slug', 'tentang')->first();
        $page->update(['sections' => [SectionTypes::clean(['type' => 'text', 'data' => ['body' => "Halo <script>alert(1)</script>\n\n**tebal**"]])]]);

        $this->get('/tentang')->assertOk()->assertDontSee('<script>alert(1)</script>', false)->assertSee('<strong>tebal</strong>', false);
    }

    public function test_admin_can_create_edit_reorder_and_delete_pages()
    {
        $this->actingAs(User::factory()->create());

        $this->post(route('pages.store'), ['title' => 'Produk Kami'])->assertRedirect();
        $page = Page::where('slug', 'produk-kami')->firstOrFail();

        $this->put(route('pages.update', $page), [
            'title' => 'Produk',
            'slug' => 'produk',
            'in_menu' => true,
            'published' => true,
            'sections' => [['id' => 'a1', 'type' => 'cta', 'data' => ['title' => 'Hubungi kami', 'button_url' => '/kontak']]],
        ])->assertRedirect(route('pages.edit', $page));

        $page->refresh();
        $this->assertSame('produk', $page->slug);
        $this->assertSame('Hubungi kami', $page->sections[0]['data']['title']);
        $this->get('/produk')->assertOk()->assertSee('Hubungi kami');

        $ids = Page::orderByDesc('position')->pluck('id')->all();
        $this->post(route('pages.reorder'), ['ids' => $ids]);
        $this->assertSame($page->id, Page::menu()->first()->id);

        $this->delete(route('pages.destroy', $page))->assertRedirect(route('pages.index'));
        $this->assertModelMissing($page);
    }

    public function test_reserved_and_duplicate_slugs_are_rejected()
    {
        $this->actingAs(User::factory()->create());
        $page = Page::where('slug', 'tentang')->first();

        foreach (['admin', 'kontak', 'Huruf Besar'] as $slug) {
            $this->put(route('pages.update', $page), ['title' => 'X', 'slug' => $slug, 'sections' => []])->assertSessionHasErrors('slug');
        }
    }

    public function test_home_page_cannot_be_deleted_and_can_be_moved()
    {
        $this->actingAs(User::factory()->create());
        $home = Page::where('is_home', true)->first();
        $about = Page::where('slug', 'tentang')->first();

        $this->delete(route('pages.destroy', $home));
        $this->assertModelExists($home);

        $this->post(route('pages.home', $about));
        $this->assertTrue($about->fresh()->is_home);
        $this->assertFalse($home->fresh()->is_home);
        $this->get('/')->assertSee('Perjalanan Kami');
    }

    public function test_theme_can_be_changed()
    {
        $this->actingAs(User::factory()->create())->put(route('themes.update'), ['theme' => 'modern']);
        $this->get('/')->assertSee('theme-modern', false);

        $this->put(route('themes.update'), ['theme' => 'tidak-ada'])->assertSessionHasErrors('theme');
    }

    public function test_spa_and_cake_templates_show_their_own_sample_pages()
    {
        Storage::fake('public');

        foreach (['spa' => ['Daftar Perawatan', 'Rp250.000', '/perawatan', 'demo/spa-hero.jpg'], 'kue' => ['Produk Favorit', 'Rp235.000', '/menu', 'demo/cake-hero.jpg']] as $theme => [$heading, $price, $slug, $photo]) {
            DefaultContent::install('Toko Uji', preset: $theme);
            Storage::disk('public')->assertExists($photo);

            app(Site::class)->put(['theme' => $theme]);
            $this->get('/')->assertOk()->assertSee("theme-{$theme}", false)->assertSee($heading)->assertSee($price);
            $this->get($slug)->assertOk();
            $this->get('/proyek')->assertNotFound();
        }
    }

    public function test_price_list_order_buttons_open_whatsapp()
    {
        DefaultContent::install('Toko Uji', replace: true, preset: 'kue');
        app(Site::class)->put(['whatsapp' => '0812 3456 789', 'theme' => 'kue']);

        $this->get('/')->assertSee('https://wa.me/628123456789?text='.rawurlencode('Halo, saya ingin memesan Black Forest'), false);
    }

    public function test_pages_follow_the_template_and_come_back_when_switching_back()
    {
        $this->actingAs(User::factory()->create());
        Page::where('slug', 'tentang')->update(['title' => 'Profil Kami']);
        app(Site::class)->put(['primary_color' => '#ff0000']);

        // Same group: same pages, same colour.
        $this->put(route('themes.update'), ['theme' => 'modern'])->assertSessionHasNoErrors();
        $this->get('/tentang')->assertOk()->assertSee('Profil Kami');
        $this->assertSame('#ff0000', app(Site::class)->get('primary_color'));

        // Another group: its own sample pages and colour.
        $this->put(route('themes.update'), ['theme' => 'spa']);
        $this->get('/')->assertSee('theme-spa', false)->assertSee('Ruang tenang untuk tubuh dan pikiran');
        $this->get('/perawatan')->assertOk();
        $this->get('/proyek')->assertNotFound();
        $this->assertSame('#c9a45c', app(Site::class)->get('primary_color'));
        $this->get(route('pages.index'))->assertInertia(fn ($page) => $page->has('pages', 5)->where('pages.2.slug', 'perawatan'));

        // Edits and slugs are per group.
        Page::where('slug', 'tentang')->update(['title' => 'Tentang Spa']);
        app(Site::class)->put(['primary_color' => '#aa8844']);

        // Back: the earlier pages and colour return untouched.
        $this->put(route('themes.update'), ['theme' => 'minimalis']);
        $this->get('/tentang')->assertSee('Profil Kami')->assertDontSee('Tentang Spa');
        $this->get('/perawatan')->assertNotFound();
        $this->assertSame('#ff0000', app(Site::class)->get('primary_color'));

        $this->put(route('themes.update'), ['theme' => 'spa']);
        $this->get('/tentang')->assertSee('Tentang Spa');
        $this->assertSame('#aa8844', app(Site::class)->get('primary_color'));
    }

    public function test_a_template_group_can_start_over_from_its_sample()
    {
        $this->actingAs(User::factory()->create());
        Page::where('slug', 'tentang')->update(['title' => 'Profil Kami']);

        $this->put(route('themes.update'), ['theme' => 'korporat', 'reset' => true]);
        $this->get('/tentang')->assertDontSee('Profil Kami')->assertSee('Mengenal lebih dekat');
    }

    public function test_template_sample_preview_is_for_admins_and_saves_nothing()
    {
        $this->get('/?preview_sample=kue')->assertSee('Solusi profesional untuk pertumbuhan bisnis Anda');

        $this->actingAs(User::factory()->create())->get('/?preview_sample=kue')
            ->assertOk()->assertSee('theme-kue', false)->assertSee('Kue cokelat premium untuk setiap momen manis')->assertSee('--brand: #5b3423', false);
        $this->assertFalse(Page::where('slug', 'menu')->exists());
    }

    public function test_images_can_be_uploaded()
    {
        Storage::fake('public');

        $response = $this->actingAs(User::factory()->create())
            ->postJson(route('media.store'), ['file' => UploadedFile::fake()->image('foto.jpg')])
            ->assertOk();

        Storage::disk('public')->assertExists($response->json('path'));
        $this->postJson(route('media.store'), ['file' => UploadedFile::fake()->create('a.pdf')])->assertUnprocessable();
    }

    public function test_sample_photos_are_copied_and_pages_can_start_over()
    {
        Storage::fake('public');
        Page::query()->delete();

        DefaultContent::install('PT Baru');
        Storage::disk('public')->assertExists('demo/team-1.jpg');
        $this->assertSame(5, Page::count());

        Page::where('slug', 'proyek')->delete();
        $this->assertFalse(DefaultContent::install('PT Baru'));
        $this->assertTrue(DefaultContent::install('PT Baru', replace: true));
        $this->assertSame(5, Page::count());
    }

    public function test_new_sites_get_a_sample_logo_until_the_owner_uploads_one()
    {
        $site = app(Site::class);
        $this->assertSame(DefaultContent::LOGO, $site->get('logo'));
        $this->get('/')->assertSee('fill: var(--brand)', false)->assertSee('/storage/demo/client-wijaya-group.svg', false);

        // The dashboard still asks for a real logo.
        $this->actingAs(User::factory()->create())->get(route('dashboard'))
            ->assertInertia(fn ($p) => $p->where('checklist.0.done', false));

        // An uploaded logo is shown as it is, and a later install keeps it.
        $site->put(['logo' => 'site/punya-saya.png']);
        $this->get('/')->assertSee('/storage/site/punya-saya.png', false);
        DefaultContent::install('PT Uji Coba', replace: true);
        $this->assertSame('site/punya-saya.png', app(Site::class)->get('logo'));
    }

    public function test_sitemap_lists_published_pages()
    {
        $this->get('/sitemap.xml')->assertOk()->assertSee(url('/kontak'));
    }
}
