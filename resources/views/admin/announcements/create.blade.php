@extends('layouts.app')

@section('title', 'Post Announcement')
@section('page-title', 'Post Announcement')

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
    <a href="{{ route('admin.announcements.index') }}" class="sidebar-link active">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
        </svg>
        Announcements
    </a>
    <a href="{{ route('admin.attendance.index') }}" class="sidebar-link">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
        </svg>
        Attendance
    </a>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 items-start">

    {{-- ── Form (2/3) ──────────────────────────────────────────────────────────── --}}
    <div class="lg:col-span-2 card rounded-xl overflow-hidden">
        <div class="h-1" style="background: linear-gradient(90deg, var(--gold2), var(--gold3), var(--gold));"></div>
        <div class="p-5">

            <div class="flex items-center gap-2.5 mb-4 pb-3" style="border-bottom: 1px solid #e2e8f0;">
                <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0"
                     style="background: rgba(200,169,81,.1);">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--gold);">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-slate-800">New Announcement</h3>
                    <p class="text-xs text-slate-400">Visible to all cadets upon posting.</p>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.announcements.store') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-1">
                        Title <span class="text-red-400">*</span>
                    </label>
                    <input type="text" name="title" value="{{ old('title') }}" required maxlength="255"
                           placeholder="e.g. ROTC Training Schedule — Week 3"
                           class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2" />
                    <x-input-error :messages="$errors->get('title')" class="mt-1" />
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-1">
                        Content <span class="text-red-400">*</span>
                    </label>
                    <textarea name="content" required rows="8"
                              placeholder="Write your announcement here..."
                              class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2 resize-none">{{ old('content') }}</textarea>
                    <x-input-error :messages="$errors->get('content')" class="mt-1" />
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-1">Publish At</label>
                        <input type="datetime-local" name="published_at"
                               value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}"
                               class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2" />
                        <x-input-error :messages="$errors->get('published_at')" class="mt-1" />
                    </div>
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-1">
                            Expires At <span class="text-slate-400 font-normal normal-case">(optional)</span>
                        </label>
                        <input type="datetime-local" name="expires_at"
                               value="{{ old('expires_at') }}"
                               class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2" />
                        <p class="text-xs text-slate-400 mt-0.5">Auto-hides after this date.</p>
                        <x-input-error :messages="$errors->get('expires_at')" class="mt-1" />
                    </div>
                </div>

                <label class="flex items-center gap-3 cursor-pointer select-none">
                    <input type="hidden" name="is_pinned" value="0">
                    <input type="checkbox" name="is_pinned" value="1"
                           {{ old('is_pinned') ? 'checked' : '' }}
                           class="w-4 h-4 rounded" style="accent-color: var(--gold);" />
                    <div>
                        <span class="text-sm font-semibold text-slate-700">Pin this announcement</span>
                        <p class="text-xs text-slate-400">Pinned posts always appear at the top.</p>
                    </div>
                </label>

                <div class="pt-1 flex items-center gap-3">
                    <x-primary-button>Post Announcement</x-primary-button>
                    <a href="{{ route('admin.dashboard') }}"
                       class="text-xs text-slate-400 hover:text-slate-600 transition-colors">Cancel</a>
                </div>

            </form>
        </div>
    </div>

    {{-- ── Tips sidebar (1/3) ──────────────────────────────────────────────────── --}}
    <div class="flex flex-col gap-4">

        <div class="card rounded-xl p-4">
            <p class="text-xs font-bold uppercase tracking-widest mb-3 pb-2"
               style="color: var(--gold); border-bottom: 1px solid rgba(200,169,81,.15);">Tips</p>
            <ul class="space-y-2.5 text-xs text-slate-500">
                <li class="flex items-start gap-2">
                    <svg class="w-3.5 h-3.5 shrink-0 mt-0.5" fill="none" stroke="#4ade80" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                    Keep titles short and specific so cadets know what to expect at a glance.
                </li>
                <li class="flex items-start gap-2">
                    <svg class="w-3.5 h-3.5 shrink-0 mt-0.5" fill="none" stroke="#4ade80" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                    Use <strong>Pin</strong> only for critical or time-sensitive messages.
                </li>
                <li class="flex items-start gap-2">
                    <svg class="w-3.5 h-3.5 shrink-0 mt-0.5" fill="none" stroke="#4ade80" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                    Set an <strong>Expires At</strong> date for event-specific announcements so they auto-hide.
                </li>
                <li class="flex items-start gap-2">
                    <svg class="w-3.5 h-3.5 shrink-0 mt-0.5" fill="none" stroke="#4ade80" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                    To schedule a future post, change the <strong>Publish At</strong> date.
                </li>
            </ul>
        </div>

        <div class="card rounded-xl p-4">
            <p class="text-xs font-bold uppercase tracking-widest mb-2 pb-2"
               style="color: var(--gold); border-bottom: 1px solid rgba(200,169,81,.15);">Visibility</p>
            <p class="text-xs text-slate-500 leading-relaxed">
                Posted announcements are visible to <strong class="text-slate-700">all cadets</strong>
                immediately. Drafts are not yet supported — leave <em>Publish At</em> in the future to delay.
            </p>
        </div>

    </div>

</div>
@endsection
