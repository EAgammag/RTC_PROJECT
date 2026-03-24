<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * SessionTimeout – automatically logs out idle authenticated users.
 *
 * Addresses OWASP A07 (Identification & Authentication Failures) by ensuring
 * that unattended sessions cannot be hijacked from an unlocked workstation.
 *
 * Default timeout: 30 minutes of inactivity.
 * The timer is reset on every authenticated request.
 */
class SessionTimeout
{
    /**
     * Maximum idle time in seconds before the session is terminated.
     */
    protected int $timeoutSeconds = 1800; // 30 minutes

    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $lastActivity = (int) session('last_activity', 0);

            if ($lastActivity && (time() - $lastActivity) > $this->timeoutSeconds) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('login')
                    ->withErrors([
                        'email' => 'Your session expired due to inactivity. Please log in again.',
                    ]);
            }

            // Refresh activity timestamp on every authenticated request.
            session(['last_activity' => time()]);
        }

        return $next($request);
    }
}
