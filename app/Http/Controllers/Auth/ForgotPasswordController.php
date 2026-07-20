<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('auth.forgot-password');
    }

    public function forgotPasswordAction(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withInput()->with('error', 'Email is not registered.');
        }

        return back()->with('success', 'Reset password link has been sent successfully (Demo).');
    }
}
