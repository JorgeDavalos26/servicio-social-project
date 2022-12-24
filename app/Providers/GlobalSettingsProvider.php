<?php

namespace App\Providers;

use App\Services\GlobalSettingsService;
use App\Services\GlobalSettingsServiceInterface;
use Illuminate\Support\ServiceProvider;

class GlobalSettingsProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(GlobalSettingsService::class, function ($app) {
            return new GlobalSettingsService("Settings Service");
        });

        $this->app->bind(GlobalSettingsServiceInterface::class, GlobalSettingsService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        
    }
}
