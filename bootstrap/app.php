<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

// Konfigurasi otomatis untuk Vercel Serverless (Read-only filesystem)
if (isset($_SERVER['VERCEL']) || isset($_ENV['VERCEL']) || getenv('VERCEL')) {
    $app->useStoragePath('/tmp/storage');
    @mkdir('/tmp/storage/framework/views', 0755, true);
    @mkdir('/tmp/storage/framework/sessions', 0755, true);
    @mkdir('/tmp/storage/framework/cache', 0755, true);
    @mkdir('/tmp/storage/logs', 0755, true);
}

return $app;
