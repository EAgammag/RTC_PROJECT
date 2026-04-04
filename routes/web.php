<?php

use App\Http\Controllers\Admin\AnnouncementController as AdminAnnouncementController;
use App\Http\Controllers\Admin\AttendanceController as AdminAttendanceController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Cadet\AnnouncementController as CadetAnnouncementController;
use App\Http\Controllers\Cadet\AttendanceController as CadetAttendanceController;
use App\Http\Controllers\Cadet\DashboardController as CadetDashboardController;
use App\Http\Controllers\Officer\AttendanceController as OfficerAttendanceController;
use App\Http\Controllers\Officer\DashboardController as OfficerDashboardController;
use App\Http\Controllers\Officer\EnrollmentController as OfficerEnrollmentController;
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

Route::post('/enroll/form', function (\Illuminate\Http\Request $request) {
    /** @var User $user */
    $user = Auth::user();

    if ($user) {
        $address = collect([
            $request->street,
            $request->barangay,
            $request->town_city,
            $request->province,
        ])->filter()->implode(', ');

        $user->update([
            'date_of_birth'          => $request->date_of_birth,
            'gender'                 => $request->gender,
            'blood_type'             => $request->blood_type,
            'religion'               => $request->religion,
            'contact_number'         => $request->cp_nr ?? $request->contact_number,
            'course_year'            => $request->course_year,
            'address'                => $address ?: $request->address,
            'height'                 => $request->height,
            'weight'                 => $request->weight,
            'emergency_name'         => $request->emergency_name,
            'emergency_relationship' => $request->emergency_relationship,
            'emergency_contact'      => $request->emergency_contact,
            'enrollment_status'      => User::ENROLLMENT_PENDING,
        ]);
    }

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
        Route::get('users/{user}/unlock', fn() => redirect()->route('admin.dashboard'));
        Route::post('users/{user}/unlock', [AdminDashboardController::class, 'unlockAccount'])->name('users.unlock');
        Route::get('users/{user}/toggle', fn() => redirect()->route('admin.dashboard'));
        Route::post('users/{user}/toggle', [AdminDashboardController::class, 'toggleActive'])->name('users.toggle');
        // Announcements
        Route::get('announcements', [AdminAnnouncementController::class, 'index'])->name('announcements.index');
        Route::get('announcements/create', [AdminAnnouncementController::class, 'create'])->name('announcements.create');
        Route::post('announcements', [AdminAnnouncementController::class, 'store'])->name('announcements.store');
        Route::get('announcements/{announcement}/edit', [AdminAnnouncementController::class, 'edit'])->name('announcements.edit');
        Route::patch('announcements/{announcement}', [AdminAnnouncementController::class, 'update'])->name('announcements.update');
        Route::delete('announcements/{announcement}', [AdminAnnouncementController::class, 'destroy'])->name('announcements.destroy');
        // Attendance
        Route::get('attendance', [AdminAttendanceController::class, 'index'])->name('attendance.index');
        Route::get('attendance/{user}', [AdminAttendanceController::class, 'show'])->name('attendance.show');
        Route::post('attendance/{user}', [AdminAttendanceController::class, 'update'])->name('attendance.update');
    });

// ── Officer routes ────────────────────────────────────────────────────────────
Route::middleware(['auth', 'verified', 'session.timeout', 'role:officer'])
    ->prefix('officer')
    ->name('officer.')
    ->group(function () {
        Route::get('dashboard', [OfficerDashboardController::class, 'index'])->name('dashboard');
        // Attendance (read-only)
        Route::get('attendance', [OfficerAttendanceController::class, 'index'])->name('attendance.index');
        Route::get('attendance/{user}', [OfficerAttendanceController::class, 'show'])->name('attendance.show');
        Route::get('grades', [OfficerDashboardController::class, 'grades'])->name('grades');
        // Enrollment validation
        Route::get('enrollments', [OfficerEnrollmentController::class, 'index'])->name('enrollments.index');
        Route::get('enrollments/{user}', [OfficerEnrollmentController::class, 'show'])->name('enrollments.show');
        Route::patch('enrollments/{user}/validate', [OfficerEnrollmentController::class, 'validate'])->name('enrollments.validate');
        Route::patch('enrollments/{user}/reject', [OfficerEnrollmentController::class, 'reject'])->name('enrollments.reject');
    });

// ── Cadet routes ──────────────────────────────────────────────────────────────
Route::middleware(['auth', 'verified', 'session.timeout', 'role:cadet'])
    ->prefix('cadet')
    ->name('cadet.')
    ->group(function () {
        Route::get('dashboard', [CadetDashboardController::class, 'index'])->name('dashboard');
        Route::get('profile', [CadetDashboardController::class, 'profile'])->name('profile');
        Route::patch('profile', [CadetDashboardController::class, 'updateProfile'])->name('profile.update');
        Route::get('announcements', [CadetAnnouncementController::class, 'index'])->name('announcements');
        Route::get('attendance', [CadetAttendanceController::class, 'index'])->name('attendance');
    });

// ── Profile routes (accessible by all authenticated roles) ────────────────────
Route::middleware(['auth', 'session.timeout'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
