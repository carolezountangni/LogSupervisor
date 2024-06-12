<?php

namespace carolezountangni\LogSupervisor\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route; // Ajout de l'importation de la classe Route
use carolezountangni\LogSupervisor\Repositories\ActivityRepository;

class Activity
{
    protected $activityRepo;

    public function __construct(ActivityRepository $activityRepo)
    {
        $this->activityRepo = $activityRepo;
    }

    /**
     * Intercepte une demande entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        $toStore = $this->makeRequest($request);

        // Vérifier si toutes les valeurs ne sont pas vides
        if ($this->hasNoEmptyValues($toStore)) {
            $activity = $this->activityRepo->makeStore($toStore);
            if (!$activity) {
                return back()->with('error', 'L\'action a échoué, veuillez réessayer !');
            }
        }

        return $response;
    }

    /**
     * Vérifie si toutes les valeurs dans le tableau donné ne sont pas vides.
     *
     * @param  array  $array
     * @return bool
     */
    protected function hasNoEmptyValues($array)
    {
        foreach ($array as $value) {
            // Vérifier si la valeur est vide
            if ($value === '') {
                return false;
            }
        }
        return true;
    }

    /**
     * Crée un tableau de journalisation à partir de la demande donnée.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function makeRequest(Request $request)
    {
        // Vérifie si $request est une instance de Request
        if ($request instanceof Request) {
            $user = Auth::user();
            $role = $user ? $user->role : null;
            $id = $user ? $user->id : null;

            $ipAddress = $request->ip();
            $attributes = $request->all();

            // Correction pour obtenir l'action de la route
            if (Route::has($request->route()->getName())) {
                $action = $request->route()->getAction();
                $actionUses = isset($action['uses']) && is_string($action['uses']) ? $action['uses'] : 'Action inconnue';
            } else {
                $actionUses = 'Action inconnue';
            }

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
        } else {
            return [];
        }
    }
}
