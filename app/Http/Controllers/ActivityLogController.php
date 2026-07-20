<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLog;

class ActivityLogController extends Controller
{
    public function index(Request $request)
{
    if (! auth()->user()->hasPermission('activity_logs.view')) {
        abort(403);
    }

    $query = ActivityLog::query();

if ($request->filled('search')) {

    $search = $request->search;

    $query->where(function ($query) use ($search) {

        $query->where('description', 'LIKE', "%{$search}%")
              ->orWhere('module', 'LIKE', "%{$search}%")
              ->orWhere('action', 'LIKE', "%{$search}%")
              ->orWhereHas('user', function ($query) use ($search) {

                  $query->where('name', 'LIKE', "%{$search}%");

              });

    });

}

if ($request->filled('module')) {

    $query->where('module', $request->module);

}

if ($request->filled('action')) {

    $query->where('action', $request->action);

}

$activityLogs = $query
    ->latest()
    ->paginate(20)
    ->withQueryString();

    return view('activity-logs.index', compact('activityLogs'));
}
}
