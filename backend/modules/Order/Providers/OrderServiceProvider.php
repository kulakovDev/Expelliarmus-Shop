<?php

declare(strict_types=1);

namespace Modules\Order\Providers;

use Illuminate\Support\ServiceProvider;

class OrderServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config.php', 'orders');

        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');

        $this->app->register(RouteServiceProvider::class);
    }
}