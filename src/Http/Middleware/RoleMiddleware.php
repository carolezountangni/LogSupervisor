<?php

namespace carolezountangni\LogSupervisor\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use carolezountangni\LogSupervisor\Interfaces\AuthenticationInterface;
use carolezountangni\LogSupervisor\CustomAuthentication;

class RoleMiddleware
{


    public function __construct(CustomAuthentication $customAuth)
    {
        $this->customAuth = $customAuth;
        $this->allowedRole = Config::get('log-supervisor.role');
    }

    public function handle(Request $request, Closure $next)
    {
        // Vérifier si l'utilisateur a le rôle spécifié
        if (!$this->customAuth->hasRole($this->allowedRole)) {
            // Si l'utilisateur n'a pas le rôle, retourner une réponse d'erreur
            abort(403, "Accès refusé. Vous n'avez pas le bon rôle.");
        }

        // Si l'utilisateur a le bon rôle, continuer le traitement de la requête
        return $next($request);
    }


    // public function handle($request, Closure $next)
    // {
    //     $role = 'ROLE_ADMIN';
    //     $result = $this->auth->hasRole($role);

    //     // if (Auth::check()) {
    //     if ($result === true) {

    //         // // L'utilisateur est connecté
    //         // // Obtenir le rôle défini dans le fichier de configuration du package
    //         // $allowedRole = Config::get('log-supervisor.role');

    //         // // Vérifier si le rôle autorisé est défini dans la configuration
    //         // if (!$allowedRole) {
    //         //     // Si le rôle autorisé n'est pas défini, retourner une réponse d'erreur appropriée
    //         //     return response()->json(['error' => 'Role non défini dans la configuration.'], 500);
    //         // }

    //         // // Vérifier si l'utilisateur a le rôle autorisé
    //         // $userRole = Auth::user()->role;

    //         // if (!$userRole || $userRole !== $allowedRole) {
    //         //     // Si l'utilisateur n'a pas le rôle autorisé, retourner une réponse d'erreur appropriée
    //         //     return response()->json(['error' => 'Accès non autorisé.'], 403);
    //         // }

    //         // L'utilisateur a le rôle autorisé, continuer la requête
    //         return $next($request);
    //     } else {
    //         abort(404, "Vous devez être connecté pour accéder à cette fonctionnalité.");
    //     }
    // }
}
