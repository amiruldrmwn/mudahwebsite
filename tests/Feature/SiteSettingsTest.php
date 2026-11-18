<?php

namespace Tests\Feature;

use App\Ai\AiClient;
use App\Models\User;
use App\Sections\DefaultContent;
use App\Support\Site;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SiteSettingsTest extends TestCase
{
    use RefreshDatabase;

    private function valid(array $overrides = []): array
    {
        return [
            'site_name' => 'PT Maju Bersama',
            'tagline' => 'Konstruksi terpercaya',
            'primary_color' => '#112233',
            'contact_email' => 'info@maju.test',
            'social_instagram' => 'https://instagram.com/maju',
            ...$overrides,
        ];
    }

    public function test_guests_cannot_open_settings()
    {
        $this->get(route('site.edit'))->assertRedirect(route('login'));
    }

    public function test_settings_page_is_displayed()
    {
        $this->actingAs(User::factory()->create())
            ->get(route('site.edit'))
            ->assertOk()
            ->assertInertia(fn ($page) => $page->component('site/Settings')->where('settings.primary_color', '#2563eb'));
    }

    public function test_settings_are_saved()
    {
        $this->actingAs(User::factory()->create())
            ->post(route('site.update'), $this->valid())
            ->assertRedirect(route('site.edit'));

        $site = app(Site::class);
        $this->assertSame('PT Maju Bersama', $site->get('site_name'));
        $this->assertSame('#112233', $site->get('primary_color'));
        $this->assertSame(['instagram' => 'https://instagram.com/maju'], $site->socials());
    }

    public function test_logo_is_uploaded_replaced_and_removed()
    {
        Storage::fake('public');
        $user = User::factory()->create();

        $this->actingAs($user)->post(route('site.update'), $this->valid(['logo' => UploadedFile::fake()->image('logo.png')]));
        $first = app(Site::class)->get('logo');
        Storage::disk('public')->assertExists($first);

        $this->actingAs($user)->post(route('site.update'), $this->valid(['logo' => UploadedFile::fake()->image('new.png')]));
        $second = app(Site::class)->get('logo');
        Storage::disk('public')->assertMissing($first);
        Storage::disk('public')->assertExists($second);

        $this->actingAs($user)->post(route('site.update'), $this->valid(['remove_logo' => true]));
        $this->assertNull(app(Site::class)->get('logo'));
        Storage::disk('public')->assertMissing($second);
    }

    public function test_invalid_values_are_rejected()
    {
        $this->actingAs(User::factory()->create())
            ->post(route('site.update'), $this->valid(['site_name' => '', 'primary_color' => 'red', 'social_facebook' => 'javascript:alert(1)']))
            ->assertSessionHasErrors(['site_name', 'primary_color', 'social_facebook']);
    }

    public function test_the_favicon_falls_back_to_the_uploaded_logo_then_the_mudahcloud_mark()
    {
        $site = app(Site::class);
        DefaultContent::install('PT Uji');

        $this->get('/')->assertSee('href="/favicon.svg"', false);

        $site->put(['logo' => 'site/logo-saya.png']);
        $this->get('/')->assertSee('<link rel="icon" href="'.url('storage/site/logo-saya.png').'">', false);

        $site->put(['favicon' => 'site/ikon.png']);
        $this->get('/')->assertSee('<link rel="icon" href="'.url('storage/site/ikon.png').'">', false);
    }

    public function test_ai_key_is_saved_encrypted_and_never_sent_back()
    {
        $this->actingAs(User::factory()->create());

        $this->post(route('site.update'), $this->valid(['ai_base_url' => 'https://ai.test/v1', 'ai_api_key' => 'sk-secret', 'ai_model' => 'gpt-test']))->assertRedirect();

        $site = app(Site::class);
        $this->assertNotSame('sk-secret', $site->get('ai_api_key'));
        $this->assertSame('sk-secret', $site->aiApiKey());
        $this->assertTrue(app(AiClient::class)->enabled());

        // A blank field keeps the key; the settings page only says one is saved.
        $this->post(route('site.update'), $this->valid(['ai_base_url' => 'https://ai.test/v1']))->assertRedirect();
        $this->assertSame('sk-secret', app(Site::class)->aiApiKey());
        $this->get(route('site.edit'))->assertDontSee('sk-secret')->assertInertia(fn ($page) => $page->where('settings.ai_key_set', true)->missing('settings.ai_api_key'));

        $this->post(route('site.update'), $this->valid(['remove_ai_key' => true]))->assertRedirect();
        $this->assertNull(app(Site::class)->aiApiKey());
    }
}
