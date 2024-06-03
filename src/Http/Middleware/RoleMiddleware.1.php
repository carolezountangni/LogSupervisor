<?php

namespace carolezountangni\LogSupervisor\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Routing\RouteName;

class RoleMiddleware
{
    public function handle($request, Closure $next)
    {
        // Vérifier si l'utilisateur est authentifié
        if (!Auth::check()) {
            // Rediriger vers la page de connexion
            return redirect()->route('login');
        }

        // Obtenir le rôle défini dans le fichier de configuration du package
        $allowedRole = Config::get('log-supervisor.role');

        // Vérifier si le rôle autorisé est défini dans la configuration
        if (!$allowedRole) {
            // Si le rôle autorisé n'est pas défini, retourner une erreur 500
            return abort(500, 'Role non défini dans la configuration.');
        }

        // Vérifier si l'utilisateur a le rôle autorisé
        $userRole = Auth::user()->role;

        if (!$userRole || $userRole !== $allowedRole) {
            // Si l'utilisateur n'a pas le rôle autorisé, retourner une erreur 403
            return abort(403, 'Accès non autorisé.');
        }

        // L'utilisateur a le rôle autorisé, continuer la requête
        return $next($request);
    }
}
