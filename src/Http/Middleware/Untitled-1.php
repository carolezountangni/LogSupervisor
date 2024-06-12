<?php

namespace carolezountangni\LogSupervisor\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use carolezountangni\LogSupervisor\Repositories\ActivityRepository;

class Activity
{
    protected $activityRepo;

    public function __construct(ActivityRepository $activityRepo)
    {
        $this->activityRepo = $activityRepo;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        $tostore = $this->makeRequest($request);
        $activity = $this->activityRepo->makeStore($tostore);
        if (!$activity) {
            return back()->with('error', 'L\'action a échoué, veuillez réessayer !');
        }
        return $response;
    }

    /**
     * Create a request log array from the given request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function makeRequest(Request $request)
    {

        $user = Auth::user();
        $role = $user ? $user->role : null;
        $id = $user ? $user->id : null;


        $ipAddress = $request->ip();
        $attributes = $request->all();

        // Correction pour obtenir l'action de la route
        $action = $request->route()->getAction();
        $actionUses = isset($action['uses']) && is_string($action['uses']) ? $action['uses'] : 'Action inconnue';


        // Correction pour obtenir le nom de la route
        $routeName = $request->route()->getName() ?? null;

        return [
            'action' => $actionUses,
            'description' => null,
            'role' => $role,
            'group' => null,
            'user_agent' => $request->header('User-Agent'),
            'route' => $routeName,
            'referrer' => $request->header('referer'),
            'method' => $request->method(),
            'locale' => $request->header('Accept-Language'),
            'user_id' => $id,
            'ip_address' => $ipAddress,
            'attributes' => $attributes
        ];
    }
}
