<?php

namespace Tests\Feature;

use App\Models\Page;
use App\Models\User;
use App\Sections\DefaultContent;
use App\Support\Site;
use App\Support\Themes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class AiWriterTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        DefaultContent::install('PT Uji');
        app(Site::class)->put(['ai_api_key' => Crypt::encryptString('sk-test')]);
        $this->actingAs(User::factory()->create());
    }

    private function aiReplies(array ...$replies): void
    {
        $sequence = Http::sequence();

        foreach ($replies as $json) {
            $sequence->push(['choices' => [['message' => ['content' => json_encode($json)]]]]);
        }

        Http::fake(['ai.mudahcloud.com/v1/chat/completions' => $sequence]);
    }

    public function test_a_new_page_is_written_by_ai_with_only_site_photos()
    {
        $this->aiReplies(['title' => 'Karier', 'sections' => [
            ['id' => 'a', 'type' => 'page_header', 'data' => ['title' => 'Bergabung bersama kami']],
            ['id' => 'b', 'type' => 'image_text', 'data' => ['title' => 'Budaya kerja', 'body' => 'Teks', 'image' => 'demo/lobby.jpg']],
            ['id' => 'c', 'type' => 'image_text', 'data' => ['title' => 'Lain', 'body' => 'Teks', 'image' => 'http://evil.test/x.png']],
        ]]);

        $this->postJson(route('ai.page'), ['request' => 'Halaman karier dengan 3 lowongan'])
            ->assertOk()->assertJsonPath('redirect', fn ($url) => str_contains($url, '/admin/pages/'));

        $page = Page::query()->where('slug', 'karier')->sole();
        $this->assertSame('Karier', $page->title);
        $this->assertSame('demo/lobby.jpg', $page->sections[1]['data']['image']);
        $this->assertSame('', $page->sections[2]['data']['image']);
    }

    public function test_site_copy_is_suggested_but_not_saved()
    {
        $this->aiReplies(['tagline' => 'Laundry bersih di Bandung', 'description' => 'Laundry kiloan antar jemput di Bandung.', 'footer_text' => 'Cucian beres tanpa repot.']);

        $this->postJson(route('ai.site-copy'), ['story' => 'Kami laundry kiloan di Bandung dengan antar jemput.'])
            ->assertOk()->assertJsonPath('tagline', 'Laundry bersih di Bandung');

        $this->assertNotSame('Laundry bersih di Bandung', app(Site::class)->get('tagline'));
    }

    public function test_setup_picks_a_template_then_rewrites_each_page()
    {
        $this->aiReplies(
            ['theme' => 'laundry', 'tagline' => 'Bersih wangi', 'description' => 'Laundry di Bandung.', 'footer_text' => 'Laundry kami.'],
            ['message' => 'ok', 'sections' => [['id' => 'x1', 'type' => 'page_header', 'data' => ['title' => 'Harga Laundry Wangi']]]],
        );

        $json = $this->postJson(route('ai.setup'), ['site_name' => 'Laundry Wangi', 'story' => 'Kami laundry kiloan di Bandung dengan antar jemput gratis.'])
            ->assertOk()->assertJsonPath('theme', 'Laundry')->json();

        $site = app(Site::class);
        $this->assertSame('laundry', Themes::current($site));
        $this->assertSame('Laundry Wangi', $site->get('site_name'));
        $this->assertSame('Bersih wangi', $site->get('tagline'));
        $this->assertNotEmpty($json['pages']);

        $first = $json['pages'][0];
        $this->postJson($first['url'], ['story' => 'Laundry kiloan di Bandung'])->assertOk();
        $this->assertSame('Harga Laundry Wangi', Page::query()->findOrFail($first['id'])->sections[0]['data']['title']);
    }

    public function test_an_unknown_template_from_the_ai_falls_back_to_korporat()
    {
        $this->aiReplies(['theme' => 'not-a-theme', 'tagline' => 'Halo', 'description' => 'Desc', 'footer_text' => 'Foot']);

        $this->postJson(route('ai.setup'), ['site_name' => 'PT Uji', 'story' => 'Kami perusahaan jasa konsultan umum di Jakarta.'])
            ->assertOk()->assertJsonPath('theme', 'Korporat');
    }
}
