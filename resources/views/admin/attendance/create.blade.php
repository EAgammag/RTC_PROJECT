@extends('layouts.app')

@section('title', 'New Training Session')
@section('page-title', 'New Training Session')

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
    <a href="{{ route('admin.announcements.create') }}" class="sidebar-link">
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
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 items-start">

    {{-- Form (2/3) --}}
    <div class="lg:col-span-2 card rounded-xl overflow-hidden">
        <div class="h-1" style="background: linear-gradient(90deg, var(--gold2), var(--gold3), var(--gold));"></div>
        <div class="p-5">
            <div class="flex items-center gap-2.5 mb-4 pb-3" style="border-bottom: 1px solid #e2e8f0;">
                <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0"
                     style="background: rgba(200,169,81,.1);">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--gold);">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-slate-800">Session Details</h3>
                    <p class="text-xs text-slate-400">After saving, you'll be taken to mark attendance.</p>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.attendance.store') }}" class="space-y-4">
                @csrf

                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-1">
                            Session Title <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="title" value="{{ old('title') }}" required maxlength="255"
                               placeholder="e.g. Weekly Drill Training — Week 5"
                               class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2" />
                        <x-input-error :messages="$errors->get('title')" class="mt-1" />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-1">
                            Date <span class="text-red-400">*</span>
                        </label>
                        <input type="date" name="session_date" value="{{ old('session_date', today()->format('Y-m-d')) }}" required
                               class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2" />
                        <x-input-error :messages="$errors->get('session_date')" class="mt-1" />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-1">
                            Session Type <span class="text-red-400">*</span>
                        </label>
                        <select name="session_type" required
                                class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-800 bg-white focus:outline-none focus:ring-2">
                            <option value="">— Select —</option>
                            @foreach ($types as $type)
                                <option value="{{ $type }}" {{ old('session_type') === $type ? 'selected' : '' }}>
                                    {{ $type }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('session_type')" class="mt-1" />
                    </div>

                    <div class="col-span-2">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-1">
                            Location <span class="text-slate-400 font-normal normal-case">(optional)</span>
                        </label>
                        <input type="text" name="location" value="{{ old('location') }}" maxlength="255"
                               placeholder="e.g. Parade Ground, CSU Aparri"
                               class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2" />
                        <x-input-error :messages="$errors->get('location')" class="mt-1" />
                    </div>

                    <div class="col-span-2">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-1">
                            Notes <span class="text-slate-400 font-normal normal-case">(optional)</span>
                        </label>
                        <textarea name="notes" rows="3"
                                  placeholder="Any additional notes about this session..."
                                  class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-800 focus:outline-none focus:ring-2 resize-none">{{ old('notes') }}</textarea>
                        <x-input-error :messages="$errors->get('notes')" class="mt-1" />
                    </div>
                </div>

                <div class="pt-1 flex items-center gap-3">
                    <x-primary-button>Create &amp; Mark Attendance</x-primary-button>
                    <a href="{{ route('admin.attendance.index') }}"
                       class="text-xs text-slate-400 hover:text-slate-600 transition-colors">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    {{-- Sidebar (1/3) --}}
    <div class="flex flex-col gap-4">
        <div class="card rounded-xl p-4">
            <p class="text-xs font-bold uppercase tracking-widest mb-3 pb-2"
               style="color: var(--gold); border-bottom: 1px solid rgba(200,169,81,.15);">Session Types</p>
            <ul class="space-y-1.5 text-xs text-slate-500">
                @foreach ($types as $type)
                    <li class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-slate-300 shrink-0"></span>
                        {{ $type }}
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="card rounded-xl p-4">
            <p class="text-xs font-bold uppercase tracking-widest mb-2 pb-2"
               style="color: var(--gold); border-bottom: 1px solid rgba(200,169,81,.15);">Workflow</p>
            <ol class="space-y-2 text-xs text-slate-500 list-none">
                <li class="flex items-start gap-2">
                    <span class="w-4 h-4 rounded-full flex items-center justify-center text-xs font-black shrink-0 mt-0.5"
                          style="background: rgba(200,169,81,.15); color: var(--gold);">1</span>
                    Fill in the session details and submit.
                </li>
                <li class="flex items-start gap-2">
                    <span class="w-4 h-4 rounded-full flex items-center justify-center text-xs font-black shrink-0 mt-0.5"
                          style="background: rgba(200,169,81,.15); color: var(--gold);">2</span>
                    Mark each cadet's status on the next page.
                </li>
                <li class="flex items-start gap-2">
                    <span class="w-4 h-4 rounded-full flex items-center justify-center text-xs font-black shrink-0 mt-0.5"
                          style="background: rgba(200,169,81,.15); color: var(--gold);">3</span>
                    Cadets can immediately view their updated attendance.
                </li>
            </ol>
        </div>
    </div>

</div>
@endsection
