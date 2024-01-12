<?php

namespace App\Providers;

use App\Models\Settings;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if (Schema::hasTable('settings') && app()->runningInConsole() === false) {
            // Fetch settings from the database
            $settings = Settings::first();

            // Share settings with all views
            view()->share('settings', $settings);
        }
    }
}
