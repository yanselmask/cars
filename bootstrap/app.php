<?php

use App\Http\Middleware\CheckIfAppIsModeTest;
use App\Http\Middleware\ClearCacheEveryUpdate;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo(function(){
            return config('listing.vendor_path');
        });

        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
        ]);

        $middleware->web([
//            \App\Http\Middleware\CheckIfAppIsInstalled::class,
//            \Torann\Currency\Middleware\CurrencyMiddleware::class,
            \App\Http\Middleware\CheckIfAppIsModeTest::class,
            \App\Http\Middleware\ClearCacheEveryUpdate::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
