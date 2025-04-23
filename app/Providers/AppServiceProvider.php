<?php

namespace App\Providers;

use Livewire\Livewire;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        $basePath = parse_url(config('app.url'), PHP_URL_PATH) ?: '';
        
        Livewire::setScriptRoute(function ($handle) use ($basePath) {
            return Route::get($basePath . '/livewire/livewire.js', $handle);
        });
        
        Livewire::setUpdateRoute(function ($handle) use ($basePath) {
            return Route::post($basePath . '/livewire/update', $handle);
        });
        
    }
}
