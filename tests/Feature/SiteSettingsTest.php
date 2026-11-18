<?php

namespace Tests\Feature;

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
}
