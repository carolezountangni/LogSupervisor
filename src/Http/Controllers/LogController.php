<?php

namespace carolezountangni\LogSupervisor\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use carolezountangni\LogSupervisor\Models\Activity;
// use App\Http\Controllers\Controller;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{


    public function index()
    {
        //

        $logs = Activity::paginate(20);

        return view('log-supervisor::index', compact('logs'));
    }


    /**
     */
    public function show($id)
    {
        $activity = Activity::findOrFail($id);
        return view('log-supervisor::show', compact('activity'));
    }


    public function logs(User $utilisateur)
    {
        $activities = $utilisateur->activities;
        // $activities = $activities::paginate(25);
        return view('log-supervisor::index', [
            'logs' => $activities,
            'utilisateur' => $utilisateur

        ]);
    }
}