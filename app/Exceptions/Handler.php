<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Routing\Exceptions\InvalidSignatureException;
use Illuminate\Support\Facades\Log;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->reportable(function (InvalidSignatureException $e) {
            Log::warning('Invalid signed URL', [
                'full_url'    => request()->fullUrl(),
                'method'      => request()->method(),
                'host'        => request()->getHost(),
                'scheme'      => request()->getScheme(),
                'port'        => request()->getPort(),
                'app_url'     => config('app.url'),
                'trusted_proxies' => env('TRUSTED_PROXIES'),
                'user_id'     => optional(request()->user())->id,
            ]);
        });
    }
}
