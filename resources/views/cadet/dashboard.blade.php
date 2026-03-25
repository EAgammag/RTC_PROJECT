@extends('layouts.app')

@section('title', 'Cadet Dashboard')
@section('page-title', 'Cadet Dashboard')

@section('sidebar-nav')
    <a href="{{ route('cadet.dashboard') }}" class="sidebar-link active">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>
        My Dashboard
    </a>
    <div class="sidebar-link cursor-default opacity-50">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
        </svg>
        My Profile <span class="text-xs ml-auto">(coming soon)</span>
    </div>
    <div class="sidebar-link cursor-default opacity-50">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2
                     M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
        </svg>
        My Attendance <span class="text-xs ml-auto">(coming soon)</span>
    </div>
@endsection

@section('content')

    {{-- ── Personal info card ────────────────────────────────────────────────── --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

        {{-- Profile --}}
        <div class="stat-card rounded-xl p-6 flex flex-col items-center text-center">
            <div class="w-16 h-16 rounded-full flex items-center justify-center mb-3"
                 style="background: linear-gradient(135deg, #c8a951 0%, #a08030 100%);">
                <span class="text-2xl font-bold" style="color: #061020;">
                    {{ strtoupper(substr($cadet->name, 0, 1)) }}
                </span>
            </div>
            <h2 class="text-lg font-bold text-white">{{ $cadet->name }}</h2>
            <p class="text-sm mt-1" style="color: #c8a951;">ROTC Cadet</p>
            <p class="text-xs text-slate-400 mt-1 font-mono">{{ $cadet->student_id ?? 'No ID assigned' }}</p>
        </div>

        {{-- Account details --}}
        <div class="card rounded-xl p-6">
            <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-4">Account Details</h3>
            <dl class="space-y-3 text-sm">
                <div class="flex justify-between">
                    <dt class="text-slate-400">Email</dt>
                    <dd class="text-white">{{ $cadet->email }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-slate-400">Role</dt>
                    <dd>
                        <span class="text-xs px-2 py-0.5 rounded-full font-semibold uppercase"
                              style="background: rgba(52,211,153,0.15); color: #34d399; border: 1px solid rgba(52,211,153,0.3);">
                            Cadet
                        </span>
                    </dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-slate-400">Status</dt>
                    <dd>
                        <span class="text-xs px-2 py-0.5 rounded-full font-semibold"
                              style="background: rgba(74,222,128,0.12); color: #4ade80; border: 1px solid rgba(74,222,128,0.3);">
                            Active
                        </span>
                    </dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-slate-400">Last Login</dt>
                    <dd class="text-white">
                        {{ $cadet->last_login_at ? $cadet->last_login_at->format('d M Y, H:i') : 'First login' }}
                    </dd>
                </div>
            </dl>
        </div>

        {{-- Access level --}}
        <div class="card rounded-xl p-6">
            <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-4">Your Access Level</h3>
            <ul class="space-y-2 text-sm">
                @php
                    $perms = [
                        ['label' => 'View my profile',           'allowed' => true],
                        ['label' => 'View my attendance',        'allowed' => true],
                        ['label' => 'View my grades',            'allowed' => true],
                        ['label' => 'Submit digital documents',  'allowed' => true],
                        ['label' => 'View other cadet records',  'allowed' => false],
                        ['label' => 'Modify any records',        'allowed' => false],
                        ['label' => 'Access system settings',    'allowed' => false],
                    ];
                @endphp
                @foreach ($perms as $perm)
                    <li class="flex items-center gap-2">
                        @if ($perm['allowed'])
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="#4ade80" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-slate-300">{{ $perm['label'] }}</span>
                        @else
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="#f87171" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            <span class="text-slate-500 line-through">{{ $perm['label'] }}</span>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    {{-- ── Notice ─────────────────────────────────────────────────────────────── --}}
    <div class="card rounded-xl p-5">
        <h3 class="text-xs font-semibold uppercase tracking-wider mb-2" style="color: #c8a951;">
            Security Notice
        </h3>
        <p class="text-xs text-slate-400">
            Your session is protected and will <strong class="text-slate-200">expire after 30 minutes</strong>
            of inactivity. Always click <strong class="text-slate-200">Secure Logout</strong> when finished,
            especially on shared devices. Never share your password with anyone, including unit staff.
        </p>
    </div>

@endsection
