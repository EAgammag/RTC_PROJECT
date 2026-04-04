<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AttendanceController extends Controller
{
    public function index(): View
    {
        $cadets = User::where('role', User::ROLE_CADET)
            ->where('is_active', true)
            ->orderBy('name')
            ->get()
            ->map(function ($cadet) {
                $records = Attendance::where('cadet_id', $cadet->id)->get();
                $cadet->days_recorded  = $records->whereNotNull('training_date')->count();
                $cadet->total_merits   = $records->sum('merits');
                $cadet->total_demerits = $records->sum('demerits');
                $cadet->net_merits     = $cadet->total_merits - $cadet->total_demerits;
                return $cadet;
            });

        return view('admin.attendance.index', compact('cadets'));
    }

    public function show(User $user): View
    {
        abort_unless($user->isCadet(), 404);

        // Build a full 15-day array, merging saved records
        $saved = Attendance::where('cadet_id', $user->id)
            ->get()
            ->keyBy('day_number');

        $days = collect(range(1, Attendance::TOTAL_DAYS))->map(fn ($d) => $saved->get($d));

        return view('admin.attendance.show', [
            'cadet' => $user,
            'days'  => $days,
            'total' => Attendance::TOTAL_DAYS,
        ]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        abort_unless($user->isCadet(), 404);

        $request->validate([
            'days'                    => ['required', 'array'],
            'days.*.training_date'    => ['nullable', 'date'],
            'days.*.merits'           => ['nullable', 'integer', 'min:0', 'max:99'],
            'days.*.demerits'         => ['nullable', 'integer', 'min:0', 'max:99'],
            'days.*.remarks'          => ['nullable', 'string', 'max:500'],
            'days.*.e_signature'      => ['nullable', 'string', 'max:255'],
        ]);

        foreach ($request->input('days') as $dayNumber => $entry) {
            Attendance::updateOrCreate(
                ['cadet_id' => $user->id, 'day_number' => $dayNumber],
                [
                    'training_date' => $entry['training_date'] ?? null,
                    'merits'        => $entry['merits']  ?? 0,
                    'demerits'      => $entry['demerits'] ?? 0,
                    'remarks'       => $entry['remarks']  ?? null,
                    'e_signature'   => $entry['e_signature'] ?? null,
                    'recorded_by'   => $request->user()->id,
                ]
            );
        }

        return back()->with('success', 'Attendance saved for ' . $user->name . '.');
    }
}
