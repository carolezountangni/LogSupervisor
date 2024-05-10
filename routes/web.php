<?php


use carolezountangni\LogSupervisor\Controllers\LogController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::group(['namespace' => 'carolezountangni\LogSupervisor\Controllers'], function () {



    Route::middleware(['auth'])->group(function () {
        Route::name('admin.')->group(function () {

            //Logs
            Route::get('/log-supervisor/logs', [LogController::class, 'index'])->name('logs.index');
            Route::get('/log-supervisor/logs/show', [LogController::class, 'show'])->name('logs.show');
            Route::get('/log-supervisor/user/logs', [LogController::class, 'logs'])->name('user.logs');
        });
    });
});
