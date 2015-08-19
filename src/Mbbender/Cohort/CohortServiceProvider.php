<?php namespace Mbbender\Cohort;

use Illuminate\Support\ServiceProvider;

class CohortServiceProvider extends ServiceProvider{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // TODO: Implement register() method.
    }

    public function boot()
    {
        // Require Routes
        if (! $this->app->routesAreCached()) {
            require __DIR__.'/../../routes.php';
        }

        // Load Views
        $this->loadViewsFrom(__DIR__.'/path/to/views', 'cohort');

    }
}