<?php

namespace Tests\Feature;

use App\Models\Page;
use App\Sections\DefaultContent;
use App\Support\Site;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class InstallContentTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    public function test_a_new_site_starts_with_the_site_theme_from_the_environment()
    {
        config(['compro.theme' => 'umroh', 'app.name' => 'Travel Berkah']);

        $this->artisan('compro:install-content')->assertSuccessful();

        $site = app(Site::class);
        $this->assertSame('umroh', $site->get('theme'));
        $this->assertSame('#1f2b4d', $site->get('primary_color'));
        $this->assertTrue(Page::where('slug', 'paket')->exists());
        $this->get('/')->assertSee('theme-umroh', false)->assertSee('Travel Berkah menghadirkan perjalanan ibadah');
    }

    public function test_site_theme_is_ignored_once_the_site_has_pages()
    {
        DefaultContent::install('PT Lama');
        app(Site::class)->put(['theme' => 'modern']);
        config(['compro.theme' => 'spa']);

        $this->artisan('compro:install-content')->assertSuccessful();

        $this->assertSame('modern', app(Site::class)->get('theme'));
        $this->assertFalse(Page::allPresets()->where('preset', 'spa')->exists());
    }

    public function test_an_unknown_or_empty_site_theme_falls_back_to_korporat()
    {
        config(['compro.theme' => 'tidak-ada']);

        $this->artisan('compro:install-content')->assertSuccessful();

        $this->assertSame('korporat', app(Site::class)->get('theme'));
        $this->assertTrue(Page::where('slug', 'proyek')->exists());
    }
}
