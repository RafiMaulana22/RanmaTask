<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\TasksController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    // Login Routes
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

    // Forgot Password Route
    Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->name('forgot-password');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPasswordAction'])->name('forgot-password.submit');

    // Register Route
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
});

Route::middleware('auth')->group(function () {
    // Logout Route
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

    // Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Tasks Routes
    Route::get('/tasks', [TasksController::class, 'index'])->name('tasks.index');
    Route::post('/tasks', [TasksController::class, 'store'])->name('tasks.store');
    Route::put('/tasks/{task}', [TasksController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [TasksController::class, 'destroy'])->name('tasks.destroy');

    // Profile Route
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});
