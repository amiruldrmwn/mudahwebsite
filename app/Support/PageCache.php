<?php

namespace App\Support;

use Closure;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

/**
 * Finished public pages for visitors, so a busy day (an ad running, a post going viral) doesn't
 * render every section on every visit. Anything the admin or MudahCloud changes starts a new
 * version (FlushPageCache); a new image does too, through its build manifest. The form token is
 * swapped back in for each visitor.
 */
class PageCache
{
    private const VERSION_KEY = 'site.pages.version';

    private const TOKEN = '__compro_csrf__';

    /** Long enough to matter, short enough for scheduled posts to appear on time. */
    private const MINUTES = 10;

    /**
     * The page at this address (with its host: a custom domain and the mudah.cloud one differ
     * in their links).
     *
     * @param  Closure(): string  $render
     */
    public static function remember(string $url, Closure $render): string
    {
        // A visitor who just sent the contact form sees its own answer, not the shared page.
        if (session()->has('contact_sent') || session()->has('errors') || session()->hasOldInput()) {
            return $render();
        }

        $token = (string) csrf_token();
        $html = self::store()->remember(self::key($url), now()->addMinutes(self::MINUTES),
            fn () => str_replace($token, self::TOKEN, $render()));

        return str_replace(self::TOKEN, $token, (string) $html);
    }

    public static function flush(): void
    {
        Cache::forever(self::VERSION_KEY, Str::random(12));
    }

    private static function key(string $url): string
    {
        $version = Cache::rememberForever(self::VERSION_KEY, fn () => Str::random(12));
        $build = @filemtime(public_path('build/manifest.json')) ?: 0;

        return 'page:'.$version.':'.$build.':'.sha1($url);
    }

    /** Pages are kept in files rather than the database, next to the compiled views. */
    private static function store(): Repository
    {
        return Cache::store(app()->runningUnitTests() ? 'array' : 'file');
    }
}
