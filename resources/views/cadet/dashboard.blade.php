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
    <a href="{{ route('cadet.profile') }}" class="sidebar-link">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
        </svg>
        My Profile
    </a>
    <a href="{{ route('cadet.announcements') }}" class="sidebar-link">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
        </svg>
        Announcements
    </a>
    <a href="{{ route('cadet.attendance') }}" class="sidebar-link">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2
                     M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
        </svg>
        My Attendance
    </a>
@endsection

@section('content')
<div class="space-y-4">

    {{-- ── On-hold enrollment banner ──────────────────────────────────────────── --}}
    @unless($cadet->student_id)
    <div class="rounded-xl overflow-hidden" style="background: linear-gradient(135deg, #fffbeb, #fef3c7); border: 1px solid #fde68a;">
        <div class="h-1" style="background: linear-gradient(90deg, #f59e0b, #d97706, #f59e0b);"></div>
        <div class="p-5 flex flex-col sm:flex-row items-start sm:items-center gap-4">
            <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0"
                 style="background: rgba(245,158,11,.15);">
                <svg class="w-5 h-5" style="color:#d97706;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 9v2m0 4h.01M12 3l9.09 16.91H2.91L12 3z"/>
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <h3 class="text-sm font-bold text-amber-900 mb-0.5">Account On Hold</h3>
                <p class="text-xs text-amber-700 leading-relaxed">
                    Your account has been created successfully, but it is currently <strong>on hold</strong>.
                    Please complete the enrollment process to activate your account and gain full access to the portal.
                </p>
            </div>
            <div class="shrink-0 flex flex-col sm:flex-row gap-2">
                <a href="{{ route('enroll.form') }}"
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-bold text-white transition-all"
                   style="background: #d97706; box-shadow: 0 2px 8px rgba(217,119,6,.25);"
                   onmouseover="this.style.background='#b45309'" onmouseout="this.style.background='#d97706'">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Enroll Here
                </a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-bold transition-all w-full justify-center"
                            style="background: rgba(120,113,108,.1); color: #57534e; border: 1px solid rgba(120,113,108,.2);"
                            onmouseover="this.style.background='rgba(120,113,108,.18)'" onmouseout="this.style.background='rgba(120,113,108,.1)'">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Log Out & Continue Later
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endunless

    {{-- ── Top row ────────────────────────────────────────────────────────────── --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

        {{-- Profile card --}}
        <div class="stat-card rounded-xl p-4 flex flex-col justify-between">

            {{-- Identity --}}
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-full flex items-center justify-center shrink-0 font-black text-lg"
                     style="background: linear-gradient(135deg, var(--gold3), var(--gold)); color: var(--navy);">
                    {{ strtoupper(substr($cadet->name, 0, 1)) }}
                </div>
                <div class="min-w-0">
                    <h2 class="text-sm font-black text-slate-900 truncate">{{ $cadet->name }}</h2>
                    <p class="text-xs font-mono text-slate-400 truncate">{{ $cadet->student_id ?? 'No ID assigned' }}</p>
                    <div class="flex items-center gap-1.5 mt-1">
                        <span class="text-xs px-1.5 py-0.5 rounded-full font-semibold uppercase"
                              style="background: rgba(200,169,81,.12); color: var(--gold); border: 1px solid rgba(200,169,81,.3);">
                            Cadet
                        </span>
                        <span class="text-xs px-1.5 py-0.5 rounded-full font-semibold"
                              style="background: rgba(74,222,128,.12); color: #4ade80; border: 1px solid rgba(74,222,128,.3);">
                            Active
                        </span>
                    </div>
                </div>
            </div>

            {{-- Quick stats --}}
            <dl class="space-y-1.5 text-xs border-t border-slate-100 pt-3">
                <div class="flex justify-between">
                    <dt class="text-slate-400">Email</dt>
                    <dd class="text-slate-700 truncate max-w-[60%] text-right">{{ $cadet->email }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-slate-400">Contact</dt>
                    <dd class="text-slate-700">{{ $cadet->contact_number ?? '—' }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-slate-400">Last Login</dt>
                    <dd class="text-slate-700">
                        {{ $cadet->last_login_at ? $cadet->last_login_at->format('d M Y, H:i') : 'First login' }}
                    </dd>
                </div>
            </dl>

        </div>

        {{-- Cadet details --}}
        <div class="card rounded-xl p-4">
            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Cadet Details</h3>

            <dl class="grid grid-cols-2 gap-x-4 gap-y-2 text-xs">
                <div>
                    <dt class="text-slate-400">Date of Birth</dt>
                    <dd class="text-slate-800 font-medium mt-0.5">
                        {{ $cadet->date_of_birth ? $cadet->date_of_birth->format('d M Y') : '—' }}
                    </dd>
                </div>
                <div>
                    <dt class="text-slate-400">Age</dt>
                    <dd class="text-slate-800 font-medium mt-0.5">
                        {{ $cadet->date_of_birth ? $cadet->date_of_birth->diffInYears(now()) . ' yrs' : '—' }}
                    </dd>
                </div>
                <div>
                    <dt class="text-slate-400">Gender</dt>
                    <dd class="text-slate-800 font-medium mt-0.5">{{ $cadet->gender ?? '—' }}</dd>
                </div>
                <div>
                    <dt class="text-slate-400">Blood Type</dt>
                    <dd class="text-slate-800 font-medium mt-0.5">{{ $cadet->blood_type ?? '—' }}</dd>
                </div>
                <div>
                    <dt class="text-slate-400">Religion</dt>
                    <dd class="text-slate-800 font-medium mt-0.5">{{ $cadet->religion ?? '—' }}</dd>
                </div>
                <div>
                    <dt class="text-slate-400">Course / Year</dt>
                    <dd class="text-slate-800 font-medium mt-0.5">{{ $cadet->course_year ?? '—' }}</dd>
                </div>
                <div>
                    <dt class="text-slate-400">Height</dt>
                    <dd class="text-slate-800 font-medium mt-0.5">{{ $cadet->height ?? '—' }}</dd>
                </div>
                <div>
                    <dt class="text-slate-400">Weight</dt>
                    <dd class="text-slate-800 font-medium mt-0.5">
                        {{ $cadet->weight ? $cadet->weight . ' kg' : '—' }}
                    </dd>
                </div>
                <div class="col-span-2">
                    <dt class="text-slate-400">Address</dt>
                    <dd class="text-slate-800 font-medium mt-0.5">{{ $cadet->address ?? '—' }}</dd>
                </div>
            </dl>
        </div>

        {{-- Access level + Emergency --}}
        <div class="flex flex-col gap-4">

            {{-- Access level --}}
            <div class="card rounded-xl p-4 flex-1">
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Access Level</h3>
                @php
                    $perms = [
                        ['label' => 'View my profile',          'allowed' => true],
                        ['label' => 'View my attendance',       'allowed' => true],
                        ['label' => 'View my grades',           'allowed' => true],
                        ['label' => 'Submit digital documents', 'allowed' => true],
                        ['label' => 'View other cadet records', 'allowed' => false],
                        ['label' => 'Modify any records',       'allowed' => false],
                        ['label' => 'Access system settings',   'allowed' => false],
                    ];
                @endphp
                <ul class="space-y-1.5">
                    @foreach ($perms as $perm)
                        <li class="flex items-center gap-2 text-xs">
                            @if ($perm['allowed'])
                                <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="#4ade80" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-slate-700">{{ $perm['label'] }}</span>
                            @else
                                <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="#f87171" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                <span class="text-slate-400 line-through">{{ $perm['label'] }}</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Emergency contact --}}
            <div class="card rounded-xl p-4">
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Emergency Contact</h3>
                @if ($cadet->emergency_name)
                    <dl class="space-y-1 text-xs">
                        <div class="flex justify-between">
                            <dt class="text-slate-400">Name</dt>
                            <dd class="text-slate-800 font-medium">{{ $cadet->emergency_name }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-slate-400">Relation</dt>
                            <dd class="text-slate-800 font-medium">{{ $cadet->emergency_relationship ?? '—' }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-slate-400">Contact</dt>
                            <dd class="text-slate-800 font-medium">{{ $cadet->emergency_contact ?? '—' }}</dd>
                        </div>
                    </dl>
                @else
                    <p class="text-xs text-slate-400 italic">
                        Not set —
                        <a href="{{ route('cadet.profile') }}" class="underline" style="color: var(--gold);">add one</a>
                    </p>
                @endif
            </div>

        </div>
    </div>

    {{-- ── Security notice ────────────────────────────────────────────────────── --}}
    <div class="card rounded-xl px-4 py-3 flex items-start gap-3">
        <svg class="w-4 h-4 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
             style="color: var(--gold);">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
        </svg>
        <p class="text-xs text-slate-500">
            Session expires after <strong class="text-slate-700">30 minutes</strong> of inactivity.
            Always <strong class="text-slate-700">Secure Logout</strong> on shared devices.
            Never share your password with anyone, including unit staff.
        </p>
    </div>

</div>
@endsection
