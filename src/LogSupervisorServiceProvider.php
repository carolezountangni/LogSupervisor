<?php

namespace carolezountangni\LogSupervisor;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use carolezountangni\LogSupervisor\Http\Middleware\RoleMiddleware;
use Illuminate\Auth\Middleware\Authenticate;

class LogSupervisorServiceProvider extends ServiceProvider
{
    /**
     * Get the base path of the package.
     *
     * @param  string  $path
     * @return string
     */
    public static function basePath(string $path): string
    {
        return __DIR__ . '/../' . $path;
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Register any package services.
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerRoutes();
        // $this->registerMiddleware();
        $this->loadResources();
        $this->defineAssetPublishing();
    }

    public function registerMiddleware()
    {
        // Charger la configuration de votre package
        $this->mergeConfigFrom(self::basePath('/config/log-supervisor.php'), 'log-supervisor');

        // Récupérer les middlewares définis dans la configuration
        $middlewares = config('log-supervisor.middlewares');

        // Charger les routes du package
        $this->registerRoutes();

        // $this->loadRoutesFrom(__DIR__ . '/path/to/your/routes.php');

        // Appliquer les middlewares aux routes du package
        foreach ($middlewares as $middleware) {
            $this->app['router']->middleware($middleware);
        }
    }



    /**
     * Load the package resources.
     *
     * @return void
     */
    protected function loadResources()
    {
        try {
            $this->loadViewsFrom(self::basePath('resources/views'), 'log-supervisor');
        } catch (\Throwable $e) {
            // Handle view loading error
            \Log::error('Failed to load views: ' . $e->getMessage());
        }
    }

    /**
     * Register the package routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        try {
            Route::group($this->routeConfiguration(), function () {
                $this->loadRoutesFrom(self::basePath('routes/web.php'));
            });
        } catch (\Throwable $e) {
            // Handle route registration error
            \Log::error('Failed to register routes: ' . $e->getMessage());
        }
    }

    /**
     * Get the route group configuration array.
     *
     * @return array
     */
    protected function routeConfiguration()
    {
        return [
            'prefix' => 'log-supervisor',
            // 'middleware' => [RoleMiddleware::class, Authenticate::class],
            'namespace' => 'carolezountangni\LogSupervisor\Http\Controllers',
        ];
    }

    /**
     * Define asset publishing.
     *
     * @return void
     */
    protected function defineAssetPublishing()
    {
        try {
            $this->publishes([
                self::basePath('config/log-supervisor.php') => config_path('log-supervisor.php'),
            ], 'config-ls');

            $this->publishes([
                self::basePath('database/migrations') => database_path('migrations'),
            ], 'migrations-ls');

            $this->publishes([
                self::basePath('public') => public_path('vendor/log-supervisor'),
            ], 'public-ls');
        } catch (\Throwable $e) {
            // Handle asset publishing error
            \Log::error('Failed to publish assets: ' . $e->getMessage());
        }
    }
}
