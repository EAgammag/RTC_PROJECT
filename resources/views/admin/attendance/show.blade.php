@extends('layouts.app')

@section('title', 'Edit Attendance — ' . $cadet->name)
@section('page-title', 'Edit Attendance')

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
        <a href="{{ route('admin.attendance.index') }}"
           class="text-xs text-slate-400 hover:text-slate-600 transition-colors">← Back to list</a>
    </div>

    {{-- ── Attendance form ──────────────────────────────────────────────────────── --}}
    <form method="POST" action="{{ route('admin.attendance.update', $cadet) }}">
        @csrf

        <div class="card rounded-xl overflow-hidden">

            <div class="flex items-center justify-between px-5 py-3" style="border-bottom: 2px solid rgba(200,169,81,.2); background: rgba(200,169,81,.03);">
                <div>
                    <h2 class="text-xs font-black uppercase tracking-widest" style="color: var(--gold);">
                        Attendance Record — Training Days 1–{{ $total }}
                    </h2>
                    <p class="text-xs text-slate-400 mt-0.5">Fill in dates left blank for days not yet conducted.</p>
                </div>
                <div class="flex items-center gap-3">
                    @if (session('success'))
                        <p x-data="{ show: true }" x-show="show" x-transition
                           x-init="setTimeout(() => show = false, 3000)"
                           class="text-xs" style="color: #16a34a;">
                            {{ session('success') }}
                        </p>
                    @endif
                    <x-primary-button>Save Attendance</x-primary-button>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full" style="border-collapse: collapse; min-width: 700px;">
                    <thead>
                        <tr style="background: rgba(200,169,81,.05); border-bottom: 2px solid rgba(200,169,81,.15);">
                            <th style="padding:.55rem .7rem; text-align:center; font-size:.6rem; font-weight:800; text-transform:uppercase; letter-spacing:.08em; color: var(--gold); width:48px;">Day</th>
                            <th style="padding:.55rem .7rem; text-align:left; font-size:.6rem; font-weight:800; text-transform:uppercase; letter-spacing:.08em; color: var(--gold);">Date</th>
                            <th style="padding:.55rem .7rem; text-align:center; font-size:.6rem; font-weight:800; text-transform:uppercase; letter-spacing:.08em; color:#047857; width:80px;">Merits</th>
                            <th style="padding:.55rem .7rem; text-align:center; font-size:.6rem; font-weight:800; text-transform:uppercase; letter-spacing:.08em; color:#b91c1c; width:80px;">Demerits</th>
                            <th style="padding:.55rem .7rem; text-align:left; font-size:.6rem; font-weight:800; text-transform:uppercase; letter-spacing:.08em; color:#374151;">Remarks</th>
                            <th style="padding:.55rem .7rem; text-align:left; font-size:.6rem; font-weight:800; text-transform:uppercase; letter-spacing:.08em; color:#374151; white-space:nowrap;">Instructor Signature</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($d = 1; $d <= $total; $d++)
                            @php $rec = $days[$d - 1]; @endphp
                            <tr style="border-bottom: 1px solid #f3f4f6;">
                                <td style="padding:.45rem .7rem; text-align:center;">
                                    <span style="display:inline-flex; align-items:center; justify-content:center; width:1.6rem; height:1.6rem; border-radius:.4rem; background:rgba(200,169,81,.1); border:1px solid rgba(200,169,81,.2); font-size:.7rem; font-weight:800; color: var(--gold);">{{ $d }}</span>
                                </td>
                                <td style="padding:.4rem .5rem;">
                                    <input type="date" name="days[{{ $d }}][training_date]"
                                           value="{{ $rec?->training_date?->format('Y-m-d') ?? '' }}"
                                           class="rounded-md border border-slate-200 px-2 py-1 text-xs text-slate-800 focus:outline-none focus:ring-1"
                                           style="min-width:130px;">
                                </td>
                                <td style="padding:.4rem .5rem; text-align:center;">
                                    <input type="number" name="days[{{ $d }}][merits]" min="0" max="99"
                                           value="{{ $rec?->merits ?? 0 }}"
                                           class="rounded-md border border-slate-200 px-2 py-1 text-xs text-center focus:outline-none focus:ring-1"
                                           style="width:60px; color:#047857; font-weight:700;">
                                </td>
                                <td style="padding:.4rem .5rem; text-align:center;">
                                    <input type="number" name="days[{{ $d }}][demerits]" min="0" max="99"
                                           value="{{ $rec?->demerits ?? 0 }}"
                                           class="rounded-md border border-slate-200 px-2 py-1 text-xs text-center focus:outline-none focus:ring-1"
                                           style="width:60px; color:#b91c1c; font-weight:700;">
                                </td>
                                <td style="padding:.4rem .5rem;">
                                    <input type="text" name="days[{{ $d }}][remarks]" maxlength="500"
                                           value="{{ $rec?->remarks ?? '' }}"
                                           placeholder="e.g. Absent, Late, Excused"
                                           class="rounded-md border border-slate-200 px-2 py-1 text-xs text-slate-700 focus:outline-none focus:ring-1"
                                           style="min-width:160px; width:100%;">
                                </td>
                                <td style="padding:.4rem .5rem;">
                                    <input type="text" name="days[{{ $d }}][e_signature]" maxlength="255"
                                           value="{{ $rec?->e_signature ?? '' }}"
                                           placeholder="Initials / Name"
                                           class="rounded-md border border-slate-200 px-2 py-1 text-xs text-slate-700 focus:outline-none focus:ring-1"
                                           style="min-width:120px;">
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                    {{-- Totals footer --}}
                    @php
                        $totM = $days->sum(fn($r) => $r?->merits ?? 0);
                        $totD = $days->sum(fn($r) => $r?->demerits ?? 0);
                    @endphp
                    <tfoot>
                        <tr style="background: rgba(200,169,81,.04); border-top: 2px solid rgba(200,169,81,.15);">
                            <td colspan="2" style="padding:.55rem .7rem; text-align:right; font-size:.65rem; font-weight:800; text-transform:uppercase; letter-spacing:.08em; color:#64748b;">Total</td>
                            <td style="padding:.55rem .5rem; text-align:center; font-size:.85rem; font-weight:900; color:#047857;">{{ $totM }}</td>
                            <td style="padding:.55rem .5rem; text-align:center; font-size:.85rem; font-weight:900; color:#b91c1c;">{{ $totD }}</td>
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

    </form>
</div>
@endsection
