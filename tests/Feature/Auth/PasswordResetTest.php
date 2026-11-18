<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_admin_who_forgot_the_password_sets_a_new_one_from_the_emailed_link()
    {
        Notification::fake();
        $user = User::factory()->create();

        $this->get('/admin/login')->assertInertia(fn ($page) => $page->where('forgotUrl', route('password.request')));
        $this->get('/admin/forgot-password')->assertOk();
        $this->post('/admin/forgot-password', ['email' => $user->email])->assertSessionHasNoErrors();

        Notification::assertSentTo($user, ResetPassword::class, function (ResetPassword $n) use ($user) {
            $this->get("/admin/reset-password/{$n->token}?email={$user->email}")->assertOk();
            $this->post('/admin/reset-password', [
                'token' => $n->token, 'email' => $user->email, 'password' => 'kata-sandi-baru', 'password_confirmation' => 'kata-sandi-baru',
            ])->assertSessionHasNoErrors();

            return true;
        });

        $this->assertTrue(Hash::check('kata-sandi-baru', $user->fresh()->password));
    }
}
