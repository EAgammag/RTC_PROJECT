<?php

namespace App\Http\Controllers\Cadet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cadet\CadetInfoUpdateRequest;
use Illuminate\Http\RedirectResponse;
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

    /**
     * Show the cadet's profile management page.
     */
    public function profile(): View
    {
        return view('cadet.profile', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Update the cadet's detailed profile information.
     */
    public function updateProfile(CadetInfoUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated())->save();

        return redirect()->route('cadet.profile')->with('success', 'Profile updated successfully.');
    }
}
