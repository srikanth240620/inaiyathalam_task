<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    // ->withRouting(
    //     using: function () {
    //         Route::middlewareGroup('api', [
    //             \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
    //             'throttle:api',
    //             \Illuminate\Routing\Middleware\SubstituteBindings::class,
    //         ]);
    //     }
    // )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();