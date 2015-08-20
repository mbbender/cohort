<?php namespace Mbbender\Cohort;

use Illuminate\Auth\AuthManager;
use Illuminate\Bus\Dispatcher;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Support\ServiceProvider;
use Mbbender\Cohort\Handlers\Jobs\RegisterUserHandler;
use Mbbender\Cohort\Jobs\RegisterUser;
use Mbbender\Cohort\Services\DoctrineUserProvider;
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

        // Extend the user provider
        $this->app[AuthManager::class]->extend('doctrine', function ($app) {

            $hasher = $app[Hasher::class];
            $em = $app['em'];
            $entity = $app['config']['auth.model'];

            return new DoctrineUserProvider($hasher, $em, $entity);

        });

    }

}