<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use carolezountangni\LogSupervisor\Http\Controllers\LogController;
use carolezountangni\LogSupervisor\Http\Middleware\RoleMiddleware;

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


// Route::middleware(['roleMiddleware'])->group(function () {

// Route::get('/', 'LogController@index')->name('lg.logs.index')->middleware('');
// Route::get('/show/{id}', 'LogController@show')->name('lg.logs.show')->middleware('');
// Route::get('/utilisateurs/{id}/activities', 'LogController@logs')->name('lg.logs.logs')->middleware('');

// });


Route::get('/', [LogController::class, 'index'])->name('lg.logs.index')->middleware('');
Route::get('/show/{id}', [LogController::class, 'show'])->name('lg.logs.show')->middleware('');
Route::get('/utilisateurs/{id}/activities', [LogController::class, 'logs'])->name('lg.logs.logs')->middleware('');
