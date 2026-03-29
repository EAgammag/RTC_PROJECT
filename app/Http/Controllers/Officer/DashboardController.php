<?php

namespace App\Http\Controllers\Officer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Show the officer dashboard with the cadet roster.
     * Officers can view cadet records but cannot alter system configuration.
     */
    public function index(): View
    {
        $cadets = User::where('role', User::ROLE_CADET)
            ->orderBy('name')
            ->get();

        $stats = [
            'total_cadets' => $cadets->count(),
            'active_cadets' => $cadets->where('is_active', true)->count(),
            'inactive_cadets' => $cadets->where('is_active', false)->count(),
            'locked_cadets' => $cadets->filter(fn ($u) => $u->isLocked())->count(),
        ];

        return view('officer.dashboard', compact('cadets', 'stats'));
    }
}
