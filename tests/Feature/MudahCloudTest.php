<?php

namespace Tests\Feature;

use App\Models\User;
use App\Support\Site;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class MudahCloudTest extends TestCase
{
    use RefreshDatabase;

    private function mc(string $method, string $uri, array $data = [])
    {
        return $this->withToken('mc-key')->json($method, "/_mudahcloud/{$uri}", $data);
    }

    public function test_mudahcloud_posts_need_no_csrf_token()
    {
        config(['compro.mudahcloud_key' => 'mc-key']);
        User::factory()->create();
        // The CSRF check the tests normally skip, on as in production.
        $this->app->instance('env', 'production');
        $this->app->forgetInstance(\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class);

        $this->mc('POST', 'login')->assertOk();
        $this->post('/kirim-pesan', ['name' => 'x'])->assertStatus(419);
    }

    public function test_without_the_key_nothing_answers()
    {
        $this->getJson('/_mudahcloud/status')->assertNotFound();

        config(['compro.mudahcloud_key' => 'mc-key']);
        $this->getJson('/_mudahcloud/status')->assertNotFound();
        $this->withToken('wrong')->getJson('/_mudahcloud/status')->assertNotFound();
    }

    public function test_mudahcloud_reads_the_site_switches_its_template_and_sets_the_admin_password()
    {
        config(['compro.mudahcloud_key' => 'mc-key']);
        $admin = User::factory()->create(['email' => 'budi@toko.test']);

        $this->mc('GET', 'status')->assertOk()
            ->assertJsonPath('admin_email', 'budi@toko.test')
            ->assertJsonCount(14, 'days')
            ->assertJsonStructure(['site_name', 'url', 'theme', 'theme_label', 'pages', 'unread', 'views7', 'setup']);

        $this->mc('POST', 'theme', ['theme' => 'nope'])->assertUnprocessable();
        $this->mc('POST', 'theme', ['theme' => 'kopi'])->assertOk()->assertJsonPath('theme', 'kopi');
        $this->assertSame('kopi', app(Site::class)->get('theme'));

        $this->mc('POST', 'password', ['password' => 'short'])->assertUnprocessable();
        $this->mc('POST', 'password', ['password' => 'rahasia-baru-123'])->assertOk();
        $this->assertTrue(Hash::check('rahasia-baru-123', $admin->fresh()->password));
    }

    public function test_the_sign_in_link_works_once()
    {
        config(['compro.mudahcloud_key' => 'mc-key']);
        User::factory()->create();

        $url = $this->mc('POST', 'login', ['to' => '/admin/themes'])->assertOk()->json('url');

        $this->get($url)->assertRedirect('/admin/themes');
        $this->assertAuthenticated();

        auth()->logout();
        $this->get($url)->assertForbidden();
        $this->assertGuest();

        // Somewhere outside the admin is not a destination.
        $other = $this->mc('POST', 'login', ['to' => 'https://evil.test'])->json('url');
        $this->get($other)->assertRedirect('/admin');
    }
}
