<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * Intentionally left blank: there are no container bindings
     * or singletons to register at the moment. All bootstrapping
     * that we need happens in boot().
     */
    public function register(): void
    {
        // No bindings to register for now.
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force HTTPS URLs on production (Render terminates TLS at proxy)
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
