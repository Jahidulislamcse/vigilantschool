<?php

namespace App\Providers;

use App\Models\Gallery;
use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        Paginator::useBootstrapFive();

        // Enforce HTTPS on production or when APP_URL is HTTPS (prevents cPanel mixed-content issues)
        if (str_starts_with((string) config('app.url'), 'https://') || app()->environment('production')) {
            URL::forceScheme('https');
        }

        View::composer('*', function ($view) {
            try {
                if (Schema::hasTable('settings')) {
                    $settings = Setting::getAllGrouped();
                    $view->with('settings', $settings);
                }
                if (Schema::hasTable('galleries')) {
                    $footerGalleries = Gallery::orderBy('order', 'asc')->take(6)->get();
                    $view->with('footerGalleries', $footerGalleries);
                }
            } catch (\Throwable $e) {
                // Safe fallback during setup/migrations
            }
        });
    }
}
