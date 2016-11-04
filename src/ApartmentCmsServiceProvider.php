<?php

namespace ApartmentCMS\ApartmentCMS;

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
            __DIR__.'/Config/apartment.php' => config_path('apartment.php'),
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
        $this->app->make('ApartmentCMS\ApartmentCMS\Controllers\PageController');

        $this->app->register(\Yab\Laracogs\LaracogsProvider::class);
    }
}
