<?php namespace Mbbender\Cohort;

use Illuminate\Bus\Dispatcher;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Support\ServiceProvider;
use Mbbender\Cohort\Handlers\Jobs\RegisterUserHandler;
use Mbbender\Cohort\Jobs\RegisterUser;
use  Mbbender\Cohort\Services\GenericRegistrar;

class CohortServiceProvider extends ServiceProvider{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Registrar::class, GenericRegistrar::class);
    }

    public function boot(Dispatcher $dispatcher)
    {
        // Add command handlers to bus
        $commands = [
           RegisterUser::class => RegisterUserHandler::class
        ];
        $dispatcher->maps($commands);

        // Require Routes
        if (! $this->app->routesAreCached()) {
            require __DIR__.'/../../routes.php';
        }

        // Load Views
        $this->loadViewsFrom(__DIR__.'/../../views', 'cohort');

    }

}