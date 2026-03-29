<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Cadet\DashboardController as CadetDashboardController;
use App\Http\Controllers\Officer\DashboardController as OfficerDashboardController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/enroll', function () {
    return view('enroll');
})->name('enroll');

Route::get('/enroll/form', function () {
    return view('enroll-form');
})->name('enroll.form');

Route::post('/enroll/form', function () {
    // TODO: handle enrollment submission (store to DB, notify admin, etc.)
    return back()->with('success', 'Your application has been submitted. The ROTC office will review it shortly.');
})->name('enroll.form.submit');

// Authenticated users are redirected to their role-specific dashboard.
Route::get('/dashboard', function () {
    /** @var User $user */
    $user = Auth::user();

    return redirect($user->dashboardRoute());
})->middleware(['auth', 'verified'])->name('dashboard');

// ── Admin routes ──────────────────────────────────────────────────────────────
Route::middleware(['auth', 'verified', 'session.timeout', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('users/create', [AdminDashboardController::class, 'createUser'])->name('users.create');
        Route::post('users', [AdminDashboardController::class, 'storeUser'])->name('users.store');
        Route::post('users/{user}/unlock', [AdminDashboardController::class, 'unlockAccount'])->name('users.unlock');
        Route::post('users/{user}/toggle', [AdminDashboardController::class, 'toggleActive'])->name('users.toggle');
    });

// ── Officer routes ────────────────────────────────────────────────────────────
Route::middleware(['auth', 'verified', 'session.timeout', 'role:officer'])
    ->prefix('officer')
    ->name('officer.')
    ->group(function () {
        Route::get('dashboard', [OfficerDashboardController::class, 'index'])->name('dashboard');
    });

// ── Cadet routes ──────────────────────────────────────────────────────────────
Route::middleware(['auth', 'verified', 'session.timeout', 'role:cadet'])
    ->prefix('cadet')
    ->name('cadet.')
    ->group(function () {
        Route::get('dashboard', [CadetDashboardController::class, 'index'])->name('dashboard');
        Route::get('profile', [CadetDashboardController::class, 'profile'])->name('profile');
    });

// ── Profile routes (accessible by all authenticated roles) ────────────────────
Route::middleware(['auth', 'session.timeout'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
