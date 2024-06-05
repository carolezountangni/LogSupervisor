<?php


return [
    'key' => 'log-supervisor',
    'role' => 'ROLE_ADMIN',


    /*
    |--------------------------------------------------------------------------
    | Log Supervisor
    |--------------------------------------------------------------------------
    | Log Supervisor can be disabled, so it's no longer accessible via browser.
    |
    */

    'enabled' => env('LOG_SUPERVISOR_ENABLED', true),

    'api_only' => env('LOG_SUPERVISOR_API_ONLY', false),

    'require_auth_in_production' => true,

    /*
    |--------------------------------------------------------------------------
    | Log Supervisor Domain
    |--------------------------------------------------------------------------
    | You may change the domain where Log Supervisor should be active.
    | If the domain is empty, all domains will be valid.
    |
    */

    'route_domain' => null,

    /*
    |--------------------------------------------------------------------------
    | Log Supervisor Route
    |--------------------------------------------------------------------------
    | Log Supervisor will be available under this URL.
    |
    */

    'route_path' => env('PACKAGE_ROUTE_PATH', 'log-supervisor'),
    // 'middlewares' => ['auth', 'my_custom_middleware'],
    'prefix' => env('MY_PACKAGE_PREFIX', 'log-supervisor'),
    'middlewares' => explode(',', env('MY_PACKAGE_MIDDLEWARES', 'auth')),

    /*
    |--------------------------------------------------------------------------
    | Back to system URL
    |--------------------------------------------------------------------------
    | When set, displays a link to easily get back to this URL.
    | Set to `null` to hide this link.
    |
    | Optional label to display for the above URL.
    |
    */

    'back_to_system_url' => config('app.url', null),

    'back_to_system_label' => config('app.name'), // Displayed by default: "Back to {{ app.name }}"

    /*
    |--------------------------------------------------------------------------
    | Log Supervisor time zone.
    |--------------------------------------------------------------------------
    | The time zone in which to display the times in the UI. Defaults to
    | the application's timezone defined in config/app.php.
    |
    */

    'timezone' => null,

    /*
    |--------------------------------------------------------------------------
    | Log Supervisor route middleware.
    |--------------------------------------------------------------------------
    | Optional middleware to use when loading the initial Log Supervisor page.
    |
    */

    'middleware' => [

        \carolezountangni\LogSupervisor\Http\Middleware\Activity::class,
        \carolezountangni\LogSupervisor\Http\Middleware\RoleMiddleware::class,

    ],


];
