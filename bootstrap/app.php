<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Sentry\Laravel\Integration;
use Illuminate\Routing\Exceptions\InvalidSignatureException;
use Illuminate\Support\Facades\Log;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Доверяем прокси (Render) + учитываем стандартные заголовки
        $middleware->trustProxies(
            at: ['*'],
            headers: \Illuminate\Http\Request::HEADER_X_FORWARDED_FOR
            | \Illuminate\Http\Request::HEADER_X_FORWARDED_HOST
            | \Illuminate\Http\Request::HEADER_X_FORWARDED_PORT
            | \Illuminate\Http\Request::HEADER_X_FORWARDED_PROTO
            | \Illuminate\Http\Request::HEADER_X_FORWARDED_AWS_ELB
        );
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Интеграция с Sentry
        Integration::handles($exceptions);

        // Логируем ошибки подписи
        $exceptions->report(function (InvalidSignatureException $e) {
            Log::warning('Invalid signed URL', [
                'full_url' => request()->fullUrl(),
                'method'   => request()->method(),
                'host'     => request()->getHost(),
                'scheme'   => request()->getScheme(),
                'port'     => request()->getPort(),
                'app_url'  => config('app.url'),
                'user_id'  => optional(request()->user())->id,
            ]);
        });
    })
    ->create();
