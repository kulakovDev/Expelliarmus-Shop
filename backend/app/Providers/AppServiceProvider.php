<?php

namespace App\Providers;

use App\Services\CacheService;
use Clockwork\Support\Laravel\ClockworkServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
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

        $this->app->singleton(CacheService::class, function (Application $app) {
            return new CacheService($app->get('cache.store'));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
