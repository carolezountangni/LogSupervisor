<?php

namespace carolezountangni\LogSupervisor\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class RoleMiddleware
{
    public function handle($request, Closure $next)
    {
        // Vérifier si l'utilisateur est authentifié
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Obtenir le rôle défini dans le fichier de configuration du package
        $allowedRole = Config::get('log-supervisor.role');

        // Vérifier si l'utilisateur a le rôle autorisé
        // if (Auth::user()->hasRole($allowedRole)) {
        // if (Auth::user()->role === $allowedRole) {
        if (Auth::user()->role === Config::get('log-supervisor.role')) {
            // Vérifiez le rôle de l'utilisateur

            return $next($request);
        }

        // Redirection ou réponse en cas d'accès refusé
        return abort(403, 'Unauthorized action.');
    }
}
