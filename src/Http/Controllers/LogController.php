<?php

namespace carolezountangni\LogSupervisor\Http\Controllers;

use App\Models\User;
// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Routing\Controller;
use carolezountangni\LogSupervisor\Models\Activity;
use carolezountangni\LogSupervisor\Http\Middleware\RoleMiddleware;
use carolezountangni\LogSupervisor\Http\Requests\SearchActivityRequest;
use carolezounatngni\LogSupervisor\Interfaces\AuthenticationInterface;

class LogController extends Controller
{

    // public function __construct(AuthenticationInterface $auth)
    // {
    //     // Appliquer le middleware à toutes les méthodes du contrôleur
    //     $this->middleware(RoleMiddleware::class);
    //     $this->auth = $auth;
    // }

    // public function login(Request $request)
    // {
    //     // Tenter de connecter l'utilisateur en utilisant votre implémentation personnalisée
    //     if ($this->auth->attemptLogin($request->only('email', 'password'))) {
    //         // L'utilisateur est connecté
    //     } else {
    //         // Échec de la connexion
    //     }
    // }


    public function index(SearchActivityRequest $request)
    {

        $query = Activity::query()->orderBy('created_at', 'desc');
        if ($request->validated('created_at')) {

            $query = $query->where('created_at', '<=', $request->validated()['created_at']);
        }


        if ($title = $request->validated('title')) {

            $query  = $query->where('action', 'like', "%{$title}%");
        }

        $backUrl = config('log-supervisor.back_to_system_url');
        $backLabel = config('log-supervisor.back_to_system_label');

        return view('log-supervisor::index', [
            'logs' => $query->paginate(20),
            'validated' => $request->validated(),
            'backUrl' => $backUrl,
            'backLabel' => $backLabel,

        ]);
    }

    /**
     */
    public function show($id)
    {
        $activity = Activity::findOrFail($id);
        $backUrl = config('log-supervisor.back_to_system_url');
        $backLabel = config('log-supervisor.back_to_system_label');

        return view('log-supervisor::show', compact('activity', 'backUrl', 'backLabel'));
    }


    public function logs(string $id, SearchActivityRequest $request)
    {

        $query = Activity::query()->where('user_id', $id)->orderBy('created_at', 'desc');
        // $activities = Activity::where('user_id', $id)->paginate(20);
        $utilisateur = User::findOrFail($id);

        if ($request->validated('created_at')) {

            $query  = $query->where('created_at', '<=', $request->validated('created_at'));
        }


        if ($title = $request->validated('title')) {

            $query  = $query->where('action', 'like', "%{$title}%");
        }
        $backUrl = config('log-supervisor.back_to_system_url');
        $backLabel = config('log-supervisor.back_to_system_label');

        return view('log-supervisor::index', [
            'logs' => $query->paginate(20),
            'validated' => $request->validated(),
            'utilisateur' => $utilisateur,
            'backUrl' => $backUrl,
            'backLabel' => $backLabel,

        ]);
    }
}
