@extends('layouts.app')

@section('title', 'Edit Announcement')
@section('page-title', 'Edit Announcement')

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
                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-slate-800">Edit Announcement</h3>
                    <p class="text-xs text-slate-400">Changes are saved and visible to cadets immediately.</p>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.announcements.update', $announcement) }}" class="space-y-4">
                @csrf
                @method('PATCH')

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-1">
                        Title <span class="text-red-400">*</span>
                    </label>
                    <input type="text" name="title" value="{{ old('title', $announcement->title) }}" required maxlength="255"
                           class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2" />
                    <x-input-error :messages="$errors->get('title')" class="mt-1" />
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-1">
                        Content <span class="text-red-400">*</span>
                    </label>
                    <textarea name="content" required rows="8"
                              class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2 resize-none">{{ old('content', $announcement->content) }}</textarea>
                    <x-input-error :messages="$errors->get('content')" class="mt-1" />
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-1">Publish At</label>
                        <input type="datetime-local" name="published_at"
                               value="{{ old('published_at', $announcement->published_at?->format('Y-m-d\TH:i')) }}"
                               class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2" />
                        <x-input-error :messages="$errors->get('published_at')" class="mt-1" />
                    </div>
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-1">
                            Expires At <span class="text-slate-400 font-normal normal-case">(optional)</span>
                        </label>
                        <input type="datetime-local" name="expires_at"
                               value="{{ old('expires_at', $announcement->expires_at?->format('Y-m-d\TH:i')) }}"
                               class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2" />
                        <p class="text-xs text-slate-400 mt-0.5">Auto-hides after this date.</p>
                        <x-input-error :messages="$errors->get('expires_at')" class="mt-1" />
                    </div>
                </div>

                <label class="flex items-center gap-3 cursor-pointer select-none">
                    <input type="hidden" name="is_pinned" value="0">
                    <input type="checkbox" name="is_pinned" value="1"
                           {{ old('is_pinned', $announcement->is_pinned) ? 'checked' : '' }}
                           class="w-4 h-4 rounded" style="accent-color: var(--gold);" />
                    <div>
                        <span class="text-sm font-semibold text-slate-700">Pin this announcement</span>
                        <p class="text-xs text-slate-400">Pinned posts always appear at the top.</p>
                    </div>
                </label>

                <div class="pt-1 flex items-center gap-3">
                    <x-primary-button>Save Changes</x-primary-button>
                    <a href="{{ route('admin.announcements.index') }}"
                       class="text-xs text-slate-400 hover:text-slate-600 transition-colors">Cancel</a>
                    <form method="POST" action="{{ route('admin.announcements.destroy', $announcement) }}"
                          class="ml-auto"
                          onsubmit="return confirm('Permanently delete this announcement?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="text-xs px-3 py-1.5 rounded-lg font-semibold transition-colors"
                                style="background: rgba(248,113,113,0.1); color: #ef4444; border: 1px solid rgba(248,113,113,0.2);">
                            Delete Announcement
                        </button>
                    </form>
                </div>

            </form>
        </div>
    </div>

    {{-- ── Info sidebar (1/3) ───────────────────────────────────────────────────── --}}
    <div class="flex flex-col gap-4">

        <div class="card rounded-xl p-4">
            <p class="text-xs font-bold uppercase tracking-widest mb-3 pb-2"
               style="color: var(--gold); border-bottom: 1px solid rgba(200,169,81,.15);">Current Status</p>
            @php
                $now = now();
                if (!$announcement->published_at || $announcement->published_at > $now) {
                    $label = 'Scheduled'; $style = 'color:#b45309;';
                } elseif ($announcement->expires_at && $announcement->expires_at < $now) {
                    $label = 'Expired'; $style = 'color:#64748b;';
                } else {
                    $label = 'Visible to cadets'; $style = 'color:#16a34a;';
                }
            @endphp
            <p class="text-sm font-bold" style="{{ $style }}">{{ $label }}</p>
            <dl class="mt-2 space-y-1 text-xs text-slate-500">
                <div class="flex justify-between">
                    <dt>Posted by</dt>
                    <dd class="font-medium text-slate-700">{{ $announcement->author?->name ?? '—' }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt>Created</dt>
                    <dd class="font-medium text-slate-700">{{ $announcement->created_at->format('d M Y') }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt>Last updated</dt>
                    <dd class="font-medium text-slate-700">{{ $announcement->updated_at->format('d M Y, H:i') }}</dd>
                </div>
            </dl>
        </div>

        <div class="card rounded-xl p-4">
            <p class="text-xs font-bold uppercase tracking-widest mb-2 pb-2"
               style="color: var(--gold); border-bottom: 1px solid rgba(200,169,81,.15);">Tips</p>
            <ul class="space-y-2 text-xs text-slate-500">
                <li class="flex items-start gap-2">
                    <svg class="w-3.5 h-3.5 shrink-0 mt-0.5" fill="none" stroke="#4ade80" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                    Editing saves immediately — cadets will see the updated content right away.
                </li>
                <li class="flex items-start gap-2">
                    <svg class="w-3.5 h-3.5 shrink-0 mt-0.5" fill="none" stroke="#4ade80" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                    To hide without deleting, set <strong>Expires At</strong> to a past date.
                </li>
            </ul>
        </div>

    </div>

</div>
@endsection
