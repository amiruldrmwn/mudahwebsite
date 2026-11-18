<?php

namespace App\Providers;

use App\Actions\Fortify\ResetUserPassword;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Logging out from the admin returns to the login page, not the public site:
        // the site is a Blade page, which Inertia would show inside an error modal.
        $this->app->singleton(LogoutResponse::class, fn () => new class implements LogoutResponse
        {
            public function toResponse($request)
            {
                return redirect()->route('login');
            }
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureViews();
        $this->configureRateLimiting();
    }

    /**
     * Configure Fortify views.
     */
    private function configureViews(): void
    {
        Fortify::loginView(fn (Request $request) => Inertia::render('auth/Login', [
            'status' => $request->session()->get('status'),
            'forgotUrl' => route('password.request'),
        ]));

        Fortify::twoFactorChallengeView(fn () => Inertia::render('auth/TwoFactorChallenge'));

        Fortify::confirmPasswordView(fn () => Inertia::render('auth/ConfirmPassword'));

        Fortify::requestPasswordResetLinkView(fn (Request $request) => Inertia::render('auth/ForgotPassword', [
            'status' => $request->session()->get('status'),
            'action' => route('password.email'),
            'loginUrl' => route('login'),
        ]));

        Fortify::resetPasswordView(fn (Request $request) => Inertia::render('auth/ResetPassword', [
            'token' => $request->route('token'),
            'email' => (string) $request->query('email'),
            'action' => route('password.update'),
        ]));

        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        // The reset email in the site's language, under its own name.
        ResetPassword::toMailUsing(fn ($user, string $token) => (new MailMessage)
            ->subject('Atur ulang kata sandi admin '.config('app.name'))
            ->greeting('Halo,')
            ->line('Kami menerima permintaan untuk membuat kata sandi baru bagi admin website '.config('app.name').'.')
            ->action('Buat kata sandi baru', route('password.reset', ['token' => $token, 'email' => $user->getEmailForPasswordReset()]))
            ->line('Link ini berlaku 60 menit. Abaikan email ini kalau Anda tidak memintanya; kata sandi lama tetap berlaku.')
            ->salutation('Salam, '.config('app.name')));
    }

    /**
     * Configure rate limiting.
     */
    private function configureRateLimiting(): void
    {
        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('passkeys', function (Request $request) {
            return Limit::perMinute(10)->by(
                ($request->input('credential.id') ?: $request->session()->getId()).'|'.$request->ip(),
            );
        });
    }
}
