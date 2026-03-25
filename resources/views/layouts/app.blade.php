<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', config('app.name', 'CCJE ROTC'))</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased" style="background: #061020; color: #fff;">
        <div class="flex min-h-screen">

            {{-- ── Sidebar ──────────────────────────────────────────────────── --}}
            <aside class="flex flex-col w-60 shrink-0"
                   style="background: rgba(255,255,255,0.03); border-right: 1px solid rgba(255,255,255,0.07);">
                <div class="flex flex-col flex-1 py-6 px-4">

                    {{-- Brand --}}
                    <div class="flex items-center gap-3 px-2 mb-8">
                        <img src="{{ asset('CCJE.png') }}" alt="CCJE ROTC Logo" class="h-10 w-auto shrink-0">
                        <div>
                            <p class="text-sm font-bold tracking-widest uppercase" style="color: #c8a951;">CCJE ROTC</p>
                            <p class="text-xs text-slate-500 leading-none">CSU — Aparri</p>
                        </div>
                    </div>

                    {{-- Role-specific nav --}}
                    <nav class="flex flex-col gap-1 flex-1">
                        @yield('sidebar-nav')
                    </nav>

                    {{-- Logout --}}
                    <div class="pt-4" style="border-top: 1px solid rgba(255,255,255,0.07);">
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
            <div class="flex flex-col flex-1 min-w-0">

                {{-- Top bar --}}
                <header class="flex items-center justify-between px-8 py-4 shrink-0"
                        style="background: rgba(255,255,255,0.02); border-bottom: 1px solid rgba(255,255,255,0.07);">
                    <h1 class="text-base font-semibold tracking-wide text-white">@yield('page-title')</h1>
                    <div class="flex items-center gap-3">
                        <span class="text-sm text-slate-400">{{ Auth::user()->name }}</span>
                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold shrink-0"
                             style="background: linear-gradient(135deg, #c8a951 0%, #a08030 100%); color: #061020;">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    </div>
                </header>

                {{-- Page content --}}
                <main class="flex-1 p-8 overflow-auto">
                    @yield('content')
                </main>

            </div>
        </div>
    </body>
</html>
