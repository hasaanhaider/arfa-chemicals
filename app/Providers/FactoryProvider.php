<?php

namespace App\Providers;

use App\Services\FactoryService;
use Illuminate\Support\ServiceProvider;

class FactoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(FactoryService::class, function ($app) {
            return new FactoryService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
