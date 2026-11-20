<?php

namespace Tests\Feature;

use App\Models\SiteVisit;
use App\Models\User;
use App\Sections\DefaultContent;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rules\Password;
use Tests\TestCase;

class SecurityHardeningTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_forwarded_host_never_reaches_the_links_the_site_makes()
    {
        Notification::fake();
        $user = User::factory()->create();
        $headers = ['X-Forwarded-Host' => 'evil.example', 'X-Forwarded-Proto' => 'https'];

        $robots = $this->withHeaders($headers)->get('/robots.txt')->assertOk()->getContent();
        $this->assertStringNotContainsString('evil.example', $robots);
        $this->assertStringContainsString('Sitemap: https://localhost', $robots);

        $this->withHeaders($headers)->post('/admin/forgot-password', ['email' => $user->email]);
        Notification::assertSentTo($user, ResetPassword::class, function (ResetPassword $n) use ($user) {
            $link = $n->toMail($user)->actionUrl;

            return str_starts_with($link, 'https://localhost') && ! str_contains($link, 'evil');
        });
    }

    public function test_a_reset_password_follows_the_password_policy()
    {
        Notification::fake();
        Password::defaults(fn () => Password::min(12)->mixedCase()->numbers()->symbols());
        $user = User::factory()->create();
        $this->post('/admin/forgot-password', ['email' => $user->email]);

        Notification::assertSentTo($user, ResetPassword::class, function (ResetPassword $n) use ($user) {
            $reset = fn (string $password) => $this->post('/admin/reset-password', [
                'token' => $n->token, 'email' => $user->email, 'password' => $password, 'password_confirmation' => $password,
            ]);

            $reset('pendek123')->assertSessionHasErrors('password');
            $reset('Sandi-Baru-2026!')->assertSessionHasNoErrors();

            return true;
        });

        $this->assertTrue(Hash::check('Sandi-Baru-2026!', $user->fresh()->password));
    }

    public function test_a_new_password_signs_out_every_other_session_but_keeps_this_one()
    {
        $user = User::factory()->create();

        // Another device signed in earlier; the password then changes elsewhere.
        $this->actingAs($user)->get(route('dashboard'))->assertOk();
        $user->forceFill(['password' => 'kata-sandi-lain'])->save();
        $this->get(route('dashboard'))->assertRedirect(route('login'));

        // Changing it yourself keeps you signed in.
        $this->actingAs($user = $user->fresh())->get(route('dashboard'))->assertOk();
        $this->put(route('user-password.update'), [
            'current_password' => 'kata-sandi-lain', 'password' => 'kata-sandi-baru', 'password_confirmation' => 'kata-sandi-baru',
        ])->assertSessionHasNoErrors();
        $this->get(route('dashboard'))->assertOk();
    }

    public function test_changing_the_login_email_asks_for_the_password()
    {
        $user = User::factory()->create(['email' => 'admin@maju.test']);
        $this->actingAs($user);

        $this->patch(route('profile.update'), ['name' => 'Budi', 'email' => 'Admin@Maju.test'])->assertSessionHasNoErrors();
        $this->patch(route('profile.update'), ['name' => 'Budi', 'email' => 'orang@lain.test'])->assertSessionHasErrors('current_password');
        $this->patch(route('profile.update'), ['name' => 'Budi', 'email' => 'orang@lain.test', 'current_password' => 'salah'])->assertSessionHasErrors('current_password');
        $this->assertSame('admin@maju.test', $user->fresh()->email);

        $this->patch(route('profile.update'), ['name' => 'Budi', 'email' => 'baru@maju.test', 'current_password' => 'password'])->assertSessionHasNoErrors();
        $this->assertSame('baru@maju.test', $user->fresh()->email);
    }

    public function test_odd_query_values_do_not_break_the_site()
    {
        DefaultContent::install('PT Maju');
        config(['compro.demo' => true]);

        $this->get('/?tema[]=x')->assertOk();
        $this->actingAs(User::factory()->create())->get('/?preview_sample[]=x')->assertOk();
    }

    public function test_whatsapp_clicks_count_once_per_visitor_every_ten_minutes()
    {
        DefaultContent::install('PT Maju');

        $this->post(route('stats.whatsapp'))->assertNoContent();
        $this->post(route('stats.whatsapp'))->assertNoContent();
        $this->assertSame(1, SiteVisit::lastDays(1)->first()['clicks']);

        $this->travel(11)->minutes();
        $this->post(route('stats.whatsapp'));
        $this->assertSame(2, SiteVisit::lastDays(1)->first()['clicks']);
    }
}
