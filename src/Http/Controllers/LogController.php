<?php

namespace carolezountangni\LogSupervisor\Http\Controllers;

use App\Http\Requests\SearchActivityRequest as RequestsSearchActivityRequest;
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
        return view('log-supervisor::index', [
            'logs' => $query->paginate(20),
            'validated' => $request->validated(),
        ]);
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

        return view('log-supervisor::index', [
            'logs' => $query->paginate(20),
            'validated' => $request->validated(),
            'utilisateur' => $utilisateur

        ]);
    }
}
