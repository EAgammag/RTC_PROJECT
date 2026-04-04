@extends('layouts.app')

@section('title', 'Attendance — ' . $cadet->name)
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
<div class="space-y-4">

    {{-- ── Cadet info bar ───────────────────────────────────────────────────────── --}}
    <div class="card rounded-xl p-4 flex items-center gap-5">
        <div class="w-10 h-10 rounded-full flex items-center justify-center font-black text-lg shrink-0"
             style="background: linear-gradient(135deg, var(--gold3), var(--gold)); color: var(--navy);">
            {{ strtoupper(substr($cadet->name, 0, 1)) }}
        </div>
        <div class="flex-1 min-w-0">
            <p class="text-sm font-black text-slate-900">{{ $cadet->name }}</p>
            <p class="text-xs font-mono text-slate-400">{{ $cadet->student_id ?? 'No ID' }}
                @if ($cadet->course_year) · {{ $cadet->course_year }} @endif
            </p>
        </div>
        <a href="{{ route('officer.attendance.index') }}"
           class="text-xs text-slate-400 hover:text-slate-600 transition-colors">← Back to list</a>
    </div>

    {{-- ── Stat cards ───────────────────────────────────────────────────────────── --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3">
        <div class="stat-card rounded-xl p-4 text-center">
            <p class="text-xs text-slate-400 uppercase tracking-wider mb-1">Days Recorded</p>
            <p class="text-2xl font-black text-slate-900">{{ $stats['days_recorded'] }} <span class="text-sm font-normal text-slate-400">/ 15</span></p>
        </div>
        <div class="stat-card rounded-xl p-4 text-center">
            <p class="text-xs text-slate-400 uppercase tracking-wider mb-1">Merits</p>
            <p class="text-2xl font-black" style="color: #047857;">{{ $stats['total_merits'] }}</p>
        </div>
        <div class="stat-card rounded-xl p-4 text-center">
            <p class="text-xs text-slate-400 uppercase tracking-wider mb-1">Demerits</p>
            <p class="text-2xl font-black" style="color: #b91c1c;">{{ $stats['total_demerits'] }}</p>
        </div>
        <div class="stat-card rounded-xl p-4 text-center">
            <p class="text-xs text-slate-400 uppercase tracking-wider mb-1">Net Merit</p>
            <p class="text-2xl font-black" style="color: {{ $stats['net'] >= 0 ? '#047857' : '#b91c1c' }};">
                {{ $stats['net'] >= 0 ? '+' : '' }}{{ $stats['net'] }}
            </p>
        </div>
    </div>

    {{-- ── Read-only attendance table ───────────────────────────────────────────── --}}
    <div class="card rounded-xl overflow-hidden">

        <div class="px-5 py-3" style="border-bottom: 2px solid rgba(200,169,81,.2); background: rgba(200,169,81,.03);">
            <h2 class="text-xs font-black uppercase tracking-widest" style="color: var(--gold);">
                Attendance Record — Training Days 1–{{ $total }}
            </h2>
            <p class="text-xs text-slate-400 mt-0.5">Read-only view. Contact admin to make corrections.</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full" style="border-collapse: collapse; min-width: 650px;">
                <thead>
                    <tr style="background: rgba(200,169,81,.05); border-bottom: 2px solid rgba(200,169,81,.15);">
                        <th style="padding:.55rem .7rem; text-align:center; font-size:.6rem; font-weight:800; text-transform:uppercase; letter-spacing:.08em; color: var(--gold); width:48px;">Day</th>
                        <th style="padding:.55rem .7rem; text-align:left; font-size:.6rem; font-weight:800; text-transform:uppercase; letter-spacing:.08em; color: var(--gold);">Date</th>
                        <th style="padding:.55rem .7rem; text-align:center; font-size:.6rem; font-weight:800; text-transform:uppercase; letter-spacing:.08em; color:#047857; width:80px;">Merits</th>
                        <th style="padding:.55rem .7rem; text-align:center; font-size:.6rem; font-weight:800; text-transform:uppercase; letter-spacing:.08em; color:#b91c1c; width:80px;">Demerits</th>
                        <th style="padding:.55rem .7rem; text-align:left; font-size:.6rem; font-weight:800; text-transform:uppercase; letter-spacing:.08em; color:#374151;">Remarks</th>
                        <th style="padding:.55rem .7rem; text-align:left; font-size:.6rem; font-weight:800; text-transform:uppercase; letter-spacing:.08em; color:#374151; white-space:nowrap;">Signature</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($days as $index => $rec)
                        @php $d = $index + 1; $filled = $rec && $rec->training_date; @endphp
                        <tr style="border-bottom: 1px solid #f3f4f6; {{ !$filled ? 'opacity: 0.45;' : '' }}">
                            <td style="padding:.45rem .7rem; text-align:center;">
                                <span style="display:inline-flex; align-items:center; justify-content:center; width:1.6rem; height:1.6rem; border-radius:.4rem; background:{{ $filled ? 'rgba(200,169,81,.1)' : '#f1f5f9' }}; border:1px solid {{ $filled ? 'rgba(200,169,81,.2)' : '#e2e8f0' }}; font-size:.7rem; font-weight:800; color:{{ $filled ? 'var(--gold)' : '#94a3b8' }};">{{ $d }}</span>
                            </td>
                            <td style="padding:.45rem .7rem; font-size:.8rem; font-weight:600; color:#374151;">
                                {{ $rec?->training_date?->format('d M Y') ?? '—' }}
                            </td>
                            <td style="padding:.45rem .7rem; text-align:center; font-size:.85rem; font-weight:800; color:#047857;">
                                {{ $rec?->merits ?? '—' }}
                            </td>
                            <td style="padding:.45rem .7rem; text-align:center; font-size:.85rem; font-weight:800; color:#b91c1c;">
                                {{ $rec?->demerits ?? '—' }}
                            </td>
                            <td style="padding:.45rem .7rem; font-size:.8rem; color:#64748b;">
                                {{ $rec?->remarks ?? '—' }}
                            </td>
                            <td style="padding:.45rem .7rem; font-size:.8rem; font-style:italic; color:#94a3b8;">
                                {{ $rec?->e_signature ?? '—' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                @php
                    $totM = $days->sum(fn($r) => $r?->merits ?? 0);
                    $totD = $days->sum(fn($r) => $r?->demerits ?? 0);
                @endphp
                <tfoot>
                    <tr style="background: rgba(200,169,81,.04); border-top: 2px solid rgba(200,169,81,.15);">
                        <td colspan="2" style="padding:.55rem .7rem; text-align:right; font-size:.65rem; font-weight:800; text-transform:uppercase; letter-spacing:.08em; color:#64748b;">Total</td>
                        <td style="padding:.55rem .7rem; text-align:center; font-size:.9rem; font-weight:900; color:#047857;">{{ $totM }}</td>
                        <td style="padding:.55rem .7rem; text-align:center; font-size:.9rem; font-weight:900; color:#b91c1c;">{{ $totD }}</td>
                        <td colspan="2" style="padding:.55rem .7rem;">
                            <span style="font-size:.75rem; font-weight:800; color: {{ $totM - $totD >= 0 ? '#047857' : '#b91c1c' }};">
                                Net: {{ $totM - $totD >= 0 ? '+' : '' }}{{ $totM - $totD }}
                            </span>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>
</div>
@endsection
