<?php

namespace Tests\Feature;

use App\Models\Page;
use App\Models\User;
use App\Sections\DefaultContent;
use App\Support\Site;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class AssistantTest extends TestCase
{
    use RefreshDatabase;

    private Page $page;

    protected function setUp(): void
    {
        parent::setUp();
        DefaultContent::install('PT Uji');
        $this->page = Page::where('slug', 'tentang')->firstOrFail();
        app(Site::class)->put(['ai_api_key' => Crypt::encryptString('sk-test'), 'ai_model' => 'test-model']);
        $this->actingAs(User::factory()->create());
    }

    private function aiReplies(array $json): void
    {
        Http::fake(['ai.mudahcloud.com/*' => Http::response(['choices' => [['message' => ['content' => json_encode($json)]]]])]);
    }

    private function ask(string $request = 'Buat lebih formal'): TestResponse
    {
        return $this->postJson(route('pages.assistant', $this->page), [
            'request' => $request,
            'sections' => $this->page->sections,
        ]);
    }

    public function test_proposal_is_returned_cleaned_and_not_saved()
    {
        $id = $this->page->sections[1]['id'];
        $this->aiReplies(['message' => 'Saya ubah judulnya.', 'sections' => [
            ['id' => $id, 'type' => 'image_text', 'data' => ['title' => 'Profil Resmi', 'body' => 'Teks baru', 'image' => 'http://evil.test/x.png']],
            ['id' => 'new1', 'type' => 'cta', 'data' => ['title' => 'Hubungi', 'button_url' => 'javascript:alert(1)']],
            ['id' => 'bad', 'type' => 'script', 'data' => []],
        ]]);

        $this->ask()->assertOk()
            ->assertJsonPath('message', 'Saya ubah judulnya.')
            ->assertJsonCount(2, 'sections')
            ->assertJsonPath('sections.0.data.title', 'Profil Resmi')
            ->assertJsonPath('sections.0.data.image', 'demo/lobby.jpg')
            ->assertJsonPath('sections.1.data.button_url', '');

        $this->assertSame('Perjalanan Kami', $this->page->fresh()->sections[1]['data']['title']);

        Http::assertSent(fn (Request $r) => $r->url() === 'https://ai.mudahcloud.com/v1/chat/completions'
            && $r->hasHeader('Authorization', 'Bearer sk-test')
            && $r['model'] === 'test-model'
            && str_contains($r['messages'][0]['content'], 'image_text'));
    }

    public function test_uploaded_images_are_kept()
    {
        $sections = $this->page->sections;
        $sections[1]['data']['image'] = 'media/foto.jpg';
        $this->page->update(['sections' => $sections]);

        $this->aiReplies(['message' => 'ok', 'sections' => [
            ['id' => $sections[1]['id'], 'type' => 'image_text', 'data' => ['title' => 'Baru', 'image' => '']],
        ]]);

        $this->ask()->assertOk()->assertJsonPath('sections.0.data.image', 'media/foto.jpg');
    }

    public function test_json_wrapped_in_prose_is_read()
    {
        Http::fake(['ai.mudahcloud.com/*' => Http::response(['choices' => [['message' => ['content' => "Tentu!\n```json\n".json_encode(['message' => 'Selesai', 'sections' => [['type' => 'text', 'data' => ['title' => 'Halo']]]])."\n```"]]]])]);

        $this->ask()->assertOk()->assertJsonPath('sections.0.data.title', 'Halo');
    }

    public function test_gateway_errors_are_explained()
    {
        Http::fake(['ai.mudahcloud.com/*' => Http::response(['error' => 'insufficient'], 402)]);
        $this->ask()->assertStatus(422)->assertJsonPath('message', fn ($m) => str_contains($m, 'Kredit AI Anda habis'));

        Http::fake(['ai.mudahcloud.com/*' => Http::response(['choices' => [['message' => ['content' => 'bukan json']]]])]);
        $this->ask()->assertStatus(422);
    }

    public function test_assistant_needs_the_gateway()
    {
        app(Site::class)->put(['ai_api_key' => '']);
        Http::fake();

        $this->ask()->assertStatus(422)->assertJsonPath('message', 'Asisten AI belum aktif. Isi API key MudahCloud AI di Pengaturan Situs.');
        Http::assertNothingSent();
        $this->get(route('pages.edit', $this->page))->assertInertia(fn ($p) => $p->where('aiEnabled', false));
    }

    public function test_preview_renders_unsaved_sections()
    {
        $this->post(route('pages.preview', $this->page), [
            'sections' => [['type' => 'hero', 'data' => ['title' => 'Judul Pratinjau']]],
        ])->assertOk()->assertSee('Judul Pratinjau');

        $this->assertNotSame('hero', $this->page->fresh()->sections[0]['type']);
    }

    public function test_guests_cannot_use_the_assistant()
    {
        auth()->logout();
        $this->postJson(route('pages.assistant', $this->page), ['request' => 'x', 'sections' => []])->assertUnauthorized();
    }
}
