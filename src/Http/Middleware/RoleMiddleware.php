<?php

namespace carolezountangni\LogSupervisor\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use carolezountangni\LogSupervisor\Repositories\ActivityRepository;
use Illuminate\Support\Facades\Config;

class RoleMiddleware
{
    public function handle($request, Closure $next)
    {
        // Vérifier si l'utilisateur est authentifié
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Obtenir les rôles définis dans le fichier de configuration du package
        $allowedRoles = Config::get('log-supervisor.roles');
        dd($allowedRoles);
        // $allowedRoles = ['ROLE_ADMIN'];

        // Vérifier si l'utilisateur a l'un des rôles autorisés

        if (Auth::user()->hasAnyRole($allowedRoles)) {
            return $next($request);
        }

        // Redirection ou réponse en cas d'accès refusé
        return abort(403, 'Unauthorized action.');
    }
}
