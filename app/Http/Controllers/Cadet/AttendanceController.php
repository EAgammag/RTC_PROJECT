<?php

namespace App\Http\Controllers\Cadet;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\View\View;

class AttendanceController extends Controller
{
    public function index(): View
    {
        $saved = Attendance::where('cadet_id', auth()->id())
            ->get()
            ->keyBy('day_number');

        $days = collect(range(1, Attendance::TOTAL_DAYS))->map(fn ($d) => $saved->get($d));

        $stats = [
            'days_recorded'  => $saved->whereNotNull('training_date')->count(),
            'total_merits'   => $saved->sum('merits'),
            'total_demerits' => $saved->sum('demerits'),
            'net'            => $saved->sum('merits') - $saved->sum('demerits'),
        ];

        return view('cadet.attendance', compact('days', 'stats'));
    }
}
