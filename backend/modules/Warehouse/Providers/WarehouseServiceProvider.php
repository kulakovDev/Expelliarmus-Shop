<?php

declare(strict_types=1);

namespace Modules\Warehouse\Providers;

use Illuminate\Support\ServiceProvider;

class WarehouseServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config.php', 'warehouse');

        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');

        $this->app->register(RouteServiceProvider::class);
    }
}