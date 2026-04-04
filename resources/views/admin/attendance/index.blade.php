@extends('layouts.app')

@section('title', 'Attendance Management')
@section('page-title', 'Attendance Management')

@section('sidebar-nav')
    <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>
        Dashboard
    </a>
    <a href="{{ route('admin.users.create') }}" class="sidebar-link">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
        </svg>
        Create Account
    </a>
    <a href="{{ route('admin.announcements.index') }}" class="sidebar-link">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
        </svg>
        Announcements
    </a>
    <a href="{{ route('admin.attendance.index') }}" class="sidebar-link active">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
        </svg>
        Attendance
    </a>
@endsection

@section('content')
<div class="card rounded-xl overflow-hidden">

    <div class="flex items-center justify-between px-5 py-3.5 border-b" style="border-color: rgba(4,9,15,0.08);">
        <h2 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Cadet Attendance Records</h2>
        <p class="text-xs text-slate-400">Click <strong>Edit</strong> to update a cadet's attendance sheet.</p>
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
                            <a href="{{ route('admin.attendance.show', $cadet) }}"
                               class="text-xs px-2.5 py-1 rounded font-semibold transition-colors"
                               style="background: rgba(200,169,81,0.1); color: #c8a951; border: 1px solid rgba(200,169,81,0.2);">
                                Edit Attendance
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
