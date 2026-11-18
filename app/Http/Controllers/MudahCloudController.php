<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Page;
use App\Models\SiteVisit;
use App\Models\User;
use App\Sections\DefaultContent;
use App\Support\Site;
use App\Support\Themes;
use App\Support\ThemeSwitcher;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

/**
 * What MudahCloud's client area does on the owner's behalf: show how the site is doing, switch its
 * template, set a new admin password and sign the owner in without one. Every call carries the
 * site's own key (MUDAHCLOUD_KEY, set by MudahCloud when it creates the site); without that key
 * this does not exist.
 */
class MudahCloudController extends Controller
{
    public function status(Site $site): JsonResponse
    {
        $pages = Page::query()->get(['id', 'published']);
        $days = SiteVisit::lastDays(14);
        $theme = Themes::current($site);
        $realLogo = filled($site->get('logo')) && ! DefaultContent::isSampleLogo($site->get('logo'));

        return response()->json([
            'site_name' => (string) $site->get('site_name'),
            'url' => url('/'),
            'theme' => $theme,
            'theme_label' => Themes::all()[$theme]['label'],
            'color' => $site->get('primary_color'),
            'pages' => $pages->count(),
            'published' => $pages->where('published', true)->count(),
            'unread' => Message::query()->whereNull('read_at')->count(),
            'messages' => Message::query()->count(),
            'views7' => $days->slice(-7)->sum('views'),
            'clicks7' => $days->slice(-7)->sum('clicks'),
            'days' => $days->map(fn (array $d) => ['date' => $d['date'], 'views' => $d['views'], 'clicks' => $d['clicks']])->values(),
            'setup' => [
                ['key' => 'logo', 'done' => $realLogo, 'path' => '/admin/site'],
                ['key' => 'contact', 'done' => filled($site->get('whatsapp')) && filled($site->get('address')), 'path' => '/admin/site'],
                ['key' => 'theme', 'done' => (bool) $site->get('theme_chosen'), 'path' => '/admin/themes'],
                ['key' => 'ai', 'done' => $site->aiApiKey() !== null, 'path' => '/admin/site'],
            ],
            'admin_email' => User::query()->orderBy('id')->value('email'),
        ]);
    }

    public function theme(Request $request, ThemeSwitcher $switcher, Site $site): JsonResponse
    {
        $data = $request->validate([
            'theme' => ['required', Rule::in(array_keys(Themes::all()))],
            'reset' => ['boolean'],
        ]);

        $installed = $switcher->apply($data['theme'], (bool) ($data['reset'] ?? false));

        return response()->json(['theme' => $data['theme'], 'installed' => $installed]);
    }

    /**
     * The AI assistant's key, made by MudahCloud for the owner ("Connect the AI assistant").
     */
    public function aiKey(Request $request, Site $site): JsonResponse
    {
        $data = $request->validate(['key' => ['required', 'string', 'max:500']]);
        $site->put(['ai_api_key' => Crypt::encryptString($data['key'])]);

        return response()->json(['ai' => true]);
    }

    public function password(Request $request): JsonResponse
    {
        $data = $request->validate(['password' => ['required', 'string', 'min:8', 'max:100']]);
        $user = User::query()->orderBy('id')->firstOrFail();
        $user->forceFill(['password' => $data['password']])->save();

        return response()->json(['email' => $user->email]);
    }

    /**
     * A link that signs the owner in once, within two minutes, and opens the admin page asked for.
     */
    public function login(Request $request): JsonResponse
    {
        $to = (string) $request->input('to', '/admin');
        $user = User::query()->orderBy('id')->firstOrFail();

        return response()->json(['url' => URL::temporarySignedRoute('mudahcloud.enter', now()->addMinutes(2), [
            'user' => $user->id,
            'nonce' => Str::random(40),
            'to' => str_starts_with($to, '/admin') ? $to : '/admin',
        ])]);
    }

    public function enter(Request $request): RedirectResponse
    {
        // Once only: a link copied from history does not sign anyone in again.
        abort_unless(Cache::add('mudahcloud-enter:'.$request->query('nonce'), true, now()->addMinutes(10)), 403);

        Auth::login(User::query()->findOrFail((int) $request->query('user')));
        $request->session()->regenerate();

        $to = (string) $request->query('to', '/admin');

        return redirect(str_starts_with($to, '/admin') ? $to : '/admin');
    }
}
