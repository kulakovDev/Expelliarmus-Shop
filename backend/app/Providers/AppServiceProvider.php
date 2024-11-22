<?php

namespace App\Providers;

use Clockwork\Support\Laravel\ClockworkServiceProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->hasDebugModeEnabled() && ! $this->app->isProduction()) {
            $this->app->register(ClockworkServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
