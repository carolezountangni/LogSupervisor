<?php


use carolezountangni\LaravelLogSupervisor\Http\Controllers\LogController;
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

Route::middleware(['auth'])->group(function () {
    Route::name('admin.')->group(function () {

        //Logs
        Route::get('/ls/admin/logs', [LogController::class, 'index'])->name('logs.index');
        Route::get('/ls/admin/logs/show', [LogController::class, 'show'])->name('logs.show');
        Route::get('/ls/admin/user/logs', [UserController::class, 'logs'])->name('user.logs');
    });
});
