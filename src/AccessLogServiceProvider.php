<?php

namespace AnnaNovas\AccessLog;

use Illuminate\Support\ServiceProvider;

class AccessLogServiceProvider extends ServiceProvider
{

    /**
     * The middlewares to be registered.
     *
     * @var array
     */
    protected $middlewares = [
        'accesslog' => \AnnaNovas\AccessLog\Http\middlewares\AccessLogMiddleware::class,
    ];


    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'accesslog');
        $this->loadMigrationsFrom(__DIR__.'/Database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');

        $this->registerMiddlewares();

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/accesslog.php', 'accesslog');

        // Register the service the package provides.
        $this->app->singleton('accesslog', function ($app) {
            return new AccessLog;
        });
    }


    /**
     * Register the middlewares automatically.
     *
     * @return void
     */
    protected function registerMiddlewares()
    {

        $router = $this->app['router'];
        $middlewareGroups = $router->getMiddlewareGroups();
        
        if (method_exists($router, 'middleware')) {
            $registerMethod = 'middleware';
        } elseif (method_exists($router, 'aliasMiddleware')) {
            $registerMethod = 'aliasMiddleware';
        } else {
            return;
        }
        
        foreach ($this->middlewares as $key => $class) {
            $router->$registerMethod($key, $class);
            foreach($middlewareGroups as $gkey=>$data){
                $router->pushMiddlewareToGroup($gkey, $class);
            }
        }

    }


    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['accesslog'];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/accesslog.php' => config_path('accesslog.php'),
        ], 'accesslog.config');

        // Publishing the views.
        $this->publishes([
            __DIR__.'/resources/views' => base_path('/resources/views/vendor/accesslog'),
        ], 'accesslog.views');

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/annanovas'),
        ], 'accesslog.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/annanovas'),
        ], 'accesslog.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
