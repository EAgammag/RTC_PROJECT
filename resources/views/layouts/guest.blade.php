<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'CCJE ROTC') }}</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Rajdhani:wght@400;500;600;700&family=Share+Tech+Mono&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root {
                --navy:      #0a1628;
                --navy2:     #0d1e38;
                --gold:      #c9a84c;
                --gold2:     #e8c96a;
                --error:     #e05252;
                --success:   #4ade80;
                --text:      #e0dccf;
                --text-dim:  #7a8fa8;
            }

            /* Background grid lines */
            .auth-bg::before {
                content: '';
                position: fixed;
                inset: 0;
                background-image:
                    linear-gradient(rgba(201,168,76,.035) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(201,168,76,.035) 1px, transparent 1px);
                background-size: 44px 44px;
                pointer-events: none;
                z-index: 0;
            }
            /* Radial spotlight */
            .auth-bg::after {
                content: '';
                position: fixed;
                inset: 0;
                background: radial-gradient(ellipse 65% 55% at 50% 42%, rgba(201,168,76,.09) 0%, transparent 68%);
                pointer-events: none;
                z-index: 0;
            }

            /* Card */
            .auth-card {
                position: relative;
                z-index: 1;
                width: 100%;
                max-width: 460px;
                background: linear-gradient(165deg, rgba(13,30,56,.97) 0%, rgba(10,22,40,.99) 100%);
                border: 1px solid rgba(201,168,76,.18);
                border-radius: 4px;
                padding: 2.25rem 2.25rem 1.75rem;
                box-shadow: 0 0 0 1px rgba(0,0,0,.5), 0 8px 80px rgba(0,0,0,.7), 0 0 50px rgba(201,168,76,.05);
                animation: ac-fadeUp .55s cubic-bezier(.22,.68,0,1.1) both;
            }
            @keyframes ac-fadeUp {
                from { opacity: 0; transform: translateY(20px); }
                to   { opacity: 1; transform: translateY(0); }
            }

            /* Corner brackets */
            .auth-card::before { content: ''; position: absolute; top: -1px; left: -1px; width: 20px; height: 20px; border-top: 2px solid var(--gold); border-left: 2px solid var(--gold); border-radius: 1px 0 0 0; }
            .auth-card::after  { content: ''; position: absolute; bottom: -1px; right: -1px; width: 20px; height: 20px; border-bottom: 2px solid var(--gold); border-right: 2px solid var(--gold); border-radius: 0 0 1px 0; }
            .ac-corner-tr { position: absolute; top: -1px; right: -1px; width: 20px; height: 20px; border-top: 2px solid var(--gold); border-right: 2px solid var(--gold); border-radius: 0 1px 0 0; }
            .ac-corner-bl { position: absolute; bottom: -1px; left: -1px; width: 20px; height: 20px; border-bottom: 2px solid var(--gold); border-left: 2px solid var(--gold); border-radius: 0 0 0 1px; }

            /* Security badge */
            .ac-badge {
                display: flex;
                align-items: center;
                gap: .55rem;
                overflow: hidden;
                background: rgba(201,168,76,.05);
                border: 1px solid rgba(201,168,76,.16);
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
            .ac-ring-outer { position: absolute; inset: -8px; border-radius: 50%; border: 1px solid rgba(201,168,76,.12); animation: ac-ring-pulse 2.6s ease-in-out infinite .5s; }
            .ac-ring-mid   { position: absolute; inset: -2px; border-radius: 50%; border: 1px solid rgba(201,168,76,.25); animation: ac-ring-pulse 2.6s ease-in-out infinite .25s; }
            .ac-ring-inner { position: absolute; inset: 0; border-radius: 50%; border: 2px solid rgba(201,168,76,.38); animation: ac-ring-pulse 2.6s ease-in-out infinite; }
            @keyframes ac-ring-pulse {
                0%, 100% { opacity: 1; transform: scale(1); }
                50%       { opacity: .4; transform: scale(1.045); }
            }
            .ac-crest-face {
                position: absolute; inset: 4px; border-radius: 50%;
                background: radial-gradient(circle, rgba(201,168,76,.13) 0%, rgba(10,22,40,.95) 68%);
                display: flex; align-items: center; justify-content: center;
            }
            .ac-crest-face svg { width: 40px; height: 40px; filter: drop-shadow(0 0 8px rgba(201,168,76,.6)); }
            .ac-crest-title { font-family: 'Bebas Neue', sans-serif; font-size: 1.3rem; letter-spacing: .15em; color: var(--gold2); line-height: 1; margin-bottom: .25rem; }
            .ac-crest-sub   { font-family: 'Share Tech Mono', monospace; font-size: .58rem; color: var(--text-dim); letter-spacing: .16em; text-transform: uppercase; text-align: center; }

            /* Fields */
            .ac-label {
                display: block;
                font-family: 'Share Tech Mono', monospace;
                font-size: .62rem;
                letter-spacing: .16em;
                color: var(--text-dim);
                text-transform: uppercase;
                margin-bottom: .38rem;
            }
            .ac-input-wrap { position: relative; }
            .ac-input-icon {
                position: absolute; left: .8rem; top: 50%; transform: translateY(-50%);
                color: var(--text-dim); font-size: .8rem; pointer-events: none; user-select: none;
                font-family: 'Share Tech Mono', monospace;
            }
            .ac-input {
                width: 100%;
                background: rgba(8,18,36,.75);
                border: 1px solid rgba(201,168,76,.16);
                border-radius: 3px;
                padding: .62rem .8rem .62rem 2.35rem;
                color: var(--text);
                font-family: 'Rajdhani', sans-serif;
                font-size: .95rem; font-weight: 500;
                outline: none;
                transition: border-color .2s, box-shadow .2s, background .2s;
            }
            .ac-input::placeholder { color: rgba(122,143,168,.35); font-family: 'Share Tech Mono', monospace; font-size: .72rem; }
            .ac-input:focus {
                border-color: rgba(201,168,76,.5);
                background: rgba(10,22,40,.9);
                box-shadow: 0 0 0 3px rgba(201,168,76,.06), inset 0 1px 0 rgba(201,168,76,.04);
            }
            .ac-input.is-error { border-color: rgba(224,82,82,.6) !important; box-shadow: 0 0 0 3px rgba(224,82,82,.05); }
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
            .ac-alert-success { background: rgba(74,222,128,.07); border-color: var(--success); color: var(--success); }
            .ac-alert-error   { background: rgba(224,82,82,.07);  border-color: var(--error);   color: var(--error); }

            /* Extras row */
            .ac-extras { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem; }
            .ac-check-label { display: flex; align-items: center; gap: .45rem; cursor: pointer; font-family: 'Rajdhani', sans-serif; font-size: .85rem; font-weight: 500; color: var(--text-dim); user-select: none; }
            .ac-check-label input[type="checkbox"] { accent-color: var(--gold); width: 14px; height: 14px; cursor: pointer; flex-shrink: 0; }
            .ac-forgot { font-family: 'Share Tech Mono', monospace; font-size: .62rem; color: var(--gold); letter-spacing: .1em; text-decoration: none; opacity: .75; transition: opacity .15s; }
            .ac-forgot:hover { opacity: 1; text-decoration: underline; }

            /* Submit button */
            .ac-submit {
                display: flex; align-items: center; justify-content: center; gap: .55rem;
                width: 100%; padding: .82rem 1.5rem;
                background: linear-gradient(135deg, #d8b455 0%, #c9a84c 48%, #a88030 100%);
                color: var(--navy);
                font-family: 'Bebas Neue', sans-serif; font-size: 1.05rem; letter-spacing: .22em;
                border: none; border-radius: 3px; cursor: pointer;
                box-shadow: 0 0 22px rgba(201,168,76,.18), inset 0 1px 0 rgba(255,255,255,.12);
                transition: transform .15s, box-shadow .15s;
                position: relative; overflow: hidden;
            }
            .ac-submit::before { content: ''; position: absolute; inset: 0; background: linear-gradient(to bottom, rgba(255,255,255,.1) 0%, transparent 60%); pointer-events: none; }
            .ac-submit:hover { transform: translateY(-1px); box-shadow: 0 4px 28px rgba(201,168,76,.32), inset 0 1px 0 rgba(255,255,255,.15); }
            .ac-submit:active { transform: translateY(0); }

            .ac-form-footer { margin-top: 1.25rem; text-align: center; font-family: 'Share Tech Mono', monospace; font-size: .56rem; color: var(--text-dim); letter-spacing: .1em; opacity: .6; text-transform: uppercase; }

            @media (max-width: 480px) {
                .auth-card { padding: 1.75rem 1.25rem 1.5rem; }
            }
        </style>
    </head>
    <body class="auth-bg font-sans antialiased" style="background: #0a1628; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 1.5rem;">

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
                            <circle cx="30" cy="8" r="4.5" stroke="#c9a84c" stroke-width="2.2" fill="none"/>
                            <line x1="30" y1="12.5" x2="30" y2="50" stroke="#c9a84c" stroke-width="2.4" stroke-linecap="round"/>
                            <line x1="15" y1="24" x2="45" y2="24" stroke="#c9a84c" stroke-width="2.4" stroke-linecap="round"/>
                            <circle cx="15" cy="24" r="2.2" fill="#c9a84c"/>
                            <circle cx="45" cy="24" r="2.2" fill="#c9a84c"/>
                            <path d="M30 50 Q16 50 15 42" stroke="#c9a84c" stroke-width="2.4" stroke-linecap="round" fill="none"/>
                            <path d="M30 50 Q44 50 45 42" stroke="#c9a84c" stroke-width="2.4" stroke-linecap="round" fill="none"/>
                            <path d="M15 42 Q11 38 13.5 33.5" stroke="#c9a84c" stroke-width="2" stroke-linecap="round" fill="none"/>
                            <path d="M45 42 Q49 38 46.5 33.5" stroke="#c9a84c" stroke-width="2" stroke-linecap="round" fill="none"/>
                        </svg>
                    </div>
                </div>
                <div class="ac-crest-title">CSU APARRI &nbsp;·&nbsp; NROTC</div>
                <div class="ac-crest-sub">Naval Reserve Officers Training Corps &nbsp;·&nbsp; Information System</div>
            </div>

            {{ $slot }}
        </div>

    </body>
</html>
