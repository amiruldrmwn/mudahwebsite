<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Lets through MudahCloud's calls carrying this site's key; without a key set, the routes do not exist.
 */
class MudahCloudKey
{
    public function handle(Request $request, Closure $next): Response
    {
        $key = (string) config('compro.mudahcloud_key');
        abort_unless($key !== '' && hash_equals($key, (string) $request->bearerToken()), 404);

        return $next($request);
    }
}
