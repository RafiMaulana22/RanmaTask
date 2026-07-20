<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Task
        $totalTask = Task::count();

        // Task Selesai
        $completedTask = Task::where('status', 'completed')->count();

        // Task Pending
        $pendingTask = Task::where('status', 'pending')->count();

        // Task Terlambat
        $overdueTask = Task::where('status', 'pending')->whereDate('deadline', '<', Carbon::today())->count();

        // 5 Task Terbaru
        $recentTasks = Task::latest()->take(5)->get();

        // Progress
        $progress = $totalTask > 0 ? round(($completedTask / $totalTask) * 100) : 0;

        return view('Admin.Dashboard.index', compact('totalTask', 'completedTask', 'pendingTask', 'overdueTask', 'recentTasks', 'progress'));
    }
}
