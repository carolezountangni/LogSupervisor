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
        if ($user == null) {
            $role = null;
            $id = null;
        } else {
            $role = $user->role;
            $id = $user->id;
        }

        // $platform = $agent->platform();
        // $device = $agent->device();
        $ipAddress = $request->ip();
        $attributes = $request->all();
        return [
            'action' => $request->route()->action['uses'] ?? null,
            'description' => null,
            'role' => $role,
            'group' => null,
            'user_agent' => $request->header('User-Agent'),
            'route' => $request->route()->action['as'] ?? null,
            'referrer' => $request->header('referer'),
            'method' => $request->method(),
            'locale' => $request->server('HTTP_ACCEPT_LANGUAGE'),
            'user_id' => $id,
            // 'platform' => $platform,
            // 'device' => $device,
            'ip_address' => $ipAddress,
            'attributes' => $attributes
        ];
    }
}
