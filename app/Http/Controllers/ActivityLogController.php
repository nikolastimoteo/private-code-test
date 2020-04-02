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
            $usersArray = Auth::user()->admin()->usersWithTrashed->pluck('id')->toArray();
            $usersArray[] = Auth::user()->admin()->id;
            
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
