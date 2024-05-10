<?php

// declare(strict_types=1);

namespace carolezountangni\LogSupervisor;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use carolezountangni\LogSupervisor\Console\Commands\PublishCommand;


class LogSupervisorServiceProvider extends ServiceProvider

{


    /** 
     * Enregistrer des services,des liaisons,des configurations etc..
     * 
     */
    public function register()
    {
    }
    /***
     * Chargez les routes,les vues ,les migrations ...
     */
    public function boot()
    {

        // Publier les fichiers de configuration
        $this->publishes([
            __DIR__ . '/../config/log-supervisor.php' => config_path('log-supervisor.php'),
        ], 'config-ls');

        // Publier les fichiers de migration
        $this->publishes([
            __DIR__ . '/../database/migrations/log-supervisor' => database_path('migrations'),
        ], 'migrations-ls');
        // charger les migrations 
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations/log-supervisor');

        // Publier les fichiers de ressources
        $this->publishes([
            __DIR__ . '/../resources' => resource_path('views'),
        ], 'views-ls');



        // Chargement des vues depuis le répertoire du package
        $this->loadViewsFrom(__DIR__ . '/../resources', 'log-supervisor');
        //Publier les routes 
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }
}
