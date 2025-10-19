<?php

use App\Http\Middleware\PreventBackHistory;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\SystemIntegrityCheck;
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
        $middleware->append(RedirectIfAuthenticated::class);
        $middleware->append(PreventBackHistory::class);
        $middleware->append(SystemIntegrityCheck::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
