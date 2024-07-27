<?php

namespace App\Providers;

use App\Services\JobService;
use Illuminate\Support\ServiceProvider;

class JobProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(JobService::class, function ($app) {
            return new JobService();
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
