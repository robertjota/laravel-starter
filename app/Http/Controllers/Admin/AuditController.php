<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\AccessLog;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuditController extends Controller
{
    public function activities(Request $request): View
    {
        $activities = Activity::with('user')
            ->when($request->user_id, fn($q) => $q->where('user_id', $request->user_id))
            ->when($request->search, fn($q) => $q->where('description', 'like', "%{$request->search}%"))
            ->latest()
            ->paginate(20);

        return view('admin.audits.activities', compact('activities'));
    }

    public function accessLogs(Request $request): View
    {
        $accessLogs = AccessLog::with('user')
            ->when($request->user_id, fn($q) => $q->where('user_id', $request->user_id))
            ->latest()
            ->paginate(20);

        return view('admin.audits.access-logs', compact('accessLogs'));
    }
}
