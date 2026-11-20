<?php

namespace Tests\Feature;

use App\Mail\NewContactMessage;
use App\Models\Message;
use App\Models\Page;
use App\Models\User;
use App\Sections\DefaultContent;
use App\Sections\SectionTypes;
use App\Support\Site;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
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

    public function test_contact_form_emails_the_owner_with_reply_to_the_visitor()
    {
        Mail::fake();
        app(Site::class)->put(['contact_email' => 'owner@maju.test']);

        $this->post(route('contact.send'), ['name' => 'Andi', 'email' => 'andi@example.com', 'body' => 'Minta penawaran.']);

        Mail::assertSent(NewContactMessage::class, fn (NewContactMessage $mail) => $mail->hasTo('owner@maju.test') && $mail->hasReplyTo('andi@example.com'));
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

    public function test_school_template_has_its_pages_logo_and_news()
    {
        $this->actingAs(User::factory()->create());

        $this->put(route('themes.update'), ['theme' => 'sekolah']);
        $site = app(Site::class);
        $this->assertSame('demo/logo-sd.png', $site->get('logo'));
        $this->assertSame('#b3261e', $site->get('primary_color'));

        $this->get('/')->assertOk()->assertSee('theme-sekolah', false)->assertSee('<em>gembira</em>', false)
            ->assertSee('/storage/demo/logo-sd.png', false)->assertSee('Juara 1 Olimpiade Matematika tingkat kota')->assertSee('Daftar SPMB');
        foreach (['tentang', 'program', 'fasilitas', 'guru', 'berita', 'spmb', 'kontak'] as $slug) {
            $this->get("/{$slug}")->assertOk();
        }

        // Back to a corporate template: its own sample logo returns; an uploaded logo would stay.
        $this->put(route('themes.update'), ['theme' => 'korporat']);
        $this->assertSame(DefaultContent::LOGO, $site->get('logo'));

        $site->put(['logo' => 'site/logo-saya.png']);
        $this->put(route('themes.update'), ['theme' => 'sekolah']);
        $this->assertSame('site/logo-saya.png', $site->get('logo'));
    }

    public function test_high_school_template_has_its_pages_and_logo()
    {
        $this->actingAs(User::factory()->create());

        $this->put(route('themes.update'), ['theme' => 'sma']);
        $this->assertSame('demo/logo-osis.png', app(Site::class)->get('logo'));

        $this->get('/')->assertOk()->assertSee('theme-sma', false)->assertSee('<em>siap</em>', false)
            ->assertSee('Daftar PPDB')->assertSee('sma-dark', false)->assertSee('Siswa kami raih medali emas');
        foreach (['profil', 'program', 'fasilitas', 'berita', 'ppdb', 'kontak'] as $slug) {
            $this->get("/{$slug}")->assertOk();
        }
    }

    public function test_umroh_template_shows_packages_with_whatsapp_detail()
    {
        $this->actingAs(User::factory()->create());
        app(Site::class)->put(['whatsapp' => '0812 3456 789']);

        $this->put(route('themes.update'), ['theme' => 'umroh']);

        $this->get('/')->assertOk()->assertSee('theme-umroh', false)->assertSee('Umroh Signature 9 Hari')->assertSee('Garuda Indonesia')
            ->assertSee('Madinah: Pullman Madinah')->assertSee('Rp39.500.000')
            ->assertSee('https://wa.me/628123456789?text='.rawurlencode('Halo, saya tertarik dengan paket Umroh Reguler 9 Hari keberangkatan 19 Nov'), false);
        foreach (['paket', 'haji', 'jadwal', 'faq', 'kontak'] as $slug) {
            $this->get("/{$slug}")->assertOk();
        }
    }

    public function test_ac_service_template_has_its_pages_and_emergency_bar()
    {
        $this->actingAs(User::factory()->create());
        app(Site::class)->put(['whatsapp' => '0812 3456 789']);

        $this->put(route('themes.update'), ['theme' => 'ac']);

        $this->get('/')->assertOk()->assertSee('theme-ac', false)->assertSee('AC mati mendadak?')
            ->assertSee('Ruangan sejuk lagi, tanpa tunggu lama.')->assertSee('Rp75.000')->assertSee('Panggil Teknisi');
        foreach (['layanan', 'harga', 'tentang', 'kontak'] as $slug) {
            $this->get("/{$slug}")->assertOk();
        }
    }

    public function test_legal_template_shows_plans_and_check_lists()
    {
        $this->actingAs(User::factory()->create());
        app(Site::class)->put(['whatsapp' => '0812 3456 789']);

        $this->put(route('themes.update'), ['theme' => 'legal']);

        $this->get('/')->assertOk()->assertSee('theme-legal', false)->assertSee('<mark>cepat</mark>', false)
            ->assertSee('Paling Populer')->assertSee('Rp3,95jt')->assertSee('NIB &amp; akun OSS RBA', false)
            ->assertSee('https://wa.me/628123456789?text='.rawurlencode('Halo, saya tertarik dengan paket Lengkap'), false);
        $this->get('/pendirian-cv')->assertOk()->assertSee('card-check', false)->assertSee('KTP &amp; NPWP minimal 2 sekutu', false);
        foreach (['layanan', 'tentang', 'kontak'] as $slug) {
            $this->get("/{$slug}")->assertOk();
        }
    }

    public function test_coffee_and_barber_templates_have_their_pages()
    {
        $this->actingAs(User::factory()->create());

        $this->put(route('themes.update'), ['theme' => 'kopi']);
        $this->get('/')->assertOk()->assertSee('theme-kopi', false)->assertSee('kopi-marquee', false)->assertSee('Es Kopi Susu Aren');
        foreach (['menu', 'tentang', 'gerai', 'kontak'] as $slug) {
            $this->get("/{$slug}")->assertOk();
        }

        $this->put(route('themes.update'), ['theme' => 'barber']);
        $this->get('/')->assertOk()->assertSee('theme-barber', false)->assertSee('barber-pole', false)->assertSee('Sharp cut. Fresh look.')->assertSee('75K');
        foreach (['harga', 'tentang', 'galeri', 'kontak'] as $slug) {
            $this->get("/{$slug}")->assertOk();
        }
    }

    public function test_mining_template_has_its_pages_and_metric_panel()
    {
        $this->actingAs(User::factory()->create());

        $this->put(route('themes.update'), ['theme' => 'tambang']);
        $this->get('/')->assertOk()->assertSee('theme-tambang', false)->assertSee('mine-hazard', false)
            ->assertSee('Energi untuk negeri, tanggung jawab untuk bumi')->assertSee('42,5 MT')->assertSee('-mt-14', false);
        foreach (['tentang', 'operasi', 'keberlanjutan', 'berita', 'kontak'] as $slug) {
            $this->get("/{$slug}")->assertOk();
        }
        // The metric panel overlaps only the banner right above it.
        Page::where('slug', 'keberlanjutan')->first()->update(['sections' => array_reverse(Page::where('slug', 'keberlanjutan')->first()->sections)]);
        $this->get('/keberlanjutan')->assertDontSee('-mt-14', false);
    }

    public function test_seven_business_templates_render_all_their_pages()
    {
        $this->actingAs(User::factory()->create());
        app(Site::class)->put(['whatsapp' => '0812 3456 789']);

        $expect = [
            'rental' => ['Toyota Avanza / Xenia', ['armada', 'layanan', 'kontak']],
            'motor' => ['Yamaha NMAX', ['motor', 'syarat', 'kontak']],
            'properti' => ['Tipe Melati 45/90', ['tipe-rumah', 'fasilitas', 'kontak']],
            'resto' => ['Ayam Bakar Madu', ['menu', 'tentang', 'kontak']],
            'gigi' => ['Senyum sehat, percaya diri setiap hari', ['layanan', 'jadwal', 'kontak']],
            'kecantikan' => ['<em>cantik</em>', ['treatment', 'tentang', 'kontak']],
            'villa' => ['Pool Villa', ['kamar', 'fasilitas', 'kontak']],
            'hijab' => ['<em>kesederhanaan</em>', ['koleksi', 'lookbook', 'tentang', 'kontak']],
            'kaos' => ['<em>custom</em>', ['produk', 'custom', 'tentang', 'kontak']],
            'mobil' => ['Mobil impian, cicilan ringan', ['pricelist', 'kredit', 'service', 'kontak']],
            'biolink' => ['link-row', ['kelas', 'kontak']],
            'biolink2' => ['bl2-pill', ['kontak']],
            'laundry' => ['<em>bersih wangi</em>', ['harga', 'tentang', 'kontak']],
            'catering' => ['<em>rumahan</em>', ['menu', 'galeri', 'kontak']],
            'bengkel' => ['<em>jujur</em>', ['layanan', 'galeri', 'booking']],
            'foto' => ['<em>layak</em>', ['portofolio', 'paket', 'kontak']],
            'wedding' => ['<em>tanpa</em>', ['paket', 'galeri', 'kontak']],
            'bimbel' => ['<em>seru</em>', ['program', 'galeri', 'daftar']],
            'apotek' => ['<em>tepat</em>', ['produk', 'layanan', 'kontak']],
            'petshop' => ['<em>bahagia</em>', ['layanan', 'galeri', 'booking']],
            'sepatu' => ['<em>kinclong</em>', ['layanan', 'tentang', 'kontak']],
            'lawfirm' => ['<em>bisnis</em>', ['bidang-praktik', 'tim', 'tentang', 'kontak']],
            'pesantren' => ['<em>Qur&#039;ani</em>', ['profil', 'program', 'pendaftaran', 'kontak']],
            'cleaning' => ['<em>bersih dan wangi</em>', ['layanan', 'tentang', 'kontak']],
            'satpam' => ['<em>aman</em>', ['layanan', 'tentang', 'kontak']],
            'biolink3' => ['bl3-card', ['kontak']],
            'masjid' => ['<em>makmur</em>', ['profil', 'kegiatan', 'donasi', 'kontak']],
            'gym' => ['<em>kuat</em>', ['kelas', 'membership', 'kontak']],
            'klinik' => ['<em>dekat</em>', ['layanan', 'dokter', 'pendaftaran']],
            'bangunan' => ['<em>grosir</em>', ['produk', 'tentang', 'kontak']],
            'percetakan' => ['<em>cepat</em>', ['layanan', 'portofolio', 'kontak']],
            'eo' => ['<em>tak terlupakan</em>', ['layanan', 'portofolio', 'kontak']],
            'desa' => ['<em>maju</em>', ['profil', 'layanan', 'potensi', 'kontak']],
            'cv' => ['<em>mudah dipakai</em>', ['portofolio', 'kontak']],
            'travel' => ['<em>tanpa ribet</em>', ['paket', 'destinasi', 'kontak']],
            'kontraktor' => ['<em>tepat waktu dan tepat anggaran</em>', ['layanan', 'proyek', 'kontak']],
            'umkm' => ['<em>sampai di depan pintu</em>', ['produk', 'reseller', 'kontak']],
            'lpk' => ['<em>Jepang &amp; Korea</em>', ['program', 'alumni', 'pendaftaran']],
            'ekspedisi' => ['<em>aman sampai tujuan</em>', ['layanan', 'tarif', 'kontak']],
            'desa2' => ['desa2-stat', ['profil', 'infografis', 'layanan', 'berita', 'belanja']],
            'servis' => ['<em>Beres hari ini</em>', ['harga', 'status', 'kontak']],
            'paud' => ['<em>tumbuh ceria</em>', ['program', 'galeri', 'pendaftaran']],
            'gereja' => ['<em>iman, pengharapan, dan kasih</em>', ['ibadah', 'tentang', 'persembahan', 'kontak']],
            'koperasi' => ['<em>untuk kesejahteraan bersama</em>', ['usaha', 'laporan', 'keanggotaan']],
            'caleg' => ['<em>bekerja nyata</em>', ['profil', 'program', 'relawan', 'aspirasi']],
            'kos' => ['<em>rasa rumah sendiri</em>', ['kamar', 'fasilitas', 'lokasi']],
            'lapangan' => ['<em>booking lapangan</em>', ['lapangan', 'harga', 'booking']],
            'cucimobil' => ['<em>seperti baru keluar dealer</em>', ['layanan', 'coating', 'member', 'kontak']],
            'interior' => ['<em>dibuat pas untuk rumah Anda</em>', ['proyek', 'layanan', 'proses', 'kontak']],
        ];

        foreach ($expect as $theme => [$text, $slugs]) {
            $this->put(route('themes.update'), ['theme' => $theme]);
            $this->get('/')->assertOk()->assertSee("theme-{$theme}", false)->assertSee($text, false);
            foreach ($slugs as $slug) {
                $this->get("/{$slug}")->assertOk();
            }
        }
    }

    public function test_catalog_cards_ask_on_whatsapp_and_the_kpr_calculator_renders()
    {
        $this->actingAs(User::factory()->create());
        app(Site::class)->put(['whatsapp' => '0812 3456 789']);

        $this->put(route('themes.update'), ['theme' => 'properti']);
        $this->get('/tipe-rumah')->assertOk()
            ->assertSee('https://wa.me/628123456789?text='.rawurlencode('Halo, saya mau tanya Tipe Melati 45/90 (Rp675 juta)'), false)
            ->assertSee('data-kpr', false)->assertSee('675.000.000', false);
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

    public function test_every_sample_page_can_be_browsed_and_links_stay_in_the_preview()
    {
        $this->actingAs(User::factory()->create());

        // Inner sample pages open, and their menu and buttons keep the sample preview.
        $this->get('/menu?preview_sample=kue')->assertOk()->assertSee('theme-kue', false)->assertSee('Menu Kami')
            ->assertSee('href="http://localhost:8000/kontak?preview_sample=kue"', false)
            ->assertSee('href="http://localhost:8000/?preview_sample=kue"', false)
            ->assertDontSee('/storage/demo/cake-hero.jpg?preview_sample', false);
        $this->get('/?preview_sample=umroh')->assertSee('href="http://localhost:8000/paket?preview_sample=umroh"', false);
        $this->get('/tidak-ada?preview_sample=kue')->assertNotFound();
        $this->assertFalse(Page::allPresets()->where('preset', 'kue')->exists());

        // Previewing your own pages in another template keeps that template too.
        $this->get('/tentang?preview_theme=modern')->assertOk()->assertSee('theme-modern', false)
            ->assertSee('href="http://localhost:8000/layanan?preview_theme=modern"', false);
    }

    public function test_a_demo_site_lets_visitors_browse_every_template()
    {
        $this->get('/?tema=kue')->assertDontSee('theme-kue', false);

        config(['compro.demo' => true]);

        $this->get('/?tema=kue')->assertOk()->assertSee('theme-kue', false)->assertHeader('X-Robots-Tag', 'noindex')
            ->assertSee('href="http://localhost:8000/menu?tema=kue"', false);
        $this->get('/menu?tema=kue')->assertOk()->assertSee('Menu Kami');
        $this->get('/?tema=tidak-ada')->assertOk()->assertDontSee('theme-tidak-ada', false);
        $this->assertFalse(Page::allPresets()->where('preset', 'kue')->exists());
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
