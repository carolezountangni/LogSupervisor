<?php

namespace carolezountangni\LogSupervisor;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use carolezountangni\LogSupervisor\Http\Middleware\RoleMiddleware;
use Illuminate\Auth\Middleware\Authenticate;
use carolezountangni\LogSupervisor\CustomAuthentication;
use carolezountangni\LogSupervisor\Interfaces\AuthenticationInterface;
use Illuminate\Support\Facades\Log;

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
        // $this->authUser();
        // $this->registerMiddleware();
        $this->loadResources();
        $this->defineAssetPublishing();
    }

    public function authUser()
    {

        $this->app->singleton(AuthenticationInterface::class, function ($app) {
            return new CustomAuthentication($app->make(\Illuminate\Contracts\Auth\Factory::class));
        });
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

        //$this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        try {
            $this->loadViewsFrom(self::basePath('resources/views'), 'log-supervisor');
        } catch (\Exception $e) {
            // Enregistrer l'erreur dans les logs
            Log::error('Une erreur est survenue lors du chargement des ressources : ' . $e->getMessage());
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
        } catch (\Exception $e) {
            // Enregistrer l'erreur dans les logs
            Log::error('Une erreur est survenue lors du chargement des routes : ' . $e->getMessage());
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
            'prefix' => config('log-supervisor.prefix'),
            // 'middleware' => [RoleMiddleware::class, Authenticate::class],
            // 'middleware' => Config('log-supervisor.middlewares'),
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
        } catch (\Exception $e) {
            Log::error('Une erreur est survenue lors de la publication du fichier de configuration : ' . $e->getMessage());
        }

        try {
            $this->publishes([
                self::basePath('database/migrations') => database_path('migrations'),
            ], 'migrations-ls');
        } catch (\Exception $e) {
            Log::error('Une erreur est survenue lors de la publication des migrations : ' . $e->getMessage());
        }

        try {
            $this->publishes([
                self::basePath('public') => public_path('vendor'),
            ], 'public-ls');
        } catch (\Exception $e) {
            Log::error('Une erreur est survenue lors de la publication des ressources publiques : ' . $e->getMessage());
        }
    }
}
