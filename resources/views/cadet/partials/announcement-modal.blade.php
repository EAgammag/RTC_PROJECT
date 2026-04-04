@php
    $popupAnnouncement = \App\Models\Announcement::visible()->ordered()->first();
@endphp

@if ($popupAnnouncement)
<div
    x-data="{ open: true }"
    x-show="open"
    x-transition.opacity
    class="fixed inset-0 z-50 flex items-center justify-center"
    style="display: none;"
    role="dialog"
    aria-modal="true"
>
    {{-- Backdrop --}}
    <div
        class="absolute inset-0"
        style="background: rgba(4,9,15,.75); backdrop-filter: blur(3px);"
        @click="open = false"
    ></div>

    {{-- Panel --}}
    <div
        class="relative w-full max-w-lg mx-4 rounded-2xl overflow-hidden shadow-2xl"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95 translate-y-4"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 translate-y-4"
        style="background: #fff;"
    >
        {{-- Gold accent top bar --}}
        <div class="h-1.5 w-full" style="background: linear-gradient(90deg, var(--gold2), var(--gold3), var(--gold));"></div>

        {{-- Header --}}
        <div class="flex items-start justify-between gap-4 px-6 pt-5 pb-4"
             style="background: var(--navy); border-bottom: 1px solid rgba(200,169,81,.2);">
            <div class="flex items-center gap-3 min-w-0">
                {{-- Megaphone icon --}}
                <div class="w-9 h-9 rounded-full flex items-center justify-center shrink-0"
                     style="background: rgba(200,169,81,.15); border: 1px solid rgba(200,169,81,.3);">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         style="color: var(--gold);">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                    </svg>
                </div>

                <div class="min-w-0">
                    <div class="flex items-center gap-2 flex-wrap">
                        <p class="text-xs font-bold tracking-widest uppercase" style="color: var(--gold);">Announcement</p>
                        @if ($popupAnnouncement->is_pinned)
                            <span class="text-xs px-1.5 py-0.5 rounded font-semibold"
                                  style="background: rgba(200,169,81,.2); color: var(--gold3); border: 1px solid rgba(200,169,81,.3);">
                                📌 Pinned
                            </span>
                        @endif
                    </div>
                    <p class="text-white font-black text-sm leading-snug truncate mt-0.5">
                        {{ $popupAnnouncement->title }}
                    </p>
                </div>
            </div>

            {{-- Close button --}}
            <button @click="open = false"
                    class="shrink-0 w-7 h-7 rounded-full flex items-center justify-center transition-colors"
                    style="background: rgba(255,255,255,.06); color: #94a3b8;"
                    onmouseover="this.style.background='rgba(255,255,255,.12)'"
                    onmouseout="this.style.background='rgba(255,255,255,.06)'"
                    aria-label="Dismiss">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Body --}}
        <div class="px-6 py-5">
            <p class="text-sm text-slate-700 leading-relaxed whitespace-pre-line">{{ $popupAnnouncement->content }}</p>

            {{-- Meta row --}}
            <div class="flex items-center justify-between mt-5 pt-4" style="border-top: 1px solid #f1f5f9;">
                <div class="flex items-center gap-1.5 text-xs text-slate-400">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    {{ $popupAnnouncement->published_at
                        ? $popupAnnouncement->published_at->format('d M Y')
                        : $popupAnnouncement->created_at->format('d M Y') }}
                </div>

                <div class="flex items-center gap-2.5">
                    <a href="{{ route('cadet.announcements') }}"
                       @click="open = false"
                       class="text-xs font-semibold transition-colors"
                       style="color: var(--gold2);"
                       onmouseover="this.style.color='var(--gold)'"
                       onmouseout="this.style.color='var(--gold2)'">
                        View all →
                    </a>
                    <button @click="open = false"
                            class="text-xs font-semibold px-4 py-1.5 rounded-lg transition-colors"
                            style="background: var(--navy); color: var(--gold);"
                            onmouseover="this.style.background='var(--navy2)'"
                            onmouseout="this.style.background='var(--navy)'">
                        Got it
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>
@endif
