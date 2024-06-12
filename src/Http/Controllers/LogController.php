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
use carolezountangni\LogSupervisor\Interfaces\AuthenticationInterface;
use Carbon\Carbon;

class LogController extends Controller
{

    // public function __construct(AuthenticationInterface $auth)
    // {
    //     // Appliquer le middleware à toutes les méthodes du contrôleur
    //     $this->middleware(RoleMiddleware::class);
    //     $this->auth = $auth;
    //  $this->tableName = config('log-supervisor.activities_table'); // Récupérer le nom de la table depuis la configuration

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

    // public function logout()
    // {
    //     // Déconnecter l'utilisateur en utilisant votre implémentation personnalisée
    //     $this->auth->logout();
    // }

    // public function currentUser()
    // {
    //     // Récupérer l'utilisateur connecté en utilisant votre implémentation personnalisée
    //     $user = $this->auth->user();
    // }


    // public function index(SearchActivityRequest $request)
    // {

    //     $query = Activity::query()->orderBy('created_at', 'desc');
    //     if ($request->validated('created_at')) {

    //         $query = $query->where('created_at', '<=', $request->validated()['created_at']);
    //     }


    //     if ($title = $request->validated('title')) {

    //         $query  = $query->where('action', 'like', "%{$title}%");
    //     }

    //     $backUrl = config('log-supervisor.back_to_system_url');
    //     $backLabel = config('log-supervisor.back_to_system_label');

    //     return view('log-supervisor::index', [
    //         'logs' => $query->paginate(20),
    //         'validated' => $request->validated(),
    //         'backUrl' => $backUrl,
    //         'backLabel' => $backLabel,

    //     ]);
    // }

    public function index(SearchActivityRequest $request)
    {
        $query = Activity::query()->orderBy('created_at', 'desc');

        if ($request->has('created_at')) {
            // Récupérer la date sans l'heure, les minutes et les secondes
            $date = Carbon::parse($request->input('created_at'))->startOfDay();
            $query->whereDate('created_at', $date);
        }

        if ($title = $request->input('title')) {
            $query->where('action', 'like', "%{$title}%");
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
