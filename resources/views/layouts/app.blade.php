<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', config('app.name', 'CCJE ROTC')) — 133rd NROTC Portal</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased" style="background: var(--navy); color: #1e293b;">
        @include('partials.page-loader')

        <div class="flex min-h-screen">

            {{-- ── Sidebar ──────────────────────────────────────────────────── --}}
            <aside class="app-sidebar flex flex-col w-60 shrink-0">
                <div class="flex flex-col flex-1 py-6 px-4">

                    {{-- Brand --}}
                    <div class="flex items-center gap-3 px-2 mb-8">
                        <img src="{{ asset('133rd NROTC_logo.jpg') }}" alt="133rd NROTC Logo" class="w-10 h-10 rounded-full shrink-0 object-cover"
                             style="box-shadow: 0 0 12px rgba(200,169,81,.4);">
                        <div>
                            <p class="font-black text-sm tracking-widest uppercase" style="color: var(--gold);">133rd NROTC</p>
                            <p class="text-xs text-slate-500 leading-none tracking-wide">CSU — Aparri</p>
                        </div>
                    </div>

                    {{-- Role-specific nav --}}
                    <nav class="flex flex-col gap-1 flex-1">
                        @yield('sidebar-nav')
                    </nav>

                    {{-- User identity chip --}}
                    <div class="px-3 py-2.5 rounded-xl mb-3"
                         style="background: rgba(200,169,81,.05); border: 1px solid rgba(200,169,81,.1);">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center font-black text-xs shrink-0"
                                 style="background: linear-gradient(135deg, var(--gold3), var(--gold)); color: var(--navy);">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-semibold text-white truncate">{{ Auth::user()->name }}</p>
                                <p class="uppercase tracking-widest font-bold" style="color: var(--gold); font-size: .6rem;">
                                    {{ Auth::user()->role }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Logout --}}
                    <div class="pt-3" style="border-top: 1px solid rgba(255,255,255,.06);">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="sidebar-link w-full text-left">
                                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                Log Out
                            </button>
                        </form>
                    </div>

                </div>
            </aside>

            {{-- ── Main wrapper ─────────────────────────────────────────────── --}}
            <div class="flex flex-col flex-1 min-w-0" style="background: #f8fafc;">

                {{-- Top bar --}}
                <header class="app-topbar flex items-center justify-between px-8 py-4 shrink-0">
                    <h1 class="text-xs font-bold tracking-widest uppercase" style="color: #1e293b;">
                        @yield('page-title')
                    </h1>
                    <div class="flex items-center gap-3">
                        <span class="text-xs text-slate-500">{{ Auth::user()->name }}</span>
                        <div class="w-8 h-8 rounded-full flex items-center justify-center font-black text-xs shrink-0"
                             style="background: linear-gradient(135deg, var(--gold3), var(--gold)); color: var(--navy);">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    </div>
                </header>

                {{-- Flash messages --}}
                @if (session('success'))
                    <div class="mx-8 mt-5 px-4 py-3 rounded-xl text-sm font-medium"
                         style="background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534;">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="mx-8 mt-5 px-4 py-3 rounded-xl text-sm font-medium"
                         style="background: #fef2f2; border: 1px solid #fecaca; color: #991b1b;">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Page content --}}
                <main class="flex-1 p-8 overflow-auto">
                    @yield('content')
                </main>

            </div>
        </div>
        {{-- Announcement popup modal (cadets only) --}}
        @if (Auth::check() && Auth::user()->isCadet())
            @include('cadet.partials.announcement-modal')
        @endif

        @stack('scripts')
    </body>
</html>
