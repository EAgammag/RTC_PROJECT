<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'NROTC') – CSU Aparri NROTC</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            navy:  { DEFAULT: '#0a1628', 700: '#0d1f3c', 800: '#061020', 900: '#030d18' },
                            gold:  { DEFAULT: '#c8a951', light: '#e6cb78', dark: '#a08030' },
                        }
                    }
                }
            }
        </script>
    @endif

    <style>
        :root {
            --navy: #0a1628;
            --navy-700: #0d1f3c;
            --gold: #c8a951;
            --gold-light: #e6cb78;
        }
        body { background-color: var(--navy); color: #e2e8f0; font-family: 'Inter', sans-serif; }
        .sidebar-link { @apply flex items-center gap-3 px-4 py-3 rounded-lg text-slate-300 hover:bg-white/10 hover:text-white transition-colors; }
        .sidebar-link.active { @apply bg-white/15 text-white font-semibold; }
        .card { background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.1); }
        .stat-card { background: linear-gradient(135deg, rgba(255,255,255,0.06) 0%, rgba(255,255,255,0.02) 100%); border: 1px solid rgba(200,169,81,0.25); }
        .gold-accent { color: var(--gold); }
    </style>
</head>
<body class="min-h-screen flex">

    {{-- ── Sidebar ────────────────────────────────────────────────────────── --}}
    <aside class="w-64 flex-shrink-0 flex flex-col"
           style="background: linear-gradient(180deg, #061020 0%, #0a1628 100%); border-right: 1px solid rgba(200,169,81,0.2);">

        {{-- Logo / Branding --}}
        <div class="px-6 py-6 border-b" style="border-color: rgba(200,169,81,0.2);">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0"
                     style="background: var(--gold); color: #061020;">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L3 7l9 5 9-5-9-5zM3 17l9 5 9-5M3 12l9 5 9-5"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold tracking-widest uppercase" style="color: var(--gold);">NROTC</p>
                    <p class="text-white text-sm font-semibold leading-tight">CSU Aparri</p>
                </div>
            </div>
        </div>

        {{-- Role Badge --}}
        <div class="px-6 py-4 border-b" style="border-color: rgba(255,255,255,0.06);">
            <p class="text-xs text-slate-400 uppercase tracking-wider mb-1">Logged in as</p>
            <p class="text-white font-semibold text-sm">{{ Auth::user()->name }}</p>
            <span class="inline-block mt-1 text-xs px-2 py-0.5 rounded-full font-semibold uppercase tracking-wider"
                  style="background: rgba(200,169,81,0.2); color: var(--gold); border: 1px solid rgba(200,169,81,0.4);">
                {{ ucfirst(Auth::user()->role) }}
            </span>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-3 py-4 space-y-1">
            @yield('sidebar-nav')
        </nav>

        {{-- Logout --}}
        <div class="px-3 py-4 border-t" style="border-color: rgba(255,255,255,0.06);">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="sidebar-link w-full text-left text-red-400 hover:text-red-300 hover:bg-red-900/20">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Secure Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- ── Main content ────────────────────────────────────────────────────── --}}
    <div class="flex-1 flex flex-col min-w-0">

        {{-- Top bar --}}
        <header class="flex items-center justify-between px-8 py-4 border-b"
                style="background: rgba(255,255,255,0.03); border-color: rgba(255,255,255,0.08);">
            <h1 class="text-xl font-bold text-white">@yield('page-title', 'Dashboard')</h1>
            <div class="flex items-center gap-3 text-sm text-slate-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                Secure Session &nbsp;|&nbsp; {{ now()->format('D, d M Y  H:i') }}
            </div>
        </header>

        {{-- Flash messages --}}
        <div class="px-8 pt-4">
            @if (session('success'))
                <div class="mb-4 px-4 py-3 rounded-lg text-sm font-medium"
                     style="background: rgba(34,197,94,0.15); border: 1px solid rgba(34,197,94,0.3); color: #4ade80;">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="mb-4 px-4 py-3 rounded-lg text-sm"
                     style="background: rgba(239,68,68,0.15); border: 1px solid rgba(239,68,68,0.3); color: #f87171;">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        {{-- Page body --}}
        <main class="flex-1 px-8 py-6 overflow-auto">
            @yield('content')
        </main>

        <footer class="px-8 py-3 text-center text-xs text-slate-600 border-t"
                style="border-color: rgba(255,255,255,0.06);">
            CSU Aparri NROTC &copy; {{ date('Y') }} &nbsp;|&nbsp;
            Secure Information Management System &nbsp;|&nbsp;
            Session expires after 30 min of inactivity
        </footer>
    </div>

</body>
</html>
