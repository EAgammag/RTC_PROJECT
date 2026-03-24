<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Show the login form.
     * Redirects already-authenticated users directly to their dashboard.
     */
    public function showLoginForm(): View|RedirectResponse
    {
        if (Auth::check()) {
            /** @var \App\Models\User $user */
            $user = Auth::user();
            return redirect($user->dashboardRoute());
        }

        return view('auth.login');
    }

    /**
     * Process a login request.
     *
     * Security controls implemented (OWASP A07 – Identification & Authentication Failures):
     *  1. Input validation  – strict type, length, and format rules prevent injection.
     *  2. Account lockout   – after MAX_LOGIN_ATTEMPTS failures the account is locked for
     *                         LOCKOUT_MINUTES to mitigate brute-force attacks.
     *  3. Timing-safe check – Hash::check() uses a constant-time comparison.
     *  4. Session fixation  – session()->regenerate() issues a new session ID on login.
     *  5. CSRF protection   – enforced by Laravel's VerifyCsrfToken middleware on POST routes.
     */
    public function login(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email'    => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8',  'max:255'],
        ]);

        /** @var User|null $user */
        $user = User::where('email', $validated['email'])->first();

        // Reject unknown e-mails and deactivated accounts with a generic message
        // to avoid user enumeration (OWASP recommendation).
        if (!$user || !$user->is_active) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect or the account is inactive.'],
            ]);
        }

        // ── Account lockout check ─────────────────────────────────────────────
        if ($user->isLocked()) {
            $minutesRemaining = (int) now()->diffInMinutes($user->locked_until, false);
            throw ValidationException::withMessages([
                'email' => [
                    "This account has been temporarily locked due to multiple failed login attempts. "
                    . "Please try again in {$minutesRemaining} minute(s).",
                ],
            ]);
        }

        // ── Credential verification ───────────────────────────────────────────
        if (!Hash::check($validated['password'], $user->password)) {
            $attempts = $user->login_attempts + 1;

            if ($attempts >= User::MAX_LOGIN_ATTEMPTS) {
                $user->update([
                    'login_attempts' => $attempts,
                    'locked_until'   => now()->addMinutes(User::LOCKOUT_MINUTES),
                ]);

                throw ValidationException::withMessages([
                    'email' => [
                        'Too many failed login attempts. This account has been locked for '
                        . User::LOCKOUT_MINUTES . ' minutes.',
                    ],
                ]);
            }

            $user->update(['login_attempts' => $attempts]);

            $remaining = User::MAX_LOGIN_ATTEMPTS - $attempts;
            throw ValidationException::withMessages([
                'email' => [
                    "Invalid credentials. {$remaining} attempt(s) remaining before the account is locked.",
                ],
            ]);
        }

        // ── Successful authentication ─────────────────────────────────────────
        $user->update([
            'login_attempts' => 0,
            'locked_until'   => null,
            'last_login_at'  => now(),
        ]);

        Auth::login($user, $request->boolean('remember'));

        // Regenerate session ID to prevent session fixation attacks.
        $request->session()->regenerate();

        // Seed last_activity for the SessionTimeout middleware.
        $request->session()->put('last_activity', time());

        return redirect($user->dashboardRoute());
    }

    /**
     * Log the user out and invalidate their session entirely.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('status', 'You have been logged out securely.');
    }
}
