<?php

namespace App\Http\Controllers\Officer;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;
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

        return view('officer.attendance', compact('cadets'));
    }

    public function show(User $user): View
    {
        abort_unless($user->isCadet(), 404);

        $saved = Attendance::where('cadet_id', $user->id)
            ->get()
            ->keyBy('day_number');

        $days = collect(range(1, Attendance::TOTAL_DAYS))->map(fn ($d) => $saved->get($d));

        $stats = [
            'days_recorded'  => $days->filter(fn ($r) => $r?->training_date)->count(),
            'total_merits'   => $days->sum(fn ($r) => $r?->merits ?? 0),
            'total_demerits' => $days->sum(fn ($r) => $r?->demerits ?? 0),
        ];
        $stats['net'] = $stats['total_merits'] - $stats['total_demerits'];

        return view('officer.attendance-show', [
            'cadet' => $user,
            'days'  => $days,
            'total' => Attendance::TOTAL_DAYS,
            'stats' => $stats,
        ]);
    }
}
