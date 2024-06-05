<?php

namespace carolezounatngni\LogSupervisor\Interfaces;

interface AuthenticationInterface
{
    public function attemptLogin($credentials);
    public function logout();
    public function user();
    public function hasRole($role);
}
