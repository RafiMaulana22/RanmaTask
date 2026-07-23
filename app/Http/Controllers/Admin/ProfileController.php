<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalTasks = Task::where('user_id', $user->id)->count();
        $completedTasks = Task::where('user_id', $user->id)->where('status', 'Completed')->count();

        $pendingTasks = Task::where('user_id', $user->id)->where('status', 'Pending')->count();

        return view('Admin.Profile.index', compact('user', 'totalTasks', 'completedTasks', 'pendingTasks'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',

            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
        ]);

        try {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            return redirect()->route('profile.index')->with('success', 'Profile updated successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Failed to update profile.');
        }
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',

            'password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password is incorrect.');
        }

        try {
            $user->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('profile.index')->with('success', 'Password updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update password.');
        }
    }
}
