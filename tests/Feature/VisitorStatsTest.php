<?php

namespace Tests\Feature;

use App\Models\Page;
use App\Models\SiteVisit;
use App\Models\User;
use App\Sections\DefaultContent;
use App\Support\Site;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class VisitorStatsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        DefaultContent::install('PT Uji');
    }

    public function test_page_views_and_whatsapp_clicks_are_counted_per_day()
    {
        $this->get('/')->assertOk();
        $this->get('/')->assertOk();
        $this->post(route('stats.whatsapp'))->assertNoContent();

        $today = SiteVisit::lastDays(1)->first();
        $this->assertSame(2, $today['views']);
        $this->assertSame(1, $today['clicks']);
    }

    public function test_admins_and_bots_are_not_counted()
    {
        $this->withHeader('User-Agent', 'Googlebot/2.1')->get('/')->assertOk();
        $this->actingAs(User::factory()->create())->get('/')->assertOk();

        $this->assertSame(0, SiteVisit::lastDays(1)->first()['views']);
    }

    public function test_dashboard_shows_visits_and_getting_started_steps()
    {
        SiteVisit::bump('views');

        $this->actingAs(User::factory()->create())->get(route('dashboard'))
            ->assertInertia(fn (Assert $page) => $page
                ->where('visits.views7', 1)
                ->has('visits.days', 14)
                ->has('setup', 3)
                ->where('setup.2.done', false));
    }

    public function test_contact_section_embeds_a_map_and_the_google_verification_tag()
    {
        app(Site::class)->put([
            'address' => 'Jl. Sudirman No. 1, Jakarta',
            'google_verification' => '<meta name="google-site-verification" content="abc_123-XYZ" />',
        ]);

        $this->get('/kontak')->assertOk()
            ->assertSee('maps.google.com/maps?q=Jl.%20Sudirman', false)
            ->assertSee('<meta name="google-site-verification" content="abc_123-XYZ">', false);

        app(Site::class)->put(['maps_embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!abc" width="600"></iframe>']);
        $this->get('/kontak')->assertSee('https://www.google.com/maps/embed?pb=!1m18!abc', false);

        app(Site::class)->put(['show_map' => 'no']);
        $this->get('/kontak')->assertDontSee('site-map', false);
    }

    public function test_page_editor_offers_ready_made_sections_from_the_template()
    {
        $page = Page::query()->firstOrFail();

        $this->actingAs(User::factory()->create())->get(route('pages.edit', $page))
            ->assertInertia(fn (Assert $p) => $p
                ->has('sectionPresets.0', fn (Assert $preset) => $preset
                    ->hasAll(['key', 'type', 'label', 'page', 'image', 'data'])));
    }

    public function test_the_site_name_beside_the_logo_can_be_hidden()
    {
        $this->get('/')->assertSee('text-lg leading-tight font-bold', false);

        app(Site::class)->put(['show_name' => 'no']);

        $this->get('/')->assertOk()->assertDontSee('text-lg leading-tight font-bold', false)->assertSee('sr-only', false);
    }

    public function test_template_demos_show_their_own_logo_not_the_uploaded_one()
    {
        app(Site::class)->put(['logo' => 'site/my-logo.png', 'show_name' => 'no']);

        $this->actingAs(User::factory()->create())->get('/?preview_sample=laundry')
            ->assertOk()
            ->assertDontSee('site/my-logo.png', false)
            ->assertSee('text-lg leading-tight font-bold', false);
    }
}
