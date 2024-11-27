<?php

use Domain\Shared\Middleware\CustomTokenAuth;
use Domain\Shared\Middleware\EnsureHasAbility;
use Domain\Shared\Middleware\EnsureValidApiAccessToken;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,

        ]);

        $middleware->alias(['token.auth' => CustomTokenAuth::class]);

        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();