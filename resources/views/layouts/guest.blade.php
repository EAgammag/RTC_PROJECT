<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'CCJE ROTC') }}</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Anton&family=Rajdhani:wght@400;500;600;700&family=Share+Tech+Mono&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* Same glass navbar as landing page */
            .nav-glass {
                background: rgba(15,4,4,.96);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                border-bottom: 1px solid rgba(255,215,0,.14);
                box-shadow: 0 1px 24px rgba(0,0,0,.5);
            }

            /* Hero gradient — matches welcome page hero-bg */
            .auth-bg {
                background:
                    radial-gradient(ellipse 75% 55% at 50% -5%, rgba(255,215,0,.15) 0%, transparent 58%),
                    radial-gradient(ellipse 45% 60% at 3% 55%, rgba(128,0,0,.28) 0%, transparent 55%),
                    radial-gradient(ellipse 38% 45% at 95% 65%, rgba(255,215,0,.1) 0%, transparent 52%),
                    radial-gradient(ellipse 60% 50% at 50% 110%, rgba(255,215,0,.06) 0%, transparent 60%),
                    linear-gradient(165deg, #350d0d 0%, #200708 45%, #0f0404 100%);
                background-attachment: fixed;
            }

            /* Dot grid overlay — matches welcome page dot-grid */
            .auth-bg::before {
                content: '';
                position: fixed;
                inset: 0;
                background-image: radial-gradient(rgba(255,215,0,.07) 1px, transparent 1px);
                background-size: 36px 36px;
                pointer-events: none;
                z-index: 0;
            }

            /* Card */
            .auth-card {
                position: relative;
                z-index: 1;
                width: 100%;
                max-width: 460px;
                background: #ffffff;
                border: 1px solid rgba(128,0,0,.2);
                border-radius: 4px;
                padding: 2.25rem 2.25rem 1.75rem;
                box-shadow: 0 0 0 1px rgba(0,0,0,.08), 0 8px 40px rgba(0,0,0,.12);
                animation: ac-fadeUp .55s cubic-bezier(.22,.68,0,1.1) both;
            }
            @keyframes ac-fadeUp {
                from { opacity: 0; transform: translateY(20px); }
                to   { opacity: 1; transform: translateY(0); }
            }

            /* Corner brackets */
            .auth-card::before { content: ''; position: absolute; top: -1px; left: -1px; width: 20px; height: 20px; border-top: 2px solid #800000; border-left: 2px solid #800000; border-radius: 1px 0 0 0; }
            .auth-card::after  { content: ''; position: absolute; bottom: -1px; right: -1px; width: 20px; height: 20px; border-bottom: 2px solid #800000; border-right: 2px solid #800000; border-radius: 0 0 1px 0; }
            .ac-corner-tr { position: absolute; top: -1px; right: -1px; width: 20px; height: 20px; border-top: 2px solid #800000; border-right: 2px solid #800000; border-radius: 0 1px 0 0; }
            .ac-corner-bl { position: absolute; bottom: -1px; left: -1px; width: 20px; height: 20px; border-bottom: 2px solid #800000; border-left: 2px solid #800000; border-radius: 0 0 0 1px; }

            /* Security badge */
            .ac-badge {
                display: flex;
                align-items: center;
                gap: .55rem;
                overflow: hidden;
                background: rgba(255,215,0,.05);
                border: 1px solid rgba(255,215,0,.16);
                border-radius: 2px;
                padding: .3rem .85rem;
                margin-bottom: 1.75rem;
            }
            .ac-badge-dot {
                width: 7px; height: 7px;
                border-radius: 50%;
                background: var(--success);
                box-shadow: 0 0 7px var(--success);
                flex-shrink: 0;
                animation: ac-dot-pulse 2s ease-in-out infinite;
            }
            @keyframes ac-dot-pulse {
                0%, 100% { opacity: 1; transform: scale(1); }
                50%       { opacity: .45; transform: scale(.85); }
            }
            .ac-badge-ticker { overflow: hidden; flex: 1; }
            .ac-badge-ticker span {
                display: inline-block;
                font-family: 'Share Tech Mono', monospace;
                font-size: .62rem;
                color: var(--gold);
                letter-spacing: .1em;
                white-space: nowrap;
                animation: ac-ticker 18s linear infinite;
            }
            @keyframes ac-ticker {
                0%   { transform: translateX(60%); }
                100% { transform: translateX(-100%); }
            }

            /* Crest rings */
            .ac-crest-wrap { display: flex; flex-direction: column; align-items: center; margin-bottom: 1.5rem; }
            .ac-ring-wrap { position: relative; width: 80px; height: 80px; margin-bottom: .8rem; }
            .ac-ring-outer { position: absolute; inset: -8px; border-radius: 50%; border: 1px solid rgba(128,0,0,.15); animation: ac-ring-pulse 2.6s ease-in-out infinite .5s; }
            .ac-ring-mid   { position: absolute; inset: -2px; border-radius: 50%; border: 1px solid rgba(128,0,0,.28); animation: ac-ring-pulse 2.6s ease-in-out infinite .25s; }
            .ac-ring-inner { position: absolute; inset: 0; border-radius: 50%; border: 2px solid rgba(128,0,0,.42); animation: ac-ring-pulse 2.6s ease-in-out infinite; }
            @keyframes ac-ring-pulse {
                0%, 100% { opacity: 1; transform: scale(1); }
                50%       { opacity: .4; transform: scale(1.045); }
            }
            .ac-crest-face {
                position: absolute; inset: 4px; border-radius: 50%;
                background: radial-gradient(circle, rgba(255,215,0,.13) 0%, rgba(40,10,10,.95) 68%);
                display: flex; align-items: center; justify-content: center;
            }
            .ac-crest-face svg { width: 40px; height: 40px; filter: drop-shadow(0 0 8px rgba(255,215,0,.6)); }
            .ac-crest-title { font-family: 'Anton', sans-serif; font-size: 1.3rem; letter-spacing: .15em; color: var(--gold); line-height: 1; margin-bottom: .25rem; }
            .ac-crest-sub   { font-family: 'Share Tech Mono', monospace; font-size: .58rem; color: #a0bad4; letter-spacing: .16em; text-transform: uppercase; text-align: center; }

            /* Fields */
            .ac-label {
                display: block;
                font-family: 'Share Tech Mono', monospace;
                font-size: .62rem;
                letter-spacing: .16em;
                color: #a0bad4;
                text-transform: uppercase;
                margin-bottom: .38rem;
            }
            .ac-input-wrap { position: relative; }
            .ac-input-icon {
                position: absolute; left: .8rem; top: 50%; transform: translateY(-50%);
                color: #7a9ab8; font-size: .8rem; pointer-events: none; user-select: none;
                font-family: 'Share Tech Mono', monospace;
            }
            .ac-input {
                width: 100%;
                background: rgba(36,8,8,.75);
                border: 1px solid rgba(255,215,0,.16);
                border-radius: 3px;
                padding: .62rem .8rem .62rem 2.35rem;
                color: var(--text-inv);
                font-family: 'Rajdhani', sans-serif;
                font-size: .95rem; font-weight: 500;
                outline: none;
                transition: border-color .2s, box-shadow .2s, background .2s;
            }
            .ac-input::placeholder { color: rgba(140,168,196,.55); font-family: 'Share Tech Mono', monospace; font-size: .72rem; }
            .ac-input:focus {
                border-color: rgba(255,215,0,.5);
                background: rgba(40,10,10,.9);
                box-shadow: 0 0 0 3px rgba(255,215,0,.06), inset 0 1px 0 rgba(255,215,0,.04);
            }
            .ac-input.is-error { border-color: rgba(224,82,82,.6) !important; box-shadow: 0 0 0 3px rgba(224,82,82,.07); }
            .ac-pw-toggle {
                position: absolute; right: .7rem; top: 50%; transform: translateY(-50%);
                background: none; border: none; cursor: pointer;
                font-size: .88rem; opacity: .45; transition: opacity .15s; line-height: 1; padding: 0; color: inherit;
            }
            .ac-pw-toggle:hover { opacity: .9; }

            /* Errors */
            .ac-field-error { font-family: 'Share Tech Mono', monospace; font-size: .6rem; color: var(--error); letter-spacing: .06em; margin-top: .28rem; }

            /* Alert */
            .ac-alert {
                display: flex; align-items: center; gap: .55rem;
                margin-bottom: .9rem; padding: .6rem .9rem;
                border-radius: 3px;
                font-family: 'Share Tech Mono', monospace; font-size: .65rem; letter-spacing: .07em; line-height: 1.5;
                border-left: 3px solid;
            }
            .ac-alert-success { background: rgba(74,222,128,.1);  border-color: var(--success); color: #86efac; }
            .ac-alert-error   { background: rgba(224,82,82,.1);   border-color: var(--error);   color: #fca5a5; }

            /* Extras row */
            .ac-extras { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem; }
            .ac-check-label { display: flex; align-items: center; gap: .45rem; cursor: pointer; font-family: 'Rajdhani', sans-serif; font-size: .85rem; font-weight: 500; color: #a0bad4; user-select: none; }
            .ac-check-label input[type="checkbox"] { accent-color: var(--gold); width: 14px; height: 14px; cursor: pointer; flex-shrink: 0; }
            .ac-forgot { font-family: 'Share Tech Mono', monospace; font-size: .62rem; color: var(--gold3); letter-spacing: .1em; text-decoration: none; opacity: .9; transition: opacity .15s; }
            .ac-forgot:hover { opacity: 1; text-decoration: underline; }

            /* Submit button */
            .ac-submit {
                display: flex; align-items: center; justify-content: center; gap: .55rem;
                width: 100%; padding: .82rem 1.5rem;
                background: linear-gradient(135deg, #FFD700 0%, #E6C200 48%, #C7A600 100%);
                color: var(--navy);
                font-family: 'Anton', sans-serif; font-size: 1.05rem; letter-spacing: .22em;
                border: none; border-radius: 3px; cursor: pointer;
                box-shadow: 0 0 22px rgba(255,215,0,.18), inset 0 1px 0 rgba(255,255,255,.12);
                transition: transform .15s, box-shadow .15s;
                position: relative; overflow: hidden;
            }
            .ac-submit::before { content: ''; position: absolute; inset: 0; background: linear-gradient(to bottom, rgba(255,255,255,.1) 0%, transparent 60%); pointer-events: none; }
            .ac-submit:hover { transform: translateY(-1px); box-shadow: 0 4px 28px rgba(255,215,0,.32), inset 0 1px 0 rgba(255,255,255,.15); }
            .ac-submit:active { transform: translateY(0); }

            .ac-form-footer { margin-top: 1.25rem; text-align: center; font-family: 'Share Tech Mono', monospace; font-size: .56rem; color: #7a9ab8; letter-spacing: .1em; opacity: 1; text-transform: uppercase; }

            @media (max-width: 480px) {
                .auth-card { padding: 1.75rem 1.25rem 1.5rem; }
            }
        </style>
    </head>
    <body class="auth-bg font-sans antialiased" style="min-height: 100vh;">

        {{-- Glass navbar — same as landing page --}}
        <nav class="nav-glass fixed top-0 inset-x-0 z-50">
            <div class="max-w-7xl mx-auto px-6 lg:px-10 flex items-center justify-between h-16">
                <a href="/" class="flex items-center gap-3" style="text-decoration:none;">
                    <img src="{{ asset('CCJE.png') }}" alt="CCJE Logo" class="h-9 w-auto shrink-0">
                    <div class="leading-none">
                        <span class="text-sm font-black tracking-wider uppercase" style="color:#FFD700;">NROTC</span>
                        <span class="text-sm font-bold tracking-wide text-slate-400"> &middot; CSU Aparri</span>
                        <p class="text-xs text-slate-300 hidden lg:block" style="margin-top:.125rem;">Secure Information System</p>
                    </div>
                </a>
                <div class="leading-tight text-right">
                    <div class="text-sm font-mono font-semibold" style="color:#FFD700;" id="auth-nav-time">--:--:-- --</div>
                    <div class="text-xs text-slate-400" id="auth-nav-date">---, --- --, ----</div>
                    <div class="text-slate-500 tracking-widest uppercase" style="font-size:0.7rem;">Philippine Standard Time</div>
                </div>
            </div>
        </nav>

        {{-- Atmospheric blur blobs (same depth effect as landing page) --}}
        <div class="pointer-events-none" style="position:fixed;inset:0;z-index:0;overflow:hidden;">
            <div style="position:absolute;top:25%;left:-10rem;width:32rem;height:32rem;border-radius:50%;background:radial-gradient(circle,rgba(255,215,0,.18) 0%,transparent 70%);filter:blur(80px);opacity:.35;"></div>
            <div style="position:absolute;bottom:25%;right:-5rem;width:20rem;height:20rem;border-radius:50%;background:radial-gradient(circle,rgba(128,0,0,.25) 0%,transparent 70%);filter:blur(60px);opacity:.25;"></div>
            <div style="position:absolute;top:-10rem;right:0;width:48rem;height:36rem;border-radius:50%;background:radial-gradient(ellipse,rgba(128,0,0,.2) 0%,transparent 65%);filter:blur(80px);opacity:.35;"></div>
        </div>

        {{-- Centered card area with top offset for navbar --}}
        <div style="position:relative;z-index:1;min-height:100vh;display:flex;align-items:center;justify-content:center;padding:5.5rem 1.5rem 2rem;">

        <div class="auth-card">
            <div class="ac-corner-tr"></div>
            <div class="ac-corner-bl"></div>

            {{-- Security badge ticker --}}
            <div class="ac-badge">
                <span class="ac-badge-dot"></span>
                <div class="ac-badge-ticker">
                    <span>ENCRYPTED CHANNEL ACTIVE &nbsp;·&nbsp; TLS 1.3 &nbsp;·&nbsp; AES-256-GCM &nbsp;·&nbsp; SECURE SESSION &nbsp;·&nbsp; NROTC SIS v2.0 &nbsp;·&nbsp; CSU–APARRI &nbsp;·&nbsp; ACCESS RESTRICTED &nbsp;&nbsp;&nbsp;</span>
                </div>
            </div>

            {{-- Anchor crest --}}
            <div class="ac-crest-wrap">
                <div class="ac-ring-wrap">
                    <div class="ac-ring-outer"></div>
                    <div class="ac-ring-mid"></div>
                    <div class="ac-ring-inner"></div>
                    <div class="ac-crest-face">
                        <svg viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <circle cx="30" cy="8" r="4.5" stroke="#800000" stroke-width="2.2" fill="none"/>
                            <line x1="30" y1="12.5" x2="30" y2="50" stroke="#800000" stroke-width="2.4" stroke-linecap="round"/>
                            <line x1="15" y1="24" x2="45" y2="24" stroke="#800000" stroke-width="2.4" stroke-linecap="round"/>
                            <circle cx="15" cy="24" r="2.2" fill="#800000"/>
                            <circle cx="45" cy="24" r="2.2" fill="#800000"/>
                            <path d="M30 50 Q16 50 15 42" stroke="#800000" stroke-width="2.4" stroke-linecap="round" fill="none"/>
                            <path d="M30 50 Q44 50 45 42" stroke="#800000" stroke-width="2.4" stroke-linecap="round" fill="none"/>
                            <path d="M15 42 Q11 38 13.5 33.5" stroke="#800000" stroke-width="2" stroke-linecap="round" fill="none"/>
                            <path d="M45 42 Q49 38 46.5 33.5" stroke="#800000" stroke-width="2" stroke-linecap="round" fill="none"/>
                        </svg>
                    </div>
                </div>
                <div class="ac-crest-title">CSU APARRI &nbsp;·&nbsp; NROTC</div>
                <div class="ac-crest-sub">Naval Reserve Officers Training Corps &nbsp;·&nbsp; Information System</div>
            </div>

            {{ $slot }}
        </div>

        </div>{{-- end centered wrapper --}}

        <script>
            (function () {
                function updateAuthTime() {
                    var now = new Date();
                    var t = document.getElementById('auth-nav-time');
                    var d = document.getElementById('auth-nav-date');
                    if (t) { t.textContent = now.toLocaleTimeString('en-US', { hour12: true }); }
                    if (d) { d.textContent = now.toLocaleDateString('en-US', { weekday: 'short', month: 'short', day: '2-digit', year: 'numeric' }); }
                }
                updateAuthTime();
                setInterval(updateAuthTime, 1000);
            })();
        </script>

    </body>
</html>
