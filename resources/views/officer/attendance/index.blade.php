@extends('layouts.app')

@section('title', 'Cadet Attendance')
@section('page-title', 'Cadet Attendance')

@section('sidebar-nav')
    <a href="{{ route('officer.dashboard') }}" class="sidebar-link">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>
        Unit Oversight
    </a>
    <a href="{{ route('officer.attendance.index') }}" class="sidebar-link active">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
        </svg>
        Attendance
    </a>
    <div class="sidebar-link cursor-default opacity-40">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
        </svg>
        Grades <span class="text-xs ml-auto opacity-60">soon</span>
    </div>
@endsection

@section('content')
<div class="card rounded-xl overflow-hidden">

    <div class="flex items-center justify-between px-5 py-3.5 border-b" style="border-color: rgba(4,9,15,0.08);">
        <h2 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Cadet Attendance Records</h2>
        <p class="text-xs text-slate-400">Click <strong>View</strong> to see a cadet's full attendance sheet.</p>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr style="background: #f8fafc;">
                    <th class="px-5 py-3 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Cadet</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Student ID</th>
                    <th class="px-5 py-3 text-center text-xs font-semibold text-slate-400 uppercase tracking-wider">Days</th>
                    <th class="px-5 py-3 text-center text-xs font-semibold text-slate-400 uppercase tracking-wider" style="color: #047857;">Merits</th>
                    <th class="px-5 py-3 text-center text-xs font-semibold text-slate-400 uppercase tracking-wider" style="color: #b91c1c;">Demerits</th>
                    <th class="px-5 py-3 text-center text-xs font-semibold text-slate-400 uppercase tracking-wider">Net</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($cadets as $cadet)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-black shrink-0"
                                     style="background: linear-gradient(135deg, var(--gold3), var(--gold)); color: var(--navy);">
                                    {{ strtoupper(substr($cadet->name, 0, 1)) }}
                                </div>
                                <span class="text-sm font-semibold text-slate-900">{{ $cadet->name }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-3 text-xs font-mono text-slate-500">{{ $cadet->student_id ?? '—' }}</td>
                        <td class="px-5 py-3 text-center text-xs font-semibold text-slate-700">
                            {{ $cadet->days_recorded }} / 15
                        </td>
                        <td class="px-5 py-3 text-center text-xs font-bold" style="color: #047857;">
                            {{ $cadet->total_merits }}
                        </td>
                        <td class="px-5 py-3 text-center text-xs font-bold" style="color: #b91c1c;">
                            {{ $cadet->total_demerits }}
                        </td>
                        <td class="px-5 py-3 text-center">
                            @php $net = $cadet->net_merits; @endphp
                            <span class="text-xs font-black" style="color: {{ $net >= 0 ? '#047857' : '#b91c1c' }};">
                                {{ $net >= 0 ? '+' : '' }}{{ $net }}
                            </span>
                        </td>
                        <td class="px-5 py-3">
                            <a href="{{ route('officer.attendance.show', $cadet) }}"
                               class="text-xs px-2.5 py-1 rounded font-semibold transition-colors"
                               style="background: rgba(200,169,81,0.1); color: #c8a951; border: 1px solid rgba(200,169,81,0.2);">
                                View
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-5 py-12 text-center text-sm text-slate-400">
                            No active cadets found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
