<?php

namespace App\Providers;

use App\Services\ProfileService;
use Illuminate\Support\ServiceProvider;

class ProfileProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(ProfileService::class, function ($app) {
            return new ProfileService();
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
