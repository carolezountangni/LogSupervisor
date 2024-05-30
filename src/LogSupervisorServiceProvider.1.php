<?php

namespace carolezountangni\LogSupervisor;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use carolezountangni\LogSupervisor\Http\Middleware\RoleMiddleware;
use Illuminate\Auth\Middleware\Authenticate;

class LogSupervisorServiceProvider extends ServiceProvider

{

    private string $name = 'log-supervisor';

    public static function basePath(string $path): string
    {
        return __DIR__ . '/..' . $path;
    }


    /***
     * Enregistrer des services,des liaisons,des configurations etc..
     */
    public function register()
    {
    }
    /***
     * Chargez les routes,les vues ,les migrations ...
     */
    public function boot()
    {
        // Ajoute le middleware 'auth' au groupe middleware global 'web'
        // $this->app['router']->pushMiddlewareToGroup('web', \Illuminate\Auth\Middleware\Authenticate::class);
        // $this->registerMiddleware();
        $this->LoadResources();
        $this->registerRoutes();
        $this->defineAssetPublishing();
    }

    /** Register the Log Supervisor middlewares */

    public function registerMiddleware()
    {

        // Charger la configuration de votre package
        $this->mergeConfigFrom(self::basePath('/config/log-supervisor.php'), 'log-supervisor');

        // Récupérer les middlewares définis dans la configuration
        // $middlewares = config('log-supervisor.middlewares');

        // Appliquer les middlewares globalement aux routes de votre package
        // foreach ($middlewares as $middleware) {
        //     $this->app['router']->pushMiddlewareToGroup('auth', $middleware);
        //     // $this->app['router']->aliasMiddleware('your-middleware', \Illuminate\Auth\Middleware\Authenticate::class);

        // }
    }
    /**
     * Register the Log Supervisor routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        //Chargement des routes depuis le répertoire du package
        Route::group($this->routeConfiguration(), function () {

            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        });
    }
    public function routeConfiguration()
    {
        return [
            'prefix' => 'log-supervisor',
            'middleware' => [RoleMiddleware::class, Authenticate::class], // Utiliser RoleMiddleware et Authenticate comme middlewares
            'namespace' => 'carolezountangni\LogSupervisor\Http\Controllers',
        ];
    }


    /**
     * Log Supervisor  publishing resources.
     *
     * @return void
     */

    protected function defineAssetPublishing()
    {

        // Publier les fichiers de configuration
        $this->publishes([
            self::basePath('/config/log-supervisor.php') => config_path('log-supervisor.php'),
        ], 'config-ls');

        // Publier les fichiers de migration
        $this->publishes([
            self::basePath('/database/migrations/log-supervisor') => database_path('migrations'),
        ], 'migrations-ls');

        $this->publishes(
            [
                self::basePath('/public') => public_path('vendor/log-supervisor'),
            ],
            'public-ls'
        );

        // Publier les fichiers de ressources
        // $this->publishes([
        //     self::basePath('/resources') => resource_path('views'),
        // ], 'views-ls');
    }
    /**
     * Load the resources.
     *
     * @return void
     */
    protected function LoadResources()
    {
        // Chargement des vues depuis le répertoire du package
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'log-supervisor');

        // Chargement des migrations depuis le répertoire du package 
        // $this->loadMigrationsFrom(__DIR__ . '/../database/migrations/log-supervisor');
    }
} #}
