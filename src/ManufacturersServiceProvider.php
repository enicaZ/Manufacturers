<?php

namespace Enicaz\Seat\Manufacturers;

use Illuminate\Support\ServiceProvider;

class ManufacturersServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //$this->addCommands();
        $this->add_routes();
        // $this->add_middleware($router);
        $this->add_views();
        $this->add_publications();
        $this->add_translations();
    }

    /**
     * Include the routes.
     */
    public function add_routes()
    {
        if (! $this->app->routesAreCached()) {
            include __DIR__ . '/Http/routes.php';
        }
    }

    public function add_translations()
    {
        $this->loadTranslationsFrom(__DIR__ . '/lang', 'manufacturers');
    }

    /**
     * Set the path and namespace for the views.
     */
    public function add_views()
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'manufacturers');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/Config/manufacturers.config.php', 'manufacturers.config');

        $this->mergeConfigFrom(
            __DIR__ . '/Config/manufacturers.sidebar.php', 'package.sidebar');
        
        $this->mergeConfigFrom(
            __DIR__ . '/Config/manufacturers.corporation.menu.php', 'manufacturers.corporation.menu');

        $this->mergeConfigFrom(
            __DIR__ . '/Config/manufacturers.permissions.php', 'web.permissions');
    }

    public function add_publications()
    {
        $this->publishes([
            __DIR__ . '/database/migrations/' => database_path('migrations')
        ]);
    }

    private function addCommands()
    {
    }
}
