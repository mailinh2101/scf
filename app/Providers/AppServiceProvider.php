<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\SiteSetting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Use Bootstrap 4 pagination view
        Paginator::useBootstrap();

        // Share site settings with all views
        View::composer('*', function ($view) {
            $siteSettings = SiteSetting::pluck('value', 'key')->toArray();
            $view->with('siteSettings', $siteSettings);
        });
    }
}
