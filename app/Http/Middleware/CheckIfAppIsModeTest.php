<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIfAppIsModeTest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (env('APP_MODE_TEST') && ($request->method('update') || $request->method('put') || $request->method('delete'))) {
            return back()->with(['flash' => __('You can\'t do this in test mode')]);
        }

        return $next($request);
    }
}
