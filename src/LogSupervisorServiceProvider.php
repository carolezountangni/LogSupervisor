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
        // $this->publishes([
        //     __DIR__ . '/path/vers/le/dossier/de/configuration' => config_path('nom_du_fichier.php'),
        // ], 'config');

        // Publier les fichiers de migration
        // $this->publishes([
        //     __DIR__ . '/../database/migrations' => database_path('migrations'),
        // ], 'migrations');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        // Publier les fichiers de ressources
        // $this->publishes([
        //     __DIR__ . '/../resources' => resource_path('views/vendor/log-supervisor'),
        // ], 'views');

        $this->loadViewsFrom(
            __DIR__ . '/../resources/views',
            'log-supervisor'
        );
        //Publier les routes 
        // Route::namespace('carolezountangni\LogSupervisor\Http\Controllers')
        //     ->group(__DIR__ . '\routes\web.php');

        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }
}
