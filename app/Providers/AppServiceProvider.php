<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind('Setting', \App\Models\Setting::class);
    }

    public function boot(): void
    {
        // Setting facade alias — view'larda Setting::get() çalışsın
        if (!class_exists('Setting', false)) {
            class_alias(\App\Models\Setting::class, 'Setting');
        }
    }
}
