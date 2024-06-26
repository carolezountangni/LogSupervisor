<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use carolezountangni\LogSupervisor\Http\Controllers\LogController;
use carolezountangni\LogSupervisor\Http\Middleware\RoleMiddleware;

// Route::prefix(Config('log-supervisor.prefix'))->middleware(config('log-supervisor.middlewares'))->group(function () {


Route::get('/', 'LogController@index')->name('lg.logs.index');
Route::get('/show/{id}', 'LogController@show')->name('lg.logs.show');
Route::get('/utilisateurs/{id}/activities', 'LogController@logs')->name('lg.logs.logs');
// });


// Route::get('/', [LogController::class, 'index'])->name('lg.logs.index')->middleware('');
// Route::get('/show/{id}', [LogController::class, 'show'])->name('lg.logs.show')->middleware('');
// Route::get('/utilisateurs/{id}/activities', [LogController::class, 'logs'])->name('lg.logs.logs')->middleware('');
