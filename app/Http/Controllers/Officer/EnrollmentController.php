<?php

namespace App\Http\Controllers\Officer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EnrollmentController extends Controller
{
    public function index(Request $request): View
    {
        $filter = $request->input('status', 'pending');

        $enrollees = User::query()
            ->where('role', User::ROLE_CADET)
            ->whereNotNull('enrollment_status')
            ->when($filter !== 'all', fn ($q) => $q->where('enrollment_status', $filter))
            ->orderByRaw("FIELD(enrollment_status, 'pending', 'validated', 'rejected')")
            ->orderBy('name')
            ->get();

        $counts = User::where('role', User::ROLE_CADET)
            ->whereNotNull('enrollment_status')
            ->selectRaw("
                COUNT(*) as total,
                SUM(enrollment_status = 'pending')   as pending,
                SUM(enrollment_status = 'validated') as validated,
                SUM(enrollment_status = 'rejected')  as rejected
            ")
            ->first();

        return view('officer.enrollments.index', compact('enrollees', 'counts', 'filter'));
    }

    public function show(User $user): View
    {
        abort_if($user->role !== User::ROLE_CADET, 404);

        return view('officer.enrollments.show', compact('user'));
    }

    public function validate(Request $request, User $user): RedirectResponse
    {
        abort_if($user->role !== User::ROLE_CADET, 404);

        $user->update([
            'enrollment_status'  => User::ENROLLMENT_VALIDATED,
            'enrollment_remarks' => $request->input('remarks'),
            'is_active'          => true,
        ]);

        return redirect()->route('officer.enrollments.index')
            ->with('success', "{$user->name}'s enrollment has been validated.");
    }

    public function reject(Request $request, User $user): RedirectResponse
    {
        abort_if($user->role !== User::ROLE_CADET, 404);

        $request->validate(['remarks' => 'nullable|string|max:500']);

        $user->update([
            'enrollment_status'  => User::ENROLLMENT_REJECTED,
            'enrollment_remarks' => $request->input('remarks'),
            'is_active'          => false,
        ]);

        return redirect()->route('officer.enrollments.index')
            ->with('success', "{$user->name}'s enrollment has been rejected.");
    }
}
