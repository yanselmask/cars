<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class ClearCacheEveryUpdate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (config('listing.cached') && ($request->isMethod('patch') || $request->method('post') || $request->method('update') || $request->method('put') || $request->method('delete'))) {
            Cache::flush();
        }

        return $next($request);
    }
}
