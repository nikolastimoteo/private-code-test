<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ActivityLog;
use Auth;

class ActivityLogController extends Controller
{
    /**
     * Display a listing of activity logs.
     *
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->can('view-log'))
        {
            $admin = Auth::user()->isAdmin() ? Auth::user() : Auth::user()->admin;
            //dd($admin);
            $usersArray = $admin->users->pluck('id')->toArray();
            $usersArray[] = $admin->id;
            $logs = ActivityLog::whereIn('users_id', $usersArray)
                ->orderBy('created_at', 'DESC')
                ->get();
        }
        else
        {
            $logs = Auth::user()->activityLogs;
        }

        return view('activity-log.index')
            ->with('logs', $logs);
    }
}
