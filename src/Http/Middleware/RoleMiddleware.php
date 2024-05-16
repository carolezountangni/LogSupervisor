<?php

namespace carolezountangni\LogSupervisor\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use carolezountangni\LogSupervisor\Repositories\ActivityRepository;
use Illuminate\Support\Facades\Config;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        $allowedRoles = Config::get('log-supervisor.roles.' . $role, []);

        if (!Auth::check() || !Auth::user()->hasAnyRole($allowedRoles)) {
            abort(403, 'Accès non autorisé.');
        }

        return $next($request);
    }
}
