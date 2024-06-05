<?php

namespace carolezountangni\LogSupervisor;

use carolezountangni\LogSupervisor\Interfaces\AuthenticationInterface;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Response;

class CustomAuthentication implements AuthenticationInterface
{
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function attemptLogin($credentials)
    {
        return $this->auth->attempt($credentials);
    }

    public function logout()
    {
        $this->auth->logout();
    }

    public function user()
    {
        return $this->auth->user();
    }

    public function hasRole($role)
    {
        $user = $this->auth->user();

        if (!$user) {
            return false;
        }

        // Obtenir le rôle autorisé à partir de la configuration
        $allowedRole = Config::get('log-supervisor.role');

        // Si le rôle autorisé n'est pas défini, retourner une erreur 404
        if (!$allowedRole) {
            abort(404, "Role non défini dans la configuration.");
        }

        // Vérifiez si l'utilisateur a le rôle spécifié
        if ($user->role === $allowedRole) {
            return true;
        }

        // Si l'utilisateur n'a pas le rôle spécifié, retourner une erreur 404
        abort(404, "Accès non autorisé.");
    }
}
