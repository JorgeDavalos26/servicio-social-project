<?php

namespace App\Providers;

use App\Services\SettingsService;
use App\Services\SettingsServiceInterface;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SettingsService::class, function ($app) {
            return new SettingsService("Settings Service");
        });

        $this->app->bind(SettingsServiceInterface::class, SettingsService::class);
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
