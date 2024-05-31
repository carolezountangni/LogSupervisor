<?php

namespace carolezountangni\LogSupervisor\Http\Controllers;

use App\Models\User;
use carolezountangni\LogSupervisor\Facades\LogSupervisor;
use Illuminate\Http\Request;
use carolezountangni\LogSupervisor\Models\Activity;
// use App\Http\Controllers\Controller;
use carolezountangni\LogSupervisor\Http\Requests\SearchActivityRequest;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{


    public function index(SearchActivityRequest $request)
    {

        $query = Activity::query()->orderBy('created_at', 'desc');
        if ($request->validated('created_at')) {

            $query  = $query->where('created_at', '<=', $request->validated('created_at'));
        }


        if ($title = $request->validated('title')) {

            $query  = $query->where('action', 'like', "%{$title}%");
        }
        // $properties = Post::paginate(16);
        return view('log-supervisor::index', [
            'logs' => $query->paginate(20),
            'validated' => $request->validated(),
        ]);
        //

        // $logs = Activity::paginate(20);

        // return view('log-supervisor::index', compact('logs'));
    }


    /**
     */
    public function show($id)
    {
        $activity = Activity::findOrFail($id);
        $data = [
            // 'version' => LogSupervisor::version(),
            'app_name' => config('app.name'),
            'path' => config('log-supervisor.route_path'),
            'back_to_system_url' => config('log-supervisor.back_to_system_url'),
            'back_to_system_label' => config('log-supervisor.back_to_system_label'),

        ];
        $backUrl = config('log-supervisor.back_to_system_url');
        $backLabel = config('log-supervisor.back_to_system_label');

        return view('log-supervisor::show', compact('activity', 'backUrl', 'backLabel'));
    }


    public function logs(string $id)
    {
        $activities = Activity::where('user_id', $id)->paginate(20);
        $utilisateur = User::findOrFail($id);


        return view('log-supervisor::index', [
            'logs' => $activities,
            'utilisateur' => $utilisateur

        ]);
    }
}
