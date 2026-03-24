<?php

namespace App\Http\Controllers\Cadet;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Show the cadet's personal dashboard.
     * A cadet may only view their own profile — no cross-cadet data is exposed.
     */
    public function index(): View
    {
        $cadet = Auth::user();

        return view('cadet.dashboard', compact('cadet'));
    }
}
