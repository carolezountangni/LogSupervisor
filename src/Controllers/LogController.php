<?php

namespace carolezountangni\LogSupervisor\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use carolezountangni\LogSupervisor\Models\Activity;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{


    public function index()
    {
        //
        $logs = Activity::with('user')->latest()->get()->orderBy('created_at', 'desc')->paginate(25);

        return view('log-supervisor::index', compact("logs"));

        // return view('admin.logs.index', ([
        //     'logs' => $activities
        //         ->paginate(25)
        // ]));
    }


    /**
     */
    public function show(Activity $activity)
    {
        return view('log-supervisor::show', compact('activity'));
    }
    public function logs($user_id)
    {
        $activities = Activity::where('user_id', $user_id)->latest()->get();
        return view('log-supervisor::index', [
            'logs' => $activities->paginate(25),

        ]);
    }
}
