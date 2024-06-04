<?php

namespace carolezountangni\LogSupervisor\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see carolezountangni\LogSupervisor\SupervisorService
 *
 * @method static string version()
 * @method static string timezone()
 * @method static string getRoutePrefix()
 * @method static void auth($callback = null)
 */
class LogSupervisor extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'log-supervisor';
    }
}
