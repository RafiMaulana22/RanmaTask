<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->latest()->get();

        return view('Admin.Tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:Low,Medium,High',
            'deadline' => 'nullable|date',
        ]);

        try {
            Task::create([
                'user_id' => Auth::id(),
                'title' => $request->title,
                'description' => $request->description,
                'priority' => $request->priority,
                'status' => 'Pending',
                'deadline' => $request->deadline,
            ]);

            return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Failed to create task.');
        }
    }

    public function update(Request $request, Task $task)
    {
        // dd(Auth::id(), $task->user_id);

        if ($task->user_id != Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:Low,Medium,High',
            'status' => 'required|in:Pending,Completed',
            'deadline' => 'nullable|date',
        ]);

        try {
            $task->update([
                'title' => $request->title,
                'description' => $request->description,
                'priority' => $request->priority,
                'status' => $request->status,
                'deadline' => $request->deadline,
            ]);

            return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Failed to update task.');
        }
    }

    public function destroy(Task $task)
    {
        if ($task->user_id != Auth::id()) {
            abort(403);
        }

        try {
            $task->delete();

            return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete task.');
        }
    }
}
