<?php

namespace Tests\Feature;

use App\Http\Controllers\Admin\PageController;
use App\Models\MediaMeta;
use App\Models\Page;
use App\Models\Post;
use App\Models\User;
use App\Sections\DefaultContent;
use App\Sections\SectionTypes;
use App\Support\Media;
use App\Support\RichText;
use App\Support\Site;
use App\Support\SiteImages;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BlogTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        DefaultContent::install('PT Uji Coba');
        app(Site::class)->put(['site_name' => 'PT Uji Coba']);
    }

    /**
     * @param  array<string, mixed>  $attributes
     */
    private function makePost(array $attributes = []): Post
    {
        static $n = 0;
        $n++;

        return Post::query()->create([
            'title' => "Tulisan {$n}",
            'slug' => "tulisan-{$n}",
            'body' => '<p>Isi tulisan yang cukup panjang.</p>',
            'status' => Post::PUBLISHED,
            'published_at' => now()->subDay(),
            ...$attributes,
        ]);
    }

    public function test_scopes_tell_published_scheduled_and_draft_apart()
    {
        $live = $this->makePost();
        $scheduled = $this->makePost(['published_at' => now()->addDay()]);
        $draft = $this->makePost(['status' => Post::DRAFT, 'published_at' => null]);

        $this->assertSame([$live->id], Post::published()->pluck('id')->all());
        $this->assertSame([$scheduled->id], Post::scheduled()->pluck('id')->all());
        $this->assertSame([$draft->id], Post::draft()->pluck('id')->all());
        $this->assertSame(['published', 'scheduled', 'draft'], [$live->state(), $scheduled->state(), $draft->state()]);

        // A scheduled post goes live by itself when its time comes.
        $this->travel(2)->days();
        $this->assertTrue($scheduled->fresh()->isLive());
    }

    public function test_admin_pages_need_sign_in()
    {
        $post = $this->makePost();

        $this->get('/admin/posts')->assertRedirect('/admin/login');
        $this->get("/admin/posts/{$post->id}")->assertRedirect('/admin/login');
        $this->post('/admin/posts')->assertRedirect('/admin/login');
        $this->put("/admin/posts/{$post->id}", ['title' => 'x'])->assertRedirect('/admin/login');
        $this->delete("/admin/posts/{$post->id}")->assertRedirect('/admin/login');
        $this->assertSame(1, Post::count());
    }

    public function test_admin_creates_edits_publishes_and_deletes_a_post()
    {
        $this->actingAs(User::factory()->create());

        $this->get('/admin/posts')->assertOk()->assertInertia(fn ($page) => $page->component('posts/Index'));

        $this->post('/admin/posts')->assertRedirect();
        $post = Post::sole();
        $this->assertSame('draft', $post->state());
        $this->get("/admin/posts/{$post->id}")->assertOk()->assertInertia(fn ($page) => $page->component('posts/Edit')->where('post.title', ''));

        $this->put("/admin/posts/{$post->id}", [
            'title' => 'Libur Akhir Tahun',
            'slug' => 'libur-akhir-tahun',
            'body' => '<h2>Jadwal</h2><p>Kantor tutup <script>alert(1)</script>tanggal 25.</p>',
            'excerpt' => 'Jadwal libur kantor.',
            'category' => 'Pengumuman',
            'cover' => 'media/foto-a1b2c3.webp',
            'status' => 'published',
            'published_at' => '',
            'meta_title' => '',
            'meta_description' => '',
        ])->assertRedirect("/admin/posts/{$post->id}")->assertSessionHasNoErrors();

        $post->refresh();
        $this->assertTrue($post->isLive());
        $this->assertSame('<h2>Jadwal</h2><p>Kantor tutup tanggal 25.</p>', $post->body);
        $this->assertSame('Pengumuman', $post->category);

        $this->get('/admin/posts?status=published&q=Libur')->assertInertia(fn ($page) => $page->where('posts.data.0.state', 'published')->where('counts.published', 1));

        // Scheduling: a time later than now.
        $this->put("/admin/posts/{$post->id}", [...$post->only(['title', 'slug', 'body']), 'status' => 'published', 'published_at' => now()->addWeek()->toIso8601String()]);
        $this->assertSame('scheduled', $post->fresh()->state());

        $this->delete("/admin/posts/{$post->id}")->assertRedirect('/admin/posts');
        $this->assertSame(0, Post::count());
    }

    public function test_slugs_are_checked_and_unique()
    {
        $this->actingAs(User::factory()->create());
        $this->makePost(['slug' => 'dipakai']);
        $post = $this->makePost(['status' => Post::DRAFT]);

        $base = ['title' => 'Judul', 'body' => '', 'status' => 'draft'];
        $this->put("/admin/posts/{$post->id}", [...$base, 'slug' => 'Bukan Slug!'])->assertSessionHasErrors('slug');
        $this->put("/admin/posts/{$post->id}", [...$base, 'slug' => 'dipakai'])->assertSessionHasErrors('slug');

        // A slug the editor made from the title gets a number instead.
        $this->put("/admin/posts/{$post->id}", [...$base, 'slug' => 'dipakai', 'slug_auto' => true])->assertSessionHasNoErrors();
        $this->assertSame('dipakai-2', $post->fresh()->slug);
    }

    public function test_autosave_saves_drafts_only()
    {
        $this->actingAs(User::factory()->create());
        $draft = $this->makePost(['status' => Post::DRAFT, 'published_at' => null]);
        $live = $this->makePost();

        $this->postJson("/admin/posts/{$draft->id}/autosave", ['title' => 'Baru ditulis', 'slug' => $draft->slug, 'body' => '<p>Halo<img src=x onerror=alert(1)></p>'])
            ->assertOk()->assertJson(['saved' => true]);
        $this->assertSame('Baru ditulis', $draft->fresh()->title);
        $this->assertSame('<p>Halo</p>', $draft->fresh()->body);
        $this->assertSame('draft', $draft->fresh()->state());

        $this->postJson("/admin/posts/{$live->id}/autosave", ['title' => 'Diam-diam', 'slug' => $live->slug])->assertStatus(409);
        $this->assertNotSame('Diam-diam', $live->fresh()->title);
    }

    public function test_sanitizer_keeps_the_allow_list_and_drops_the_rest()
    {
        $clean = RichText::clean(implode('', [
            '<h1>Judul</h1><h2 style="text-align: center; position: fixed" onclick="x()">Sub</h2>',
            '<p>Teks <strong>tebal</strong> <em>miring</em> <u>garis</u> <s>coret</s> <span style="color:red">merah</span></p>',
            '<p><a href="javascript:alert(1)">jahat</a> <a href="https://a.test" target="_blank">luar</a> <a href="/kontak">dalam</a> <a href="mailto:a@b.test">surat</a> <a href="tel:+62811">telp</a> <a href="data:text/html,x">data</a></p>',
            '<script>alert(1)</script><style>body{display:none}</style>',
            '<img src="/storage/media/foto.webp" alt="Foto" onerror="alert(1)"><img src="http://plain.test/x.png"><img src="/etc/passwd"><img src="javascript:alert(1)"><img src="https://cdn.test/y.jpg" alt="">',
            '<div data-youtube-video=""><iframe src="https://www.youtube-nocookie.com/embed/dQw4w9WgXcQ" allowfullscreen="true" onload="x"></iframe></div>',
            '<iframe src="https://evil.test/embed/x"></iframe><iframe src="https://www.youtube.com/watch?v=dQw4w9WgXcQ"></iframe>',
            '<table><tbody><tr><th colspan="2">A</th></tr><tr><td>B</td><td onmouseover="x">C</td></tr></tbody></table>',
            '<ul><li>satu</li></ul><ol start="3"><li>dua</li></ol><blockquote>kutip</blockquote><hr><pre><code>kode</code></pre>',
            '<form action="/x"><input name="a"><button>Kirim</button></form><svg onload="alert(1)"></svg><object data="x.swf"></object>',
        ]));

        foreach (['<script', '<style', 'onclick', 'onerror', 'onload', 'onmouseover', 'javascript:', 'data:', 'position', 'color:red', 'evil.test', '/etc/passwd', 'http://plain.test', '<form', '<input', '<button', '<svg', '<object', '<h1', 'watch?v='] as $bad) {
            $this->assertStringNotContainsString($bad, $clean, "kept {$bad}");
        }

        foreach ([
            '<h2>Judul</h2>', '<h2 style="text-align: center">Sub</h2>', '<strong>tebal</strong>', '<em>miring</em>', '<u>garis</u>', '<s>coret</s>', 'merah',
            '<a href="https://a.test" target="_blank" rel="noopener">luar</a>', '<a href="/kontak">dalam</a>', 'href="mailto:a&#64;b.test"', 'href="tel:&#43;62811"',
            '<img src="/storage/media/foto.webp" alt="Foto" />', '<img src="https://cdn.test/y.jpg" alt="" />',
            '<iframe src="https://www.youtube-nocookie.com/embed/dQw4w9WgXcQ" allowfullscreen="true"></iframe>',
            '<th colspan="2">A</th>', '<td>C</td>', '<ol start="3">', '<blockquote>kutip</blockquote>', '<hr />', '<pre><code>kode</code></pre>',
        ] as $good) {
            $this->assertStringContainsString($good, $clean);
        }
    }

    public function test_sanitizer_keeps_images_on_the_site_relative_and_drops_empty_paragraphs()
    {
        $this->assertSame('<img src="/storage/media/a.webp" alt="" />', RichText::clean('<p></p><img src="'.url('/storage/media/a.webp').'" alt=""><p></p>'));
        $this->assertSame('', RichText::clean('<p></p>'));
        $this->assertSame(4, RichText::words('<p>satu dua</p><p>tiga&nbsp;empat</p>'));
    }

    public function test_public_list_and_post_show_only_live_posts()
    {
        $live = $this->makePost(['title' => 'Kabar Gembira', 'category' => 'Kegiatan', 'cover' => 'media/foto-a1b2c3.webp']);
        $scheduled = $this->makePost(['title' => 'Kabar Nanti', 'published_at' => now()->addDay()]);
        $draft = $this->makePost(['title' => 'Kabar Rahasia', 'status' => Post::DRAFT, 'published_at' => null]);

        $this->get('/blog')->assertOk()->assertSee('Kabar Gembira')->assertDontSee('Kabar Nanti')->assertDontSee('Kabar Rahasia')->assertSee('theme-korporat', false);
        $this->get('/blog?kategori=Kegiatan')->assertOk()->assertSee('Kabar Gembira');
        $this->get('/blog?kategori=Lain')->assertOk()->assertDontSee('Kabar Gembira');

        $this->get($live->url())->assertOk()->assertSee('Kabar Gembira')->assertSee('menit baca')
            ->assertSee('<title>Kabar Gembira | PT Uji Coba</title>', false)
            ->assertSee('<meta property="og:type" content="article">', false)
            ->assertSee('https://wa.me/?text=', false)
            ->assertSee(Storage::disk('public')->url('media/foto-a1b2c3.webp'), false);

        $this->get($scheduled->url())->assertNotFound();
        $this->get($draft->url())->assertNotFound();
        $this->get('/blog/tidak-ada')->assertNotFound();

        // The admin previews drafts and scheduled posts, kept out of search engines.
        $this->actingAs(User::factory()->create());
        $this->get($draft->url())->assertOk()->assertSee('Pratinjau')->assertSee('<meta name="robots" content="noindex">', false);
        $this->get($scheduled->url())->assertOk()->assertSee('dijadwalkan terbit');
    }

    public function test_post_page_has_json_ld_and_cover_as_og_image()
    {
        app(Site::class)->put(['logo' => 'media/logo-a1b2c3.png']);
        $post = $this->makePost(['title' => 'Judul </script> Aneh', 'cover' => 'media/sampul-a1b2c3.webp', 'meta_description' => 'Deskripsi SEO.']);

        $html = $this->get($post->url())->assertOk()->getContent();

        $this->assertSame(1, substr_count($html, 'property="og:image"'));
        $this->assertStringContainsString('<meta property="og:image" content="'.Storage::disk('public')->url('media/sampul-a1b2c3.webp').'">', $html);
        $this->assertStringContainsString('<meta name="description" content="Deskripsi SEO.">', $html);

        preg_match('#<script type="application/ld\+json">(.*?)</script>#s', $html, $m);
        $schema = json_decode($m[1], true);
        $this->assertSame('BlogPosting', $schema['@type']);
        $this->assertSame('Judul </script> Aneh', $schema['headline']);
        $this->assertSame($post->published_at?->toAtomString(), $schema['datePublished']);
        $this->assertArrayHasKey('dateModified', $schema);
        $this->assertSame([Storage::disk('public')->url('media/sampul-a1b2c3.webp')], $schema['image']);
        $this->assertSame('PT Uji Coba', $schema['author']['name']);
        $this->assertSame('PT Uji Coba', $schema['publisher']['name']);
        $this->assertSame($post->url(), $schema['mainEntityOfPage']['@id']);
    }

    public function test_body_images_lazy_load_with_library_alt_text()
    {
        MediaMeta::query()->create(['path' => 'media/teknisi-a1b2c3.webp', 'alt' => 'Teknisi memeriksa AC']);
        SiteImages::flush();
        $post = $this->makePost(['body' => RichText::clean('<p>Teks</p><img src="/storage/media/teknisi-a1b2c3.webp" alt="">')]);

        $this->get($post->url())->assertSee('<img decoding="async" loading="lazy" src="/storage/media/teknisi-a1b2c3.webp" alt="Teknisi memeriksa AC"', false);
    }

    public function test_sitemap_lists_the_blog_and_live_posts()
    {
        $this->get('/sitemap.xml')->assertDontSee(url('blog'));

        $live = $this->makePost();
        $draft = $this->makePost(['status' => Post::DRAFT]);

        $this->get('/sitemap.xml')->assertOk()
            ->assertSee('<loc>'.url('blog').'</loc>', false)
            ->assertSee('<loc>'.$live->url().'</loc>', false)
            ->assertDontSee($draft->url());
    }

    public function test_blog_is_not_a_page_slug()
    {
        $this->actingAs(User::factory()->create());
        $page = Page::query()->where('slug', 'tentang')->firstOrFail();

        $this->put("/admin/pages/{$page->id}", ['title' => 'Blog', 'slug' => 'blog', 'sections' => []])->assertSessionHasErrors('slug');
        $this->assertContains('blog', PageController::RESERVED_SLUGS);

        // A new page titled "Blog" gets another address, and /blog stays the blog.
        $this->post('/admin/pages', ['title' => 'Blog']);
        $this->assertSame('blog-1', Page::query()->latest('id')->value('slug'));
        $this->get('/blog')->assertOk()->assertSee('Belum ada tulisan');
    }

    public function test_menu_links_the_blog_once_a_post_is_live()
    {
        $this->get('/')->assertDontSee('href="'.url('blog').'"', false);

        $this->makePost();
        $html = $this->get('/')->getContent();
        $this->assertStringContainsString('href="'.url('blog').'" class="nav-link', $html);
        // Before the contact page.
        $this->assertLessThan(strpos($html, 'href="'.url('kontak').'" class="nav-link'), strpos($html, 'href="'.url('blog').'" class="nav-link'));

        app(Site::class)->put(['blog_title' => 'Berita']);
        $this->get('/blog')->assertSee('>Berita</a>', false);

        app(Site::class)->put(['blog_menu' => 'no']);
        $this->get('/')->assertDontSee('href="'.url('blog').'" class="nav-link', false);
    }

    public function test_blog_settings_are_saved()
    {
        $this->actingAs(User::factory()->create());

        $this->put('/admin/posts/settings', ['blog_menu' => false, 'blog_title' => 'Kabar Desa'])->assertSessionHasNoErrors();

        $this->assertSame('no', app(Site::class)->get('blog_menu'));
        $this->assertSame('Kabar Desa', app(Site::class)->get('blog_title'));
    }

    public function test_latest_posts_section_shows_the_newest_live_posts()
    {
        $this->assertTrue(SectionTypes::has('latest_posts'));
        $this->makePost(['title' => 'Lama', 'published_at' => now()->subDays(5)]);
        $this->makePost(['title' => 'Baru', 'published_at' => now()->subDay(), 'category' => 'Kegiatan']);
        $this->makePost(['title' => 'Belum', 'published_at' => now()->addDay()]);

        $home = Page::query()->where('is_home', true)->firstOrFail();
        $home->update(['sections' => [SectionTypes::clean(['type' => 'latest_posts', 'data' => ['title' => 'Berita terbaru', 'count' => '3']])]]);

        $html = $this->get('/')->assertOk()->assertSee('Berita terbaru')->assertDontSee('Belum')->getContent();
        $this->assertLessThan(strpos($html, '>Lama</a>'), strpos($html, '>Baru</a>'));

        $home->update(['sections' => [SectionTypes::clean(['type' => 'latest_posts', 'data' => ['title' => 'Kegiatan', 'category' => 'Kegiatan']])]]);
        $this->get('/')->assertSee('>Baru</a>', false)->assertDontSee('>Lama</a>', false);

        // With no live post, visitors don't see an empty section.
        Post::query()->delete();
        $this->get('/')->assertDontSee('Kegiatan</h2>', false);
    }

    public function test_media_library_knows_images_used_in_posts()
    {
        Storage::fake('public');
        $media = app(Media::class);
        $cover = $media->store(UploadedFile::fake()->image('sampul.jpg', 50, 50));
        $inline = $media->store(UploadedFile::fake()->image('isi.jpg', 50, 50));
        $post = $this->makePost(['title' => 'Kabar', 'cover' => $cover, 'body' => '<p>a</p><img src="/storage/'.$inline.'" alt="" />']);

        $usage = $media->usage();
        $this->assertSame('Blog: Kabar', $usage[$cover][0]['label']);
        $this->assertSame('Blog: Kabar', $usage[$inline][0]['label']);

        $this->actingAs(User::factory()->create())->postJson('/admin/media/delete', ['path' => $inline])->assertUnprocessable();

        $new = $media->replace($inline, UploadedFile::fake()->image('baru.jpg', 50, 50));
        $this->assertStringContainsString('/storage/'.$new.'"', $post->fresh()->body);
    }
}
