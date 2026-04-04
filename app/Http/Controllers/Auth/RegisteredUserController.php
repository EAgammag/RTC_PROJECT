<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle a cadet self-registration request.
     *
     * The account is created inactive (is_active = false) and pending enrollment
     * validation. The cadet is redirected to the login page with an enroll flag
     * so they can sign in and proceed directly to the enrollment form.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'last_name'   => ['required', 'string', 'max:100'],
            'first_name'  => ['required', 'string', 'max:100'],
            'middle_name' => ['nullable', 'string', 'max:100'],
            'suffix'      => ['nullable', 'string', 'max:10'],
            'student_id'  => ['required', 'string', 'max:50', 'unique:'.User::class.',student_id'],
            'email'       => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password'    => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $fullName = trim(implode(' ', array_filter([
            $request->last_name . ',',
            $request->first_name,
            $request->middle_name ?: null,
            ($request->suffix ?: null),
        ])));

        User::create([
            'name'              => $fullName,
            'student_id'        => $request->student_id,
            'email'             => $request->email,
            'password'          => Hash::make($request->password),
            'role'              => User::ROLE_CADET,
            'is_active'         => false,
            'email_verified_at' => now(),
        ]);

        return redirect()->route('login', ['from' => 'enroll'])
            ->with('status', 'Account created. Sign in with your Student ID to continue with your enrollment application.');
    }
}
