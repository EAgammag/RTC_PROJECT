<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', config('app.name', 'CCJE ROTC'))</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Rajdhani:wght@400;500;600;700&family=Share+Tech+Mono&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            html, body { min-height: 100vh; }
            body { font-family: 'Rajdhani', sans-serif; }
            .app-sidebar {
                background: rgba(4,9,15,.97);
                border-right: 1px solid rgba(200,169,81,.12);
                box-shadow: 2px 0 24px rgba(0,0,0,.4);
            }
            .app-topbar {
                background: rgba(4,9,15,.96);
                border-bottom: 1px solid rgba(200,169,81,.12);
                box-shadow: 0 1px 24px rgba(0,0,0,.4);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="flex min-h-screen">

            {{-- ── Sidebar ──────────────────────────────────────────────────── --}}
            <aside class="app-sidebar flex flex-col w-60 shrink-0">
                <div class="flex flex-col flex-1 py-6 px-4">

                    {{-- Brand --}}
                    <div class="flex items-center gap-3 px-2 mb-8">
                        <img src="{{ asset('CCJE.png') }}" alt="CCJE ROTC Logo" class="h-10 w-auto shrink-0">
                        <div>
                            <p style="color: #c8a951; font-family: 'Bebas Neue', sans-serif; font-size: 1.05rem; letter-spacing: .14em;">NROTC</p>
                            <p class="text-xs text-slate-500 leading-none" style="font-family: 'Share Tech Mono', monospace; letter-spacing: .1em;">CSU — Aparri</p>
                        </div>
                    </div>

                    {{-- Role-specific nav --}}
                    <nav class="flex flex-col gap-1 flex-1">
                        @yield('sidebar-nav')
                    </nav>

                    {{-- Logout --}}
                    <div class="pt-4" style="border-top: 1px solid rgba(200,169,81,.1);">
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
                <header class="app-topbar flex items-center justify-between px-8 py-4 shrink-0">
                    <h1 style="color: #c8a951; font-family: 'Bebas Neue', sans-serif; font-size: 1.05rem; letter-spacing: .18em;">
                        @yield('page-title')
                    </h1>
                    <div class="flex items-center gap-3">
                        <span class="text-sm text-slate-600" style="font-family: 'Rajdhani', sans-serif;">{{ Auth::user()->name }}</span>
                        <div class="w-9 h-9 rounded-full flex items-center justify-center font-bold shrink-0"
                             style="background: linear-gradient(135deg, #c8a951 0%, #a08030 100%); color: #04090f; font-family: 'Bebas Neue', sans-serif; font-size: 1rem; letter-spacing: .04em;">
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
