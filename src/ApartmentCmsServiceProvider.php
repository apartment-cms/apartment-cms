<?php

namespace Graemekilkenny\ApartmentCMS;

use Illuminate\Support\ServiceProvider;

class ApartmentCmsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/Migrations');
        $this->loadViewsFrom(__DIR__.'/Views', 'apartment-cms');

        $this->publishes([
            __DIR__.'/Views' => resource_path('views/vendor/apartment-cms'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__.'/routes.php';
        $this->app->make('Graemekilkenny\ApartmentCMS\Controllers\PageController');
    }
}