<?php

namespace App\Providers;
use Livewire\Livewire;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
      
        // Fix Livewire routes to work with Laravel Localization
        Livewire::setUpdateRoute(function ($handle) {
            $locale = request()->segment(1); // Get locale from URL
            if (in_array($locale, ['ar', 'en'])) {
                return Route::post("/{$locale}/livewire/update", $handle)
                    ->middleware(['web', 'auth']);
            }
        App::setLocale(LaravelLocalization::getCurrentLocale());
            // Fallback for default locale
            return Route::post("/en/livewire/update", $handle)
                ->middleware(['web', 'auth']);
           
        });
      
    }

    
}
