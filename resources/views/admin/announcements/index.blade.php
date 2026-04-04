@extends('layouts.app')

@section('title', 'Announcements')
@section('page-title', 'Announcements')

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
<div class="card rounded-xl overflow-hidden">

    {{-- Header --}}
    <div class="h-1" style="background: linear-gradient(90deg, var(--gold2), var(--gold3), var(--gold));"></div>
    <div class="flex items-center justify-between px-5 py-4 border-b" style="border-color: rgba(4,9,15,0.08);">
        <div>
            <h2 class="text-sm font-bold text-slate-800 uppercase tracking-wider">Posted Announcements</h2>
            <p class="text-xs text-slate-400 mt-0.5">{{ $announcements->count() }} announcement(s) total</p>
        </div>
        <a href="{{ route('admin.announcements.create') }}"
           class="text-xs px-3 py-1.5 rounded-lg font-semibold transition-colors"
           style="background: rgba(200,169,81,0.15); color: #c8a951; border: 1px solid rgba(200,169,81,0.3);">
            + Post New
        </a>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr style="background: #f8fafc;">
                    <th class="px-5 py-3 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Title</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Status</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Pinned</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Published</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Expires</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Author</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($announcements as $ann)
                    @php
                        $now = now();
                        if (!$ann->published_at || $ann->published_at > $now) {
                            $statusLabel = 'Scheduled';
                            $statusStyle = 'background: rgba(251,191,36,.12); color: #b45309; border: 1px solid rgba(251,191,36,.3);';
                        } elseif ($ann->expires_at && $ann->expires_at < $now) {
                            $statusLabel = 'Expired';
                            $statusStyle = 'background: rgba(148,163,184,.12); color: #64748b; border: 1px solid rgba(148,163,184,.3);';
                        } else {
                            $statusLabel = 'Visible';
                            $statusStyle = 'background: rgba(74,222,128,.12); color: #16a34a; border: 1px solid rgba(74,222,128,.3);';
                        }
                    @endphp
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-5 py-3">
                            <p class="font-semibold text-slate-900 text-sm leading-tight">{{ $ann->title }}</p>
                            <p class="text-xs text-slate-400 mt-0.5 truncate max-w-xs">{{ Str::limit($ann->content, 60) }}</p>
                        </td>
                        <td class="px-5 py-3">
                            <span class="text-xs px-2 py-0.5 rounded-full font-semibold" style="{{ $statusStyle }}">
                                {{ $statusLabel }}
                            </span>
                        </td>
                        <td class="px-5 py-3">
                            @if ($ann->is_pinned)
                                <svg class="w-4 h-4" fill="none" stroke="#c8a951" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                                </svg>
                            @else
                                <span class="text-slate-300 text-xs">—</span>
                            @endif
                        </td>
                        <td class="px-5 py-3 text-xs text-slate-500 whitespace-nowrap">
                            {{ $ann->published_at?->format('d M Y, H:i') ?? '—' }}
                        </td>
                        <td class="px-5 py-3 text-xs text-slate-500 whitespace-nowrap">
                            {{ $ann->expires_at?->format('d M Y, H:i') ?? '—' }}
                        </td>
                        <td class="px-5 py-3 text-xs text-slate-600">
                            {{ $ann->author?->name ?? '—' }}
                        </td>
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.announcements.edit', $ann) }}"
                                   class="text-xs px-2.5 py-1 rounded font-semibold transition-colors"
                                   style="background: rgba(200,169,81,0.1); color: #c8a951; border: 1px solid rgba(200,169,81,0.2);">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('admin.announcements.destroy', $ann) }}"
                                      onsubmit="return confirm('Delete this announcement?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-xs px-2.5 py-1 rounded font-semibold transition-colors"
                                            style="background: rgba(248,113,113,0.1); color: #ef4444; border: 1px solid rgba(248,113,113,0.2);">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-5 py-16 text-center text-sm text-slate-400">
                            No announcements yet.
                            <a href="{{ route('admin.announcements.create') }}" class="underline" style="color: var(--gold);">Post one now.</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
