<?php

namespace carolezountangni\LogSupervisor\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use carolezounatngni\LogSupervisor\Interfaces\AuthenticationInterface;

class RoleMiddleware
{

    public function __construct(AuthenticationInterface $auth)
    {

        $this->auth = $auth;
    }
    public function handle($request, Closure $next)
    {

        // if ($this->auth->attemptLogin($request->only('email', 'password'))) {
        if ($this->auth->hasRole()) {

            // if (Auth::check()) {
            // L'utilisateur est connecté
            // Obtenir le rôle défini dans le fichier de configuration du package
            // $allowedRole = Config::get('log-supervisor.role');

            // Vérifier si le rôle autorisé est défini dans la configuration
            // if (!$allowedRole) {
            //     // Si le rôle autorisé n'est pas défini, retourner une réponse d'erreur appropriée
            //     return response()->json(['error' => 'Role non défini dans la configuration.'], 500);
            // }

            // Vérifier si l'utilisateur a le rôle autorisé
            // if ($this->auth->hasRole()) {
            // $userRole = Auth::user()->role;

            // if (!$userRole || $userRole !== $allowedRole) {
            //     // Si l'utilisateur n'a pas le rôle autorisé, retourner une réponse d'erreur appropriée
            //     return response()->json(['error' => 'Accès non autorisé.'], 403);
            // }

            // L'utilisateur a le rôle autorisé, continuer la requête
            return $next($request);
        } else {
            abort(404, "Vous devez être connecté pour accéder à cette fonctionnalité.");
        }
    }
}
