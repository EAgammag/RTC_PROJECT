<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard with unit statistics and recent accounts.
     */
    public function index(): View
    {
        $stats = [
            'total_users'     => User::count(),
            'total_officers'  => User::where('role', User::ROLE_OFFICER)->count(),
            'total_cadets'    => User::where('role', User::ROLE_CADET)->count(),
            'active_users'    => User::where('is_active', true)->count(),
            'locked_accounts' => User::whereNotNull('locked_until')
                                     ->where('locked_until', '>', now())
                                     ->count(),
        ];

        $recent_users = User::latest()->take(10)->get();

        return view('admin.dashboard', compact('stats', 'recent_users'));
    }

    /**
     * Show the form for creating a new user account.
     */
    public function createUser(): View
    {
        return view('admin.create-user');
    }

    /**
     * Store a new user account.
     * Passwords are hashed automatically by the `hashed` cast on the User model.
     */
    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'student_id' => ['required', 'string', 'max:50', 'unique:users,student_id'],
            'email'      => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password'   => [
                'required',
                'string',
                'min:12',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/',
            ],
            'role'       => ['required', 'in:admin,officer,cadet'],
        ], [
            'password.regex' => 'Password must contain uppercase, lowercase, a number, and a special character.',
        ]);

        User::create([
            'name'       => $validated['name'],
            'student_id' => $validated['student_id'],
            'email'      => $validated['email'],
            'password'   => Hash::make($validated['password']),
            'role'       => $validated['role'],
            'is_active'  => true,
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', "Account for {$validated['name']} created successfully.");
    }

    /**
     * Unlock a locked account and reset its failed-attempt counter.
     */
    public function unlockAccount(User $user)
    {
        $user->update([
            'login_attempts' => 0,
            'locked_until'   => null,
        ]);

        return back()->with('success', "{$user->name}'s account has been unlocked.");
    }

    /**
     * Toggle the active / inactive state of an account.
     */
    public function toggleActive(User $user)
    {
        $user->update(['is_active' => !$user->is_active]);

        $state = $user->is_active ? 'activated' : 'deactivated';

        return back()->with('success', "{$user->name}'s account has been {$state}.");
    }
}
