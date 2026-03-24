@extends('layouts.app')

@section('title', 'Officer Dashboard')
@section('page-title', 'Officer Dashboard')

@section('sidebar-nav')
    <a href="{{ route('officer.dashboard') }}" class="sidebar-link active">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>
        Dashboard
    </a>
    <div class="sidebar-link cursor-default opacity-50">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
        </svg>
        Attendance <span class="text-xs ml-auto">(coming soon)</span>
    </div>
    <div class="sidebar-link cursor-default opacity-50">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2
                     2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
        </svg>
        Grades <span class="text-xs ml-auto">(coming soon)</span>
    </div>
@endsection

@section('content')

    {{-- ── Stats ─────────────────────────────────────────────────────────────── --}}
    <div class="grid grid-cols-2 gap-4 mb-8 max-w-sm">
        <div class="stat-card rounded-xl p-4 text-center">
            <p class="text-3xl font-bold text-white">{{ $stats['total_cadets'] }}</p>
            <p class="text-xs text-slate-400 uppercase tracking-wider mt-1">Total Cadets</p>
        </div>
        <div class="stat-card rounded-xl p-4 text-center">
            <p class="text-3xl font-bold" style="color: #4ade80;">{{ $stats['active_cadets'] }}</p>
            <p class="text-xs text-slate-400 uppercase tracking-wider mt-1">Active Cadets</p>
        </div>
    </div>

    {{-- ── Cadet roster ──────────────────────────────────────────────────────── --}}
    <div class="card rounded-xl overflow-hidden">
        <div class="px-6 py-4 border-b" style="border-color: rgba(255,255,255,0.08);">
            <h2 class="text-sm font-semibold text-white uppercase tracking-wider">Cadet Roster</h2>
            <p class="text-xs text-slate-400 mt-0.5">View-only — officer access is read-only for cadet records.</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr style="background: rgba(255,255,255,0.03);">
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">#</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Student ID</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Last Login</th>
                    </tr>
                </thead>
                <tbody class="divide-y" style="divide-color: rgba(255,255,255,0.05);">
                    @forelse ($cadets as $index => $cadet)
                        <tr class="hover:bg-white/5 transition-colors">
                            <td class="px-6 py-4 text-slate-500 text-xs">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 text-white font-medium">{{ $cadet->name }}</td>
                            <td class="px-6 py-4 text-slate-300 font-mono text-xs">{{ $cadet->student_id ?? '—' }}</td>
                            <td class="px-6 py-4 text-slate-300">{{ $cadet->email }}</td>
                            <td class="px-6 py-4 text-slate-400 text-xs">
                                {{ $cadet->last_login_at ? $cadet->last_login_at->diffForHumans() : 'Never' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-500">No cadets enrolled yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ── Access reminder ───────────────────────────────────────────────────── --}}
    <div class="mt-6 card rounded-xl p-5">
        <h3 class="text-xs font-semibold uppercase tracking-wider mb-2" style="color: #c8a951;">
            Officer Access Level
        </h3>
        <p class="text-xs text-slate-400">
            As an officer, you may <strong class="text-slate-200">view cadet records</strong> and
            <strong class="text-slate-200">generate unit reports</strong>. You cannot modify system
            configuration, delete records, or view other officers' accounts.
            All actions are subject to audit logging.
        </p>
    </div>

@endsection
