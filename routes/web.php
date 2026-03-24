<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Officer\DashboardController as OfficerDashboard;
use App\Http\Controllers\Cadet\DashboardController as CadetDashboard;
use Illuminate\Support\Facades\Route;

// ── Root ─────────────────────────────────────────────────────────────────────
Route::get('/', function () {
    return redirect()->route('login');
});

// ── Authentication (unauthenticated users only) ───────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login',  [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// ── Protected routes (authenticated + session timeout) ────────────────────────
Route::middleware(['auth', 'session.timeout'])->group(function () {

    // ── Admin ─────────────────────────────────────────────────────────────────
    Route::middleware('role:admin')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::get('/dashboard',          [AdminDashboard::class, 'index'])->name('dashboard');
            Route::get('/users/create',       [AdminDashboard::class, 'createUser'])->name('users.create');
            Route::post('/users',             [AdminDashboard::class, 'storeUser'])->name('users.store');
            Route::patch('/users/{user}/unlock', [AdminDashboard::class, 'unlockAccount'])->name('users.unlock');
            Route::patch('/users/{user}/toggle', [AdminDashboard::class, 'toggleActive'])->name('users.toggle');
        });

    // ── Officer ───────────────────────────────────────────────────────────────
    Route::middleware('role:officer')
        ->prefix('officer')
        ->name('officer.')
        ->group(function () {
            Route::get('/dashboard', [OfficerDashboard::class, 'index'])->name('dashboard');
        });

    // ── Cadet ─────────────────────────────────────────────────────────────────
    Route::middleware('role:cadet')
        ->prefix('cadet')
        ->name('cadet.')
        ->group(function () {
            Route::get('/dashboard', [CadetDashboard::class, 'index'])->name('dashboard');
        });
});

