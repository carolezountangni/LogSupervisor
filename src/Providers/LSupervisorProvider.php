<?php

namespace Carolezountangni\LaravelLogSupervisor\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Octane\Events\RequestTerminated;
use Illuminate\Foundation\Http\Events\RequestHandled;
use carolezountangni\LogSupervisor\Console\Commands\PublishCommand;


class LSupervisorProvider extends ServiceProvider

{


    /** 
     * Enregistrer des services,des liaisons,des configurations etc..
     * 
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/src/routes/logs.php');
        $this->commands([
            PublishCommand::class
        ]);
    }
    /***
     * Chargez les routes,les vues ,les migrations ...
     */
    public function boot()
    {

        Route::middleware(['activity'])->group(function () {
            $this->loadRoutesFrom(__DIR__ . '/src/routes/logs.php');
        });
        // // Get namespace
        // $nameSpace = $this->app->getNamespace();

        // // Routes
        // $this->app->router->group(['namespace' => $nameSpace . 'Http\Controllers'], function () {
        //     require __DIR__ . '/Http/routes.php';
        // });

        // Views
        $this->publishes([
            __DIR__ . '/../resources/views' => base_path('resources/views'),
            __DIR__ . '/../Http/Middeleware' => base_path('app/Http/Middeleware'),
            __DIR__ . '/../Models' => base_path('app/Models'),
            __DIR__ . '/../Migrations' => base_path('database/migrations'),
        ]);
    }
}
