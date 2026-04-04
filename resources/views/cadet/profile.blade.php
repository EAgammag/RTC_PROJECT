@extends('layouts.app')

@section('title', 'My Profile')
@section('page-title', 'My Profile')

@section('sidebar-nav')
    <a href="{{ route('cadet.dashboard') }}" class="sidebar-link">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>
        My Dashboard
    </a>
    <a href="{{ route('cadet.profile') }}" class="sidebar-link active">
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

    {{-- ── Profile Hero (full width) ───────────────────────────────────────────── --}}
    <div class="card rounded-xl overflow-hidden">
        <div class="h-1" style="background: linear-gradient(90deg, var(--gold2), var(--gold3), var(--gold));"></div>
        <div class="p-4 flex items-center gap-5">
            <div class="w-16 h-16 rounded-full flex items-center justify-center shrink-0 font-black text-2xl"
                 style="background: linear-gradient(135deg, var(--gold3), var(--gold)); color: var(--navy); box-shadow: 0 4px 16px rgba(200,169,81,.35);">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div class="flex-1 min-w-0">
                <h2 class="text-lg font-black text-slate-900 truncate">{{ $user->name }}</h2>
                <p class="text-xs text-slate-500 font-mono mt-0.5">{{ $user->student_id ?? 'No Student ID assigned' }}</p>
                <div class="flex flex-wrap items-center gap-2 mt-1.5">
                    <span class="text-xs px-2 py-0.5 rounded-full font-semibold uppercase"
                          style="background: rgba(200,169,81,.12); color: var(--gold); border: 1px solid rgba(200,169,81,.3);">
                        ROTC Cadet
                    </span>
                    <span class="text-xs px-2 py-0.5 rounded-full font-semibold"
                          style="background: rgba(74,222,128,.12); color: #4ade80; border: 1px solid rgba(74,222,128,.3);">
                        Active
                    </span>
                </div>
            </div>
            <div class="hidden sm:flex flex-col items-end text-right shrink-0">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Last Login</p>
                <p class="text-sm text-slate-700 mt-0.5">{{ $user->last_login_at ? $user->last_login_at->format('d M Y, H:i') : '—' }}</p>
            </div>
        </div>
    </div>

    {{-- ── Two-column body ──────────────────────────────────────────────────────── --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 items-start">

        {{-- Left: Cadet Details (takes 2/3) --}}
        <div class="lg:col-span-2 card rounded-xl p-5">
            <div class="flex items-center gap-2.5 mb-4 pb-3" style="border-bottom: 1px solid #e2e8f0;">
                <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0"
                     style="background: rgba(200,169,81,.1);">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--gold);">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-slate-800">Cadet Details</h3>
                    <p class="text-xs text-slate-400">Personal, academic, physical & emergency info.</p>
                </div>
            </div>
            @include('cadet.partials.update-cadet-info-form')
        </div>

        {{-- Right: Account cards (takes 1/3) --}}
        <div class="flex flex-col gap-4">

            {{-- Profile Information --}}
            <div class="card rounded-xl p-5">
                <div class="flex items-center gap-2.5 mb-4 pb-3" style="border-bottom: 1px solid #e2e8f0;">
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0"
                         style="background: rgba(200,169,81,.1);">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--gold);">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-slate-800">Profile Information</h3>
                        <p class="text-xs text-slate-400">Update your name and email.</p>
                    </div>
                </div>
                @include('profile.partials.update-profile-information-form', ['hidePartialHeader' => true])
            </div>

            {{-- Update Password --}}
            <div class="card rounded-xl p-5">
                <div class="flex items-center gap-2.5 mb-4 pb-3" style="border-bottom: 1px solid #e2e8f0;">
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0"
                         style="background: rgba(200,169,81,.1);">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--gold);">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-slate-800">Update Password</h3>
                        <p class="text-xs text-slate-400">Keep your account secure.</p>
                    </div>
                </div>
                @include('profile.partials.update-password-form', ['hidePartialHeader' => true])
            </div>

            {{-- Danger Zone --}}
            <div class="rounded-xl p-5" style="background: #fff5f5; border: 1px solid #fecaca;">
                <div class="flex items-center gap-2.5 mb-4 pb-3" style="border-bottom: 1px solid #fecaca;">
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0"
                         style="background: rgba(248,113,113,.12);">
                        <svg class="w-3.5 h-3.5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold" style="color: #dc2626;">Danger Zone</h3>
                        <p class="text-xs" style="color: #ef4444;">Irreversible actions.</p>
                    </div>
                </div>
                @include('profile.partials.delete-user-form', ['hidePartialHeader' => true])
            </div>

        </div>
    </div>

</div>
@endsection
