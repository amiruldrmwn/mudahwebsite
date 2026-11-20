<?php

namespace App\Http\Middleware;

use App\Support\PageCache;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Any change made in the admin or by MudahCloud starts a new version of the cached pages.
 */
class FlushPageCache
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (! $request->isMethodSafe() && $request->is('admin/*', '_mudahcloud/*') && $response->getStatusCode() < 400) {
            PageCache::flush();
        }

        return $response;
    }
}
