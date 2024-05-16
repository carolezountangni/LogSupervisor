<?php

// declare(strict_types=1);

namespace carolezountangni\LogSupervisor;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

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

        $this->LoadResources();
        $this->registerRoutes();
        $this->defineAssetPublishing();
    }
    /**
     * Register the Log Supervisor routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        //Chargement des routes depuis le répertoire du package
        Route::group($this->routeConfigutation(), function () {

            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        });
    }
    public function routeConfigutation()
    {

        return [
            'prefix' => 'log-supervisor',

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
}
