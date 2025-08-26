<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Setting;

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
        // Share settings with all views
        View::composer('*', function ($view) {
            $view->with('siteSettings', Setting::getPublic());
        });

        // Add helper function
        if (!function_exists('setting')) {
            function setting($key, $default = null) {
                return Setting::get($key, $default);
            }
        }
    }
}
