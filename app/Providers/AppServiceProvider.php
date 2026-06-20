<?php

namespace App\Providers;

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
        view()->composer('*', function ($view) {
            try {
                $setting = \App\Models\Setting::first() ?? new \App\Models\Setting();
            } catch (\Exception $e) {
                $setting = new \App\Models\Setting();
            }
            $view->with('company', $setting);
        });
    }
}
