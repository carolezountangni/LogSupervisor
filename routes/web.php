<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;

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

// // Récupérer les rôles autorisés depuis la configuration
// $rolesAutorises = Config::get('log-supervisor.roles');
// $user = Auth::user();
// // dd($user);
// // dd(in_array(Auth::user()->getRole(), $rolesAutorises));
// // Vérifier si l'utilisateur actuel possède l'un des rôles autorisés
// if (Auth::check() && in_array(Auth::user()->getRole(), $rolesAutorises)) {

//     Route::get('/test', 'ouuuii')->name('lg.logs.tests');
// } else {
//     // Rediriger ou renvoyer une erreur d'accès
//     // abort(404, 'Page non trouvée');
// }

// L'utilisateur a accès à la fonctionnalité
// Route::middleware(['auth'])->group(
//     function () {
// Route::middleware([\carolezountangni\LogSupervisor\Http\Middleware\RoleMiddleware::class])->group(
//     function () {
Route::middleware(['roleMiddleware', 'auth'])->group(
    function () {

        Route::get('/', 'LogController@index')->name('lg.logs.index');
        Route::get('/show/{id}', 'LogController@show')->name('lg.logs.show');
        Route::get('/utilisateurs/{id}/activities', 'LogController@logs')->name('lg.logs.logs');
        //     }
    }
);
