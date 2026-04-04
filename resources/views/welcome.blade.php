<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CCJE ROTC · CSU Aparri</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body { margin: 0; font-family: 'Inter', sans-serif; }
        .gold { color: #800000; }

        .nav-glass {
            background: #001f3f;
            border-bottom: 1px solid #003366;
            box-shadow: 0 1px 3px rgba(0,0,0,.15);
        }
        .btn-gold {
            display: inline-flex; align-items: center; gap: .5rem;
            padding: .75rem 1.75rem; border-radius: .625rem;
            font-weight: 700; font-size: .8rem;
            letter-spacing: .1em; text-transform: uppercase;
            text-decoration: none;
            background: #800000; color: #ffffff;
            box-shadow: 0 2px 8px rgba(128,0,0,.2);
            transition: transform .15s, box-shadow .15s, background .15s;
        }
        .btn-gold:hover { transform: translateY(-2px); background: #5a0000; box-shadow: 0 4px 16px rgba(128,0,0,.3); }
        .btn-ghost {
            display: inline-flex; align-items: center; gap: .5rem;
            padding: .75rem 1.75rem; border-radius: .625rem;
            font-weight: 700; font-size: .8rem;
            letter-spacing: .1em; text-transform: uppercase;
            text-decoration: none; color: #374151;
            border: 1px solid #d1d5db;
            background: #f9fafb;
            transition: border-color .15s, background .15s, transform .15s;
        }
        .btn-ghost:hover { background: #f3f4f6; border-color: #9ca3af; transform: translateY(-1px); }
        .hero-bg {
            background: #ffffff;
        }
        .dot-grid {
            background-image: radial-gradient(rgba(128,0,0,.04) 1px, transparent 1px);
            background-size: 36px 36px;
        }
        .hero-stat-num {
            font-size: 2.5rem; font-weight: 900;
            line-height: 1; letter-spacing: -.02em;
            color: #800000;
        }
        .badge-restricted {
            display: inline-flex; align-items: center; gap: .4rem;
            padding: .4rem 1.1rem; border-radius: 9999px;
            font-size: .8rem; font-weight: 700; letter-spacing: .08em; text-transform: uppercase;
            background: rgba(239,68,68,.08); color: #b91c1c;
            border: 1px solid rgba(239,68,68,.25);
        }
        .badge-gold {
            display: inline-flex; align-items: center; gap: .4rem;
            padding: .4rem 1.1rem; border-radius: 9999px;
            font-size: .8rem; font-weight: 700; letter-spacing: .08em; text-transform: uppercase;
            background: rgba(128,0,0,.06); color: #800000;
            border: 1px solid rgba(128,0,0,.2);
        }
        .section-eyebrow {
            font-size: .65rem; font-weight: 700; letter-spacing: .18em; text-transform: uppercase;
            color: #800000;
        }
        .glass-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 1rem;
            box-shadow: 0 1px 3px rgba(0,0,0,.05);
            transition: border-color .2s, box-shadow .2s;
        }
        .glass-card:hover { border-color: rgba(128,0,0,.25); box-shadow: 0 4px 16px rgba(0,0,0,.06); }
        .feature-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 1.25rem;
            box-shadow: 0 1px 3px rgba(0,0,0,.05);
            transition: border-color .2s, transform .2s, box-shadow .2s;
        }
        .feature-card:hover { border-color: rgba(128,0,0,.2); transform: translateY(-3px); box-shadow: 0 8px 24px rgba(0,0,0,.06); }
        .role-card {
            border-radius: 1.25rem;
            border: 1px solid #e5e7eb;
            background: #fff;
            box-shadow: 0 1px 3px rgba(0,0,0,.05);
            transition: transform .25s, border-color .25s, box-shadow .25s;
            overflow: hidden;
        }
        .role-card:hover { transform: translateY(-4px); box-shadow: 0 12px 32px rgba(0,0,0,.08); }
        .divider { border: none; height: 1px; background: #e5e7eb; }
        .section-strip {
            background: rgba(128,0,0,.02);
            border-top: 1px solid rgba(128,0,0,.08);
            border-bottom: 1px solid rgba(128,0,0,.08);
        }
        @keyframes float   { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-8px)} }
        @keyframes shimmer { 0%,100%{opacity:.6} 50%{opacity:1} }
        @keyframes rPulse  { 0%,100%{transform:scale(1);opacity:.9} 50%{transform:scale(1.5);opacity:.4} }
        @keyframes glow    { 0%,100%{opacity:.6} 50%{opacity:1} }
        .float-anim   { animation: float   4s ease-in-out infinite; }
        .shimmer-anim { animation: shimmer 2.5s ease-in-out infinite; }
        .r-pulse      { animation: rPulse  2s ease-in-out infinite; }
        .glow-anim    { animation: glow    3s ease-in-out infinite; }
        /* === Scroll Reveal === */
        [data-reveal] {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity .65s cubic-bezier(.4,0,.2,1), transform .65s cubic-bezier(.4,0,.2,1);
        }
        [data-reveal="left"]  { transform: translateX(-32px); }
        [data-reveal="right"] { transform: translateX(32px); }
        [data-reveal="scale"] { transform: scale(.95); }
        [data-reveal].is-visible { opacity: 1; transform: none; }
        [data-reveal][data-delay="1"] { transition-delay: .12s; }
        [data-reveal][data-delay="2"] { transition-delay: .24s; }
        [data-reveal][data-delay="3"] { transition-delay: .36s; }
        [data-reveal][data-delay="4"] { transition-delay: .48s; }
        [data-reveal][data-delay="5"] { transition-delay: .60s; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f5f5f5; }
        ::-webkit-scrollbar-thumb { background: rgba(128,0,0,.3); border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(128,0,0,.5); }
    </style>
</head>
<body class="font-sans antialiased">

    {{-- NAVBAR --}}
    <nav class="nav-glass fixed top-0 inset-x-0 z-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-10 flex items-center justify-between h-16">
            <a href="/" class="flex items-center gap-3 no-underline">
                <img src="{{ asset('CCJE.png') }}" alt="CCJE Logo" class="h-9 w-auto shrink-0">
                <div class="leading-none">
                    <span class="text-base font-black tracking-wider uppercase" style="color: #ffffff;">NROTC</span>
                    <span class="text-sm font-bold tracking-wide text-slate-300"> · CSU Aparri</span>
                    <p class="text-xs text-slate-400 mt-0.5 hidden lg:block">Secure Information System</p>
                </div>
            </a>
            <div class="flex items-center gap-2 text-right leading-none">
                <div class="leading-tight">
                    <div class="text-sm font-semibold" style="color:#ffffff;" id="rtc-time">--:--:-- --</div>
                    <div class="text-xs text-slate-400" id="rtc-date">---, --- --, ----</div>
                    <div class="text-slate-400 tracking-widest uppercase" style="font-size:0.7rem;">Philippine Standard Time</div>
                </div>
            </div>
        </div>
    </nav>

    {{-- HERO --}}
    <section class="hero-bg dot-grid relative min-h-screen flex flex-col justify-center pt-20 pb-14 px-6 overflow-hidden">
        {{-- Atmospheric light blobs --}}
        <div class="absolute top-1/4 -left-40 w-[520px] h-[520px] rounded-full blur-3xl pointer-events-none opacity-30"
             style="background: radial-gradient(circle, rgba(128,0,0,.1) 0%, transparent 70%);"></div>
        <div class="absolute bottom-1/4 -right-20 w-80 h-80 rounded-full blur-3xl pointer-events-none opacity-20"
             style="background: radial-gradient(circle, rgba(30,64,175,.1) 0%, transparent 70%);"></div>
        <div class="absolute -top-40 right-0 w-[760px] h-[560px] rounded-full blur-3xl pointer-events-none"
             style="background: radial-gradient(ellipse, rgba(128,0,0,.04) 0%, transparent 65%); opacity:.5;"></div>
        {{-- Scales of Justice watermark --}}
        <div class="absolute top-0 right-0 pointer-events-none select-none hidden lg:block"
             style="opacity: 0.03; transform: translate(16%, -6%); width: 560px; height: 560px;">
            <svg viewBox="0 0 200 220" fill="none" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
                <rect x="90" y="207" width="20" height="8" rx="2" fill="#800000"/>
                <line x1="100" y1="20" x2="100" y2="209" stroke="#800000" stroke-width="3"/>
                <circle cx="100" cy="15" r="7" fill="none" stroke="#800000" stroke-width="2.5"/>
                <path d="M22 55 Q100 43 178 55" stroke="#800000" stroke-width="3.5" fill="none" stroke-linecap="round"/>
                <line x1="32" y1="55" x2="32" y2="112" stroke="#800000" stroke-width="2"/>
                <line x1="168" y1="55" x2="168" y2="112" stroke="#800000" stroke-width="2"/>
                <circle cx="32" cy="66" r="2.5" fill="#800000"/>
                <circle cx="32" cy="78" r="2.5" fill="#800000"/>
                <circle cx="32" cy="90" r="2.5" fill="#800000"/>
                <circle cx="32" cy="102" r="2.5" fill="#800000"/>
                <circle cx="168" cy="66" r="2.5" fill="#800000"/>
                <circle cx="168" cy="78" r="2.5" fill="#800000"/>
                <circle cx="168" cy="90" r="2.5" fill="#800000"/>
                <circle cx="168" cy="102" r="2.5" fill="#800000"/>
                <path d="M10 112 Q32 134 54 112" stroke="#800000" stroke-width="3" fill="none" stroke-linecap="round"/>
                <path d="M146 112 Q168 134 190 112" stroke="#800000" stroke-width="3" fill="none" stroke-linecap="round"/>
            </svg>
        </div>
        {{-- CCJE monogram background watermark --}}
        <div class="absolute bottom-20 left-0 pointer-events-none select-none hidden xl:block"
             style="opacity: 0.02; transform: translateX(-8%);"
        >
            <svg viewBox="0 0 320 100" fill="none" xmlns="http://www.w3.org/2000/svg" width="360">
                <text x="8" y="88" font-family="Georgia, serif" font-size="96" font-weight="bold"
                      fill="#800000" letter-spacing="-4">CCJE</text>
            </svg>
        </div>
        <div class="relative max-w-6xl mx-auto w-full">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="rounded-2xl p-8 lg:p-10"
                     style="background: #ffffff;
                            border: 1px solid #e5e7eb;
                            box-shadow: 0 4px 24px rgba(0,0,0,.06);">
                    <div class="flex items-center gap-3 mb-7">
                        <span class="badge-restricted">
                            <span class="w-1.5 h-1.5 rounded-full bg-red-400 r-pulse"></span>
                            Restricted Access
                        </span>
                        <span class="badge-gold">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            CCJE ROTC Unit
                        </span>
                    </div>
                    <h1 class="text-5xl lg:text-6xl xl:text-7xl font-black leading-[1.05] tracking-tight mb-6">
                        <span class="text-slate-900">NROTC</span><br>
                        <span style="color: #800000;">Secure</span>
                        <span class="text-slate-900"> Portal</span>
                    </h1>
                    <p class="text-slate-800 text-base lg:text-lg leading-relaxed mb-3 max-w-lg font-semibold">
                        The official digital operations system for the Reserve Officers&apos; Training Corps,
                        Cagayan State University &mdash; Aparri.
                    </p>
                    <p class="text-slate-700 text-base leading-relaxed max-w-md mb-10">
                        Access is restricted to verified personnel. All sessions are monitored and
                        unauthorized access is subject to disciplinary action.
                    </p>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-gold">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            Go to My Dashboard
                        </a>
                    @else
                        <div class="flex flex-col sm:flex-row gap-3 w-full">
                            <a href="{{ route('login') }}" class="btn-gold flex-1 justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2"
                                          d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                                </svg>
                                Authorized Sign In
                            </a>
                            <a href="#access-tiers" class="btn-ghost flex-1 justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                                View Access Tiers
                            </a>
                        </div>
                    @endauth
                </div>
                <div class="flex flex-col gap-5 lg:pl-8">
                    <div class="flex justify-center mb-2">
                        <div class="relative float-anim">
                            <div class="w-32 h-32 rounded-3xl flex items-center justify-center"
                                 style="background: rgba(128,0,0,.06);
                                        border: 1px solid rgba(128,0,0,.15);
                                        box-shadow: 0 4px 24px rgba(128,0,0,.08);">
                                <svg class="w-16 h-16 gold shimmer-anim" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-3">
                        @foreach ([
                            ['num' => '3',    'label' => 'Access Roles',    'num_color' => '#800000', 'bg' => '#ffffff',   'border' => 'rgba(128,0,0,.15)',   'top' => '#800000'],
                            ['num' => '6',    'label' => 'Security Layers', 'num_color' => '#1d4ed8', 'bg' => '#ffffff',   'border' => 'rgba(96,165,250,.2)',   'top' => '#60a5fa'],
                            ['num' => '100%', 'label' => 'Encrypted',       'num_color' => '#047857', 'bg' => '#ffffff',   'border' => 'rgba(52,211,153,.2)',   'top' => '#34d399'],
                        ] as $stat)
                            <div class="p-4 text-center rounded-2xl transition-all duration-200"
                                 style="background: {{ $stat['bg'] }}; border: 1px solid {{ $stat['border'] }}; box-shadow: 0 1px 3px rgba(0,0,0,.05);">
                                <div class="text-2xl font-black leading-none tracking-tight mb-1"
                                     style="color: {{ $stat['num_color'] }};">{{ $stat['num'] }}</div>
                                <p class="text-xs font-semibold leading-tight" style="color: {{ $stat['num_color'] }};">{{ $stat['label'] }}</p>
                            </div>
                        @endforeach
                    </div>
                    <div class="p-4 flex items-center gap-4 rounded-xl"
                         style="background: #ffffff; border: 1px solid rgba(52,211,153,.2); box-shadow: 0 1px 3px rgba(0,0,0,.05);">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0"
                             style="background: rgba(52,211,153,.08); border: 1px solid rgba(52,211,153,.2);">
                            <svg class="w-5 h-5" fill="none" stroke="#047857" viewBox="0 0 24 24" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7"/>
                            </svg>
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500" style="box-shadow: 0 0 6px #047857;"></span>
                                <p class="text-sm font-semibold text-emerald-700">All Systems Operational</p>
                            </div>
                            <p class="text-sm text-slate-500 mt-0.5">Authentication &middot; Records &middot; Session Control</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 opacity-50 z-10">
            <p class="text-xs text-slate-400 tracking-widest uppercase">Scroll</p>
            <div class="w-px h-8 bg-gradient-to-b from-slate-400 to-transparent"></div>
        </div>
        {{-- Fade-out to light sections --}}
        <div class="absolute bottom-0 left-0 right-0 h-28 pointer-events-none z-0"
             style="background: linear-gradient(to bottom, transparent 0%, #ffffff 100%);"></div>
    </section>

    {{-- OBJECTIVE STRIP --}}
    <section class="section-strip">
        <div class="max-w-6xl mx-auto px-6 py-8 grid grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ([
                ['icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z', 'label' => 'Cadet Records', 'desc' => 'Enrollment & personal information'],
                ['icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01', 'label' => 'Attendance Logs', 'desc' => 'Drill & formation tracking'],
                ['icon' => 'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z', 'label' => 'Merit & Demerit', 'desc' => 'Tamper-proof conduct ratings'],
                ['icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'label' => 'Communications', 'desc' => 'Orders & unit announcements'],
            ] as $item)
                <div class="flex items-start gap-3.5" data-reveal data-delay="{{ $loop->index }}">
                    <div class="w-9 h-9 rounded-lg flex items-center justify-center shrink-0"
                         style="background: rgba(128,0,0,.06); border: 1px solid rgba(128,0,0,.1);">
                        <svg class="w-4 h-4 gold" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-800 mb-0.5">{{ $item['label'] }}</p>
                        <p class="text-sm text-slate-600">{{ $item['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ABOUT / SYSTEM PURPOSE --}}
    <section class="max-w-6xl mx-auto px-6 lg:px-10 py-20">
        <div class="grid lg:grid-cols-2 gap-14 items-center">
            <div data-reveal="left">
                <p class="section-eyebrow mb-4">System Objective</p>
                <h2 class="text-3xl lg:text-4xl font-black leading-[1.15] tracking-tight mb-6">
                    A Hardened Digital Layer<br>Around <span class="gold">NROTC Data</span>
                </h2>
                <p class="text-slate-700 text-base leading-relaxed mb-4">
                    This platform replaces paper-based ROTC record-keeping with a secure, role-aware digital system
                    &mdash; enforcing strict chain-of-identity before any military or academic data is accessed or modified.
                </p>
                <p class="text-slate-700 text-base leading-relaxed mb-6">
                    Every session is authenticated, scoped to the minimum privilege required, and automatically
                    invalidated after 30 minutes of inactivity &mdash; keeping sensitive records out of unauthorized hands.
                </p>
                <div class="flex flex-col gap-3.5">
                    @foreach ([
                        'Strict identity verification before any data access',
                        'Role-gated views &mdash; each user sees only their scope',
                        'Sessions expire after 30 minutes of inactivity',
                        'Accounts lock after 5 consecutive failed login attempts',
                        'Deactivated accounts are evicted from active sessions instantly',
                    ] as $point)
                        <div class="flex items-center gap-3 text-sm font-medium text-slate-800">
                            <div class="w-5 h-5 rounded-full flex items-center justify-center shrink-0"
                                 style="background: rgba(128,0,0,.06);">
                                <svg class="w-3 h-3 gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            {!! $point !!}
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="flex flex-col gap-3" data-reveal="right">
                <p class="section-eyebrow mb-2">Threat Response Matrix</p>
                @foreach ([
                    ['threat' => 'Unauthorized external access',  'response' => 'Blocked at authentication layer',  'icon' => 'M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636', 'color' => '#b91c1c', 'bg' => 'rgba(239,68,68,.07)',      'border' => 'rgba(239,68,68,.15)'],
                    ['threat' => 'Internal privilege escalation',  'response' => 'Contained by role middleware',      'icon' => 'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z', 'color' => '#92400e', 'bg' => 'rgba(251,191,36,.07)',   'border' => 'rgba(251,191,36,.15)'],
                    ['threat' => 'Brute-force credential attacks', 'response' => 'Stopped by account lockout policy', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'color' => '#065f46', 'bg' => 'rgba(52,211,153,.07)',   'border' => 'rgba(52,211,153,.15)'],
                    ['threat' => 'Session fixation / hijacking',   'response' => 'Prevented by ID regeneration',     'icon' => 'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15', 'color' => '#1e40af', 'bg' => 'rgba(96,165,250,.07)',   'border' => 'rgba(96,165,250,.15)'],
                ] as $row)
                    <div class="flex items-center gap-4 rounded-xl p-4"
                         style="background: {{ $row['bg'] }}; border: 1px solid {{ $row['border'] }};">
                        <div class="w-9 h-9 rounded-lg flex items-center justify-center shrink-0"
                             style="background: rgba(4,9,15,.04);">
                            <svg class="w-5 h-5" fill="none" stroke="{{ $row['color'] }}" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $row['icon'] }}"/>
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-sm text-slate-700 truncate mb-0.5">&#8618; {{ $row['threat'] }}</p>
                            <p class="text-sm font-semibold" style="color: {{ $row['color'] }};">{{ $row['response'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <hr class="divider max-w-6xl mx-auto">

    {{-- ACCESS TIERS --}}
    <section id="access-tiers" class="max-w-6xl mx-auto px-6 lg:px-10 py-20">
        <div class="text-center mb-12" data-reveal>
            <p class="section-eyebrow mb-3">Role-Based Access Control</p>
            <h2 class="text-3xl lg:text-4xl font-black tracking-tight">
                Three Tiers of <span class="gold">Authorized Access</span>
            </h2>
            <p class="text-slate-700 mt-4 max-w-md mx-auto text-base leading-relaxed">
                Every account is bound to exactly one role. Access to data, features, and actions
                is strictly limited to the scope defined for that role.
            </p>
        </div>
        <div class="grid md:grid-cols-3 gap-5">
            @foreach ([
                [
                    'role'   => 'Administrator',
                    'badge'  => 'System Admin',
                    'scope'  => 'Full system control',
                    'desc'   => 'Complete access over all system resources, user accounts, and unit data.',
                    'color'  => '#800000',
                    'bg'     => 'rgba(128,0,0,.04)',
                    'top'    => 'rgba(128,0,0,.08)',
                    'border' => 'rgba(128,0,0,.12)',
                    'icon'   => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z',
                    'perms'  => ['Create and manage all user accounts', 'Unlock or deactivate accounts', 'View unit-wide statistics and logs', 'Manage officer and cadet rosters'],
                ],
                [
                    'role'   => 'Officer',
                    'badge'  => 'Tactical Officer',
                    'scope'  => 'Unit oversight',
                    'desc'   => 'Operational access over cadet management, attendance, and unit communications.',
                    'color'  => '#1d4ed8',
                    'bg'     => 'rgba(96,165,250,.06)',
                    'top'    => 'rgba(96,165,250,.12)',
                    'border' => 'rgba(96,165,250,.15)',
                    'icon'   => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
                    'perms'  => ['View full active cadet roster', 'Monitor attendance and formation records', 'Issue merit and demerit evaluations', 'Publish official unit communications'],
                ],
                [
                    'role'   => 'Cadet',
                    'badge'  => 'Enrolled Cadet',
                    'scope'  => 'Personal records only',
                    'desc'   => 'Read-only access limited to personal data, attendance history, and announcements.',
                    'color'  => '#047857',
                    'bg'     => 'rgba(52,211,153,.06)',
                    'top'    => 'rgba(52,211,153,.12)',
                    'border' => 'rgba(52,211,153,.15)',
                    'icon'   => 'M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                    'perms'  => ['View own profile and enrollment data', 'Check personal attendance history', 'Review own merit and demerit standing', 'Read unit-wide announcements'],
                ],
            ] as $tier)
                <div class="role-card flex flex-col" style="background: {{ $tier['bg'] }}; border-color: {{ $tier['border'] }};"
                     data-reveal data-delay="{{ $loop->index }}">
                    <div class="h-1.5 w-full" style="background: linear-gradient(90deg, {{ $tier['color'] }}, transparent);"></div>
                    <div class="p-7 flex flex-col gap-5 grow">
                        <div>
                            <span class="inline-block text-xs font-black uppercase tracking-widest px-3 py-1 rounded-full mb-4"
                                  style="background:{{ $tier['top'] }}; color:{{ $tier['color'] }}; border:1px solid {{ $tier['border'] }};">
                                {{ $tier['badge'] }}
                            </span>
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0"
                                     style="background:{{ $tier['top'] }}; border:1px solid {{ $tier['border'] }};">
                                    <svg class="w-5 h-5" fill="none" stroke="{{ $tier['color'] }}" stroke-width="1.8" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $tier['icon'] }}"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-black text-slate-900">{{ $tier['role'] }}</h3>
                                    <p class="text-xs" style="color:{{ $tier['color'] }}; opacity:.8;">{{ $tier['scope'] }}</p>
                                </div>
                            </div>
                            <p class="text-sm text-slate-700 leading-relaxed">{{ $tier['desc'] }}</p>
                        </div>
                        <ul class="flex flex-col gap-2.5 mt-auto">
                            @foreach ($tier['perms'] as $perm)
                                <li class="flex items-start gap-2.5 text-sm text-slate-700">
                                    <svg class="w-3.5 h-3.5 mt-0.5 shrink-0" fill="none" stroke="{{ $tier['color'] }}" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    {{ $perm }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
        <p class="text-center text-sm text-slate-600 mt-8">
            Accounts are issued exclusively by system administrators. Self-registration is disabled.
        </p>
    </section>

    <hr class="divider max-w-6xl mx-auto">

    {{-- SECURITY CONTROLS --}}
    <section class="max-w-6xl mx-auto px-6 lg:px-10 py-20">
        <div class="text-center mb-12" data-reveal>
            <p class="section-eyebrow mb-3">Security Architecture</p>
            <h2 class="text-3xl lg:text-4xl font-black tracking-tight">
                Hardened Against <span class="gold">Every Threat Layer</span>
            </h2>
            <p class="text-slate-700 mt-4 max-w-md mx-auto text-base leading-relaxed">
                Built around OWASP security principles to protect sensitive military and academic
                records from misuse, breach, or exploitation.
            </p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ([
                ['title' => 'Brute-Force Lockout',         'desc' => 'Accounts lock for 15 minutes after 5 failed login attempts, stopping credential-stuffing and dictionary attacks cold.',                'icon' => 'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z', 'color' => '#800000'],
                ['title' => 'Session Timeout',             'desc' => '30-minute inactivity timeout automatically invalidates sessions, preventing reuse of unattended workstations.',                        'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'color' => '#1d4ed8'],
                ['title' => 'Session Fixation Prevention', 'desc' => 'A fresh session ID is issued on every successful login, eliminating session fixation vulnerabilities entirely.',                       'icon' => 'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15', 'color' => '#047857'],
                ['title' => 'Role-Based Access Control',   'desc' => 'Every route and view is gated by EnsureRole middleware, enforcing least privilege &mdash; users can only reach what their role permits.', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'color' => '#be185d'],
                ['title' => 'Password Hardening',          'desc' => 'Minimum 12-character passwords required with mixed case, numbers, and symbols. Stored as bcrypt hashes &mdash; never in plaintext.',   'icon' => 'M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z', 'color' => '#92400e'],
                ['title' => 'Instant Account Eviction',    'desc' => 'Deactivated accounts are immediately evicted from any active session on the next request &mdash; no grace period.',                   'icon' => 'M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636', 'color' => '#b91c1c'],
            ] as $ctrl)
                <div class="feature-card p-6" data-reveal data-delay="{{ $loop->index % 3 }}">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-9 h-9 rounded-lg flex items-center justify-center shrink-0"
                             style="background: rgba(4,9,15,.04); border: 1px solid rgba(4,9,15,.08);">
                            <svg class="w-5 h-5" fill="none" stroke="{{ $ctrl['color'] }}" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $ctrl['icon'] }}"/>
                            </svg>
                        </div>
                        <h4 class="text-base font-bold text-slate-900">{{ $ctrl['title'] }}</h4>
                    </div>
                    <p class="text-sm text-slate-700 leading-relaxed">{!! $ctrl['desc'] !!}</p>
                    <div class="mt-5 h-0.5 w-8 rounded-full opacity-50" style="background: {{ $ctrl['color'] }};"></div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- CTA --}}
    @guest
    <section class="px-6 py-6 mb-5">
        <div class="max-w-5xl mx-auto rounded-3xl p-10 lg:p-14 overflow-hidden relative text-center"
             data-reveal
             style="background: rgba(128,0,0,.03);
                    border: 1px solid rgba(128,0,0,.1);
                    box-shadow: 0 2px 16px rgba(128,0,0,.04);">
            <div class="absolute -top-20 left-1/2 -translate-x-1/2 w-80 h-80 rounded-full blur-3xl pointer-events-none"
                 style="background: radial-gradient(circle, rgba(128,0,0,.04) 0%, transparent 70%);"></div>
            <div class="relative">
                <span class="badge-gold inline-flex mb-6">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                    </svg>
                    Credentials Required
                </span>
                <h2 class="text-3xl lg:text-4xl font-black tracking-tight mb-4">
                    Authorized <span class="gold">Personnel</span> Only
                </h2>
                <p class="text-slate-700 text-base mb-6 leading-relaxed max-w-md mx-auto">
                    If you have been issued credentials by a system administrator,
                    use them to access your assigned portal.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('login') }}" class="btn-gold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2"
                                  d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        Sign In to the System
                    </a>
                    <a href="{{ route('password.request') }}" class="btn-ghost">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                        </svg>
                        Reset Password
                    </a>
                </div>
                <p class="text-sm text-slate-600 mt-7">
                    No credentials? Contact your unit administrator. Self-registration is not available.
                </p>
            </div>
        </div>
    </section>
    @endguest

    {{-- FOOTER --}}
    <footer style="background: #001f3f;
                   border-top: 1px solid #003366;">
        <div class="max-w-6xl mx-auto px-6 lg:px-10 py-10" data-reveal>
            <div class="grid md:grid-cols-3 gap-8 mb-8">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <img src="{{ asset('csulogo.png') }}" alt="CSU Logo" class="h-8 w-auto shrink-0">
                        <img src="{{ asset('CCJE.png') }}" alt="CCJE Logo" class="h-8 w-auto shrink-0">
                        <span class="text-sm font-black tracking-wider uppercase" style="color: #ffffff;">NROTC &middot; CSU Aparri</span>
                    </div>
                    <p class="text-sm text-slate-400 leading-relaxed">
                        College of Criminal Justice Education<br>
                        Cagayan State University &mdash; Aparri Campus<br>
                        Reserve Officers&apos; Training Corps
                    </p>
                </div>
                <div>
                    <p class="text-sm font-semibold uppercase tracking-widest mb-4" style="color: #ffffff;">Portal Access</p>
                    <div class="flex flex-col gap-2.5">
                        <a href="{{ route('login') }}" class="text-sm text-slate-400 hover:text-white transition-colors">Authorized Sign In</a>
                        <a href="{{ route('password.request') }}" class="text-sm text-slate-400 hover:text-white transition-colors">Password Reset</a>
                    </div>
                </div>
                <div>
                    <p class="text-sm font-semibold uppercase tracking-widest mb-4" style="color: #ffffff;">System Policy</p>
                    <p class="text-sm text-slate-400 leading-relaxed">
                        Unauthorized access to this system is strictly prohibited.
                        All sessions are subject to monitoring and logging.
                        Violations will be reported to the unit commander.
                    </p>
                </div>
            </div>
            <hr style="border: none; height: 1px; background: #003366; margin-bottom: 1.5rem;">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
                <p class="text-sm text-slate-500">
                    &copy; {{ date('Y') }} CCrJE ROTC &mdash; Cagayan State University Aparri. All rights reserved.
                </p>
                <p class="text-sm font-semibold tracking-wider" style="color: #ffffff;">
                    Integrity &bull; Discipline &bull; Service
                </p>
            </div>
        </div>
    </footer>

<script>
(function () {
    var revealEls = document.querySelectorAll('[data-reveal]');
    if ('IntersectionObserver' in window) {
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    io.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
        revealEls.forEach(function (el) { io.observe(el); });
    } else {
        revealEls.forEach(function (el) { el.classList.add('is-visible'); });
    }
}());

(function () {
    var timeEl = document.getElementById('rtc-time');
    var dateEl = document.getElementById('rtc-date');
    function tick() {
        var now = new Date();
        timeEl.textContent = now.toLocaleTimeString('en-US', {
            timeZone: 'Asia/Manila',
            hour: '2-digit', minute: '2-digit', second: '2-digit'
        });
        dateEl.textContent = now.toLocaleDateString('en-US', {
            timeZone: 'Asia/Manila',
            weekday: 'short', month: 'short', day: 'numeric', year: 'numeric'
        });
    }
    tick();
    setInterval(tick, 1000);
}());
</script>
</body>
</html>