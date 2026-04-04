<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Enrollment Requirements · 133rd NROTC CSU Aparri</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body { margin: 0; font-family: 'Inter', sans-serif; background: #ffffff; }

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

        .section-eyebrow {
            font-size: .65rem; font-weight: 700; letter-spacing: .18em; text-transform: uppercase;
            color: #800000;
        }
        .badge-attachment {
            display: inline-flex; align-items: center; gap: .3rem;
            padding: .2rem .65rem; border-radius: 9999px;
            font-size: .7rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase;
            background: rgba(29,78,216,.06); color: #1d4ed8;
            border: 1px solid rgba(29,78,216,.18);
            white-space: nowrap;
        }
        .badge-photo {
            display: inline-flex; align-items: center; gap: .3rem;
            padding: .2rem .65rem; border-radius: 9999px;
            font-size: .7rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase;
            background: rgba(4,120,87,.06); color: #047857;
            border: 1px solid rgba(4,120,87,.18);
            white-space: nowrap;
        }
        .req-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 1.25rem;
            box-shadow: 0 1px 4px rgba(0,0,0,.05);
            overflow: hidden;
            transition: border-color .2s, box-shadow .2s;
        }
        .req-card:hover { border-color: rgba(128,0,0,.2); box-shadow: 0 6px 20px rgba(0,0,0,.07); }
        .dot-grid {
            background-image: radial-gradient(rgba(128,0,0,.04) 1px, transparent 1px);
            background-size: 36px 36px;
        }
        [data-reveal] {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity .6s cubic-bezier(.4,0,.2,1), transform .6s cubic-bezier(.4,0,.2,1);
        }
        [data-reveal].is-visible { opacity: 1; transform: none; }
        [data-reveal][data-delay="1"] { transition-delay: .1s; }
        [data-reveal][data-delay="2"] { transition-delay: .2s; }
        [data-reveal][data-delay="3"] { transition-delay: .3s; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f5f5f5; }
        ::-webkit-scrollbar-thumb { background: rgba(128,0,0,.3); border-radius: 3px; }
    </style>
</head>
<body class="font-sans antialiased">
    @include('partials.page-loader')

    {{-- NAVBAR --}}
    <nav class="nav-glass fixed top-0 inset-x-0 z-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-10 flex items-center justify-between h-16">
            <a href="{{ url('/') }}" class="flex items-center gap-3 no-underline">
                <img src="{{ asset('133rd NROTC_logo.jpg') }}" alt="133rd NROTC Logo" class="h-9 w-9 shrink-0 rounded-full object-cover">
                <div class="leading-none">
                    <span class="text-base font-black tracking-wider uppercase" style="color:#ffffff;">133rd NROTC</span>
                    <span class="text-sm font-bold tracking-wide text-slate-300"> · CSU Aparri</span>
                    <p class="text-xs text-slate-400 mt-0.5 hidden lg:block">Secure Information System</p>
                </div>
            </a>
            <a href="{{ url('/') }}" class="flex items-center gap-1.5 text-sm text-slate-300 hover:text-white transition-colors font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Back to Portal
            </a>
        </div>
    </nav>

    {{-- HERO --}}
    <section class="dot-grid relative pt-32 pb-14 px-6 overflow-hidden" style="background:#ffffff;">
        <div class="absolute top-0 left-0 right-0 h-1" style="background: linear-gradient(90deg, #800000, #003366, #800000);"></div>
        <div class="absolute -top-32 -right-32 w-[480px] h-[480px] rounded-full blur-3xl pointer-events-none"
             style="background: radial-gradient(circle, rgba(128,0,0,.05) 0%, transparent 70%);"></div>

        <div class="max-w-4xl mx-auto text-center" data-reveal>
            <p class="section-eyebrow mb-4">CCJE ROTC · CSU Aparri</p>
            <h1 class="text-4xl lg:text-6xl font-black leading-[1.08] tracking-tight mb-5">
                <span class="text-slate-900">Enrollment</span>
                <span style="color:#800000;"> Requirements</span>
            </h1>
            <p class="text-slate-600 text-base lg:text-lg leading-relaxed max-w-2xl mx-auto mb-8">
                Review the complete requirements before approaching the ROTC office.
                Prepare all documents in advance to ensure a smooth enrollment process.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <div class="flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold"
                     style="background:rgba(128,0,0,.06); color:#800000; border:1px solid rgba(128,0,0,.15);">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    3 Requirement Categories
                </div>
                <div class="flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold"
                     style="background:rgba(29,78,216,.06); color:#1d4ed8; border:1px solid rgba(29,78,216,.15);">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                    </svg>
                    Attachments Required
                </div>
                <div class="flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold"
                     style="background:rgba(4,120,87,.06); color:#047857; border:1px solid rgba(4,120,87,.15);">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Filipino Citizens Only
                </div>
            </div>
        </div>
    </section>

    {{-- REQUIREMENT CARDS --}}
    <main class="max-w-5xl mx-auto px-6 lg:px-10 pb-20 pt-4">

        {{-- 1. Basic Eligibility --}}
        <div class="req-card mb-6" data-reveal>
            <div class="flex items-center gap-4 px-7 py-5"
                 style="background: rgba(128,0,0,.03); border-bottom: 1px solid rgba(128,0,0,.1);">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0"
                     style="background: rgba(128,0,0,.08); border: 1px solid rgba(128,0,0,.15);">
                    <svg class="w-5 h-5" fill="none" stroke="#800000" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <div>
                    <span class="text-xs font-black uppercase tracking-widest" style="color:#800000;">Category 1</span>
                    <h2 class="text-xl font-black text-slate-900 leading-tight">Basic Eligibility</h2>
                </div>
            </div>
            <div class="px-7 py-6">
                <p class="text-sm text-slate-600 mb-5 leading-relaxed">
                    To be eligible for the Basic ROTC program, an applicant must meet all of the following criteria:
                </p>
                <div class="flex flex-col gap-4">

                    <div class="flex items-start gap-4 p-4 rounded-xl"
                         style="background:#f9fafb; border:1px solid #f3f4f6;">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 mt-0.5"
                             style="background:rgba(128,0,0,.06); border:1px solid rgba(128,0,0,.1);">
                            <svg class="w-4 h-4" fill="none" stroke="#800000" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-800 mb-1">Citizenship</p>
                            <p class="text-sm text-slate-600 leading-relaxed">Must be a <strong>Filipino citizen</strong>.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-4 rounded-xl"
                         style="background:#f9fafb; border:1px solid #f3f4f6;">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 mt-0.5"
                             style="background:rgba(128,0,0,.06); border:1px solid rgba(128,0,0,.1);">
                            <svg class="w-4 h-4" fill="none" stroke="#800000" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="flex flex-wrap items-center gap-2 mb-1">
                                <p class="text-sm font-bold text-slate-800">Student Status</p>
                                <span class="badge-attachment">
                                    <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                                    </svg>
                                    Attachment
                                </span>
                            </div>
                            <p class="text-sm text-slate-600 leading-relaxed">
                                Must be currently enrolled in a <strong>baccalaureate degree program</strong> or <strong>Bachelor of Science in Criminology</strong>.
                                Proof of enrolment must be attached.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-4 rounded-xl"
                         style="background:#f9fafb; border:1px solid #f3f4f6;">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 mt-0.5"
                             style="background:rgba(128,0,0,.06); border:1px solid rgba(128,0,0,.1);">
                            <svg class="w-4 h-4" fill="none" stroke="#800000" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="flex flex-wrap items-center gap-2 mb-1">
                                <p class="text-sm font-bold text-slate-800">Physical Fitness</p>
                                <span class="badge-attachment">
                                    <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                                    </svg>
                                    Attachment
                                </span>
                            </div>
                            <p class="text-sm text-slate-600 leading-relaxed">
                                Must be <strong>physically and mentally fit</strong> for military training.
                                Medical records must be attached as supporting documentation.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- 2. Documentary Requirements --}}
        <div class="req-card mb-6" data-reveal data-delay="1">
            <div class="flex items-center gap-4 px-7 py-5"
                 style="background: rgba(29,78,216,.03); border-bottom: 1px solid rgba(29,78,216,.1);">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0"
                     style="background: rgba(29,78,216,.08); border: 1px solid rgba(29,78,216,.15);">
                    <svg class="w-5 h-5" fill="none" stroke="#1d4ed8" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                    </svg>
                </div>
                <div>
                    <span class="text-xs font-black uppercase tracking-widest" style="color:#1d4ed8;">Category 2</span>
                    <h2 class="text-xl font-black text-slate-900 leading-tight">Documentary Requirements</h2>
                </div>
            </div>
            <div class="px-7 py-6">
                <p class="text-sm text-slate-600 mb-5 leading-relaxed">
                    The following documents must be submitted to the ROTC office upon enrollment. Items marked
                    <span class="badge-attachment" style="font-size:.65rem; padding:.15rem .5rem;">Attachment</span> or
                    <span class="badge-photo" style="font-size:.65rem; padding:.15rem .5rem;">Photo Upload</span> require a digital or physical copy.
                </p>
                <div class="flex flex-col gap-3">

                    @foreach ([
                        [
                            'title'  => 'Assessment Form',
                            'desc'   => 'Provided by the CSU Registrar. Must be secured from the registrar\'s office before enrollment.',
                            'badge'  => 'attachment',
                            'icon'   => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2',
                        ],
                        [
                            'title'  => 'Medical Certificate',
                            'desc'   => 'Issued by the campus clinic or an accredited hospital. Must confirm the applicant\'s fitness for military training.',
                            'badge'  => 'attachment',
                            'icon'   => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                        ],
                        [
                            'title'  => 'Parental Consent / Waiver',
                            'desc'   => 'A signed waiver or consent form is required, especially if the student is a minor.',
                            'badge'  => 'attachment',
                            'icon'   => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
                        ],
                        [
                            'title'  => 'Recent ID Photos',
                            'desc'   => '2×2 or 1×1 colored photos with a white background. Male applicants must have a neat military haircut. Photo will be used as the avatar profile.',
                            'badge'  => 'photo',
                            'icon'   => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z',
                        ],
                        [
                            'title'  => 'School ID',
                            'desc'   => 'Proof of being a bona fide student of the institution for the current semester.',
                            'badge'  => 'attachment',
                            'icon'   => 'M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2',
                        ],
                    ] as $doc)
                    <div class="flex items-start gap-4 p-4 rounded-xl" style="background:#f9fafb; border:1px solid #f3f4f6;">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 mt-0.5"
                             style="background:rgba(29,78,216,.06); border:1px solid rgba(29,78,216,.12);">
                            <svg class="w-4 h-4" fill="none" stroke="#1d4ed8" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $doc['icon'] }}"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex flex-wrap items-center gap-2 mb-1">
                                <p class="text-sm font-bold text-slate-800">{{ $doc['title'] }}</p>
                                @if ($doc['badge'] === 'attachment')
                                    <span class="badge-attachment">
                                        <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                                        </svg>
                                        Attachment
                                    </span>
                                @elseif ($doc['badge'] === 'photo')
                                    <span class="badge-photo">
                                        <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        Photo Upload
                                    </span>
                                @endif
                            </div>
                            <p class="text-sm text-slate-600 leading-relaxed">{{ $doc['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>

        {{-- 3. Physical and Grooming Standards --}}
        <div class="req-card mb-10" data-reveal data-delay="2">
            <div class="flex items-center gap-4 px-7 py-5"
                 style="background: rgba(4,120,87,.03); border-bottom: 1px solid rgba(4,120,87,.1);">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0"
                     style="background: rgba(4,120,87,.08); border: 1px solid rgba(4,120,87,.15);">
                    <svg class="w-5 h-5" fill="none" stroke="#047857" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
                <div>
                    <span class="text-xs font-black uppercase tracking-widest" style="color:#047857;">Category 3</span>
                    <h2 class="text-xl font-black text-slate-900 leading-tight">Physical & Grooming Standards</h2>
                </div>
            </div>
            <div class="px-7 py-6">
                <p class="text-sm text-slate-600 mb-5 leading-relaxed">
                    The military maintains strict standards for appearance and health to ensure discipline and
                    personal safety during drills and field training.
                </p>
                <div class="grid md:grid-cols-2 gap-4">

                    <div class="p-5 rounded-xl" style="background:#f9fafb; border:1px solid #f3f4f6;">
                        <div class="flex items-center gap-2.5 mb-3">
                            <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0"
                                 style="background:rgba(4,120,87,.08); border:1px solid rgba(4,120,87,.15);">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="#047857" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <p class="text-sm font-bold text-slate-800">Grooming</p>
                        </div>
                        <ul class="flex flex-col gap-2">
                            <li class="flex items-start gap-2 text-sm text-slate-600">
                                <svg class="w-3.5 h-3.5 mt-0.5 shrink-0" fill="none" stroke="#047857" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span><strong>Male:</strong> Military cut required — 0-1 or 2-side haircut.</span>
                            </li>
                            <li class="flex items-start gap-2 text-sm text-slate-600">
                                <svg class="w-3.5 h-3.5 mt-0.5 shrink-0" fill="none" stroke="#047857" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span><strong>Female:</strong> Hair must be tied neatly in a bun or worn with a hairnet.</span>
                            </li>
                        </ul>
                    </div>

                    <div class="p-5 rounded-xl" style="background:#f9fafb; border:1px solid #f3f4f6;">
                        <div class="flex items-center gap-2.5 mb-3">
                            <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0"
                                 style="background:rgba(4,120,87,.08); border:1px solid rgba(4,120,87,.15);">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="#047857" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 8h.01M9 16h6"/>
                                </svg>
                            </div>
                            <p class="text-sm font-bold text-slate-800">Health Screening</p>
                        </div>
                        <ul class="flex flex-col gap-2">
                            <li class="flex items-start gap-2 text-sm text-slate-600">
                                <svg class="w-3.5 h-3.5 mt-0.5 shrink-0" fill="none" stroke="#047857" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                                A basic physical examination will be conducted to check for conditions (e.g., asthma, heart conditions) that could be aggravated by intense physical activity.
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>

        {{-- NOTICE BOX --}}
        <div class="rounded-2xl p-6 flex items-start gap-4 mb-10" data-reveal
             style="background: rgba(251,191,36,.05); border: 1px solid rgba(251,191,36,.25);">
            <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0 mt-0.5"
                 style="background: rgba(251,191,36,.1); border: 1px solid rgba(251,191,36,.25);">
                <svg class="w-5 h-5" fill="none" stroke="#92400e" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-bold text-yellow-900 mb-1">Important Notice</p>
                <p class="text-sm text-yellow-800 leading-relaxed">
                    Requirements may vary slightly depending on the branch of service (Army, Navy, or Air Force)
                    and the current academic year policies. Always confirm with the ROTC office for the most
                    up-to-date checklist before submitting your documents.
                </p>
            </div>
        </div>

        {{-- ENROLLMENT PROCESS --}}
        <div class="mb-10" data-reveal>
            <div class="text-center mb-10">
                <p class="section-eyebrow mb-2">Step-by-Step</p>
                <h3 class="text-2xl font-black text-slate-900">Enrollment Process</h3>
                <p class="text-slate-600 text-sm mt-2 max-w-sm mx-auto">Follow these steps in order to complete your ROTC enrollment.</p>
            </div>

            @php
            $steps = [
                ['step' => '1', 'label' => 'Review Requirements',  'desc' => 'Read all eligibility criteria, documentary, and grooming standards on this page.',    'color' => '#800000', 'bg' => 'rgba(128,0,0,.06)',  'border' => 'rgba(128,0,0,.18)',  'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01'],
                ['step' => '2', 'label' => 'Create Your Account',  'desc' => 'Register with your name, email, and password. Your account will be set to cadet and activated by the admin after review.', 'color' => '#4f46e5', 'bg' => 'rgba(79,70,229,.06)', 'border' => 'rgba(79,70,229,.15)', 'icon' => 'M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z'],
                ['step' => '3', 'label' => 'Fill Application Form', 'desc' => 'Complete the online Information Sheet — personal details, family background, and RIDS form.',    'color' => '#1d4ed8', 'bg' => 'rgba(29,78,216,.06)', 'border' => 'rgba(29,78,216,.15)', 'icon' => 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z'],
                ['step' => '4', 'label' => 'Upload Attachments',   'desc' => 'Attach scanned copies of all required documents — assessment form, medical cert, and IDs.', 'color' => '#047857', 'bg' => 'rgba(4,120,87,.06)',  'border' => 'rgba(4,120,87,.15)',  'icon' => 'M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13'],
                ['step' => '5', 'label' => 'Visit ROTC Office',    'desc' => 'Bring originals to the ROTC office for verification and physical assessment.',            'color' => '#be185d', 'bg' => 'rgba(190,24,93,.06)', 'border' => 'rgba(190,24,93,.15)', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
                ['step' => '6', 'label' => 'Access the Portal',    'desc' => 'Once the admin activates your account, sign in with your credentials and access your cadet dashboard.',                  'color' => '#065f46', 'bg' => 'rgba(6,95,70,.06)',   'border' => 'rgba(6,95,70,.15)',   'icon' => 'M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1'],
            ];
            @endphp

            {{-- Desktop: two rows of 3 --}}
            <div class="hidden md:block">

                {{-- Row 1: Steps 1–3 --}}
                <div class="flex items-stretch gap-2">
                    @foreach (array_slice($steps, 0, 3) as $s)
                        <div class="flex-1 rounded-2xl p-5 flex flex-col gap-4"
                             style="background:{{ $s['bg'] }}; border:1px solid {{ $s['border'] }};">
                            <div class="flex items-center justify-between">
                                <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0"
                                     style="background:#fff; border:1.5px solid {{ $s['border'] }};">
                                    <svg class="w-5 h-5" fill="none" stroke="{{ $s['color'] }}" stroke-width="1.8" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $s['icon'] }}"/>
                                    </svg>
                                </div>
                                <span class="text-3xl font-black" style="color:{{ $s['color'] }}; opacity:.08;">{{ $s['step'] }}</span>
                            </div>
                            <div>
                                <span class="text-xs font-black uppercase tracking-widest block mb-1" style="color:{{ $s['color'] }};">Step {{ $s['step'] }}</span>
                                <p class="text-sm font-bold text-slate-900 mb-1">{{ $s['label'] }}</p>
                                <p class="text-xs text-slate-600 leading-relaxed">{{ $s['desc'] }}</p>
                            </div>
                        </div>
                        @if (!$loop->last)
                        <div class="flex items-center justify-center w-6 shrink-0">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="#d1d5db" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                        @endif
                    @endforeach
                </div>

                {{-- Row transition: right-side drop connector --}}
                <div class="flex justify-end pr-5 py-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="#d1d5db" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>

                {{-- Row 2: Steps 4–6 --}}
                <div class="flex items-stretch gap-2">
                    @foreach (array_slice($steps, 3, 3) as $s)
                        <div class="flex-1 rounded-2xl p-5 flex flex-col gap-4"
                             style="background:{{ $s['bg'] }}; border:1px solid {{ $s['border'] }};">
                            <div class="flex items-center justify-between">
                                <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0"
                                     style="background:#fff; border:1.5px solid {{ $s['border'] }};">
                                    <svg class="w-5 h-5" fill="none" stroke="{{ $s['color'] }}" stroke-width="1.8" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $s['icon'] }}"/>
                                    </svg>
                                </div>
                                <span class="text-3xl font-black" style="color:{{ $s['color'] }}; opacity:.08;">{{ $s['step'] }}</span>
                            </div>
                            <div>
                                <span class="text-xs font-black uppercase tracking-widest block mb-1" style="color:{{ $s['color'] }};">Step {{ $s['step'] }}</span>
                                <p class="text-sm font-bold text-slate-900 mb-1">{{ $s['label'] }}</p>
                                <p class="text-xs text-slate-600 leading-relaxed">{{ $s['desc'] }}</p>
                            </div>
                        </div>
                        @if (!$loop->last)
                        <div class="flex items-center justify-center w-6 shrink-0">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="#d1d5db" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                        @endif
                    @endforeach
                </div>

            </div>

            {{-- Mobile vertical timeline --}}
            <div class="md:hidden flex flex-col gap-0">
                @foreach ($steps as $s)
                <div class="flex gap-4">
                    <div class="flex flex-col items-center">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0"
                             style="background:{{ $s['bg'] }}; border:1.5px solid {{ $s['border'] }};">
                            <svg class="w-4 h-4" fill="none" stroke="{{ $s['color'] }}" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $s['icon'] }}"/>
                            </svg>
                        </div>
                        @if (!$loop->last)
                        <div class="w-px flex-1 my-1.5" style="background:{{ $s['border'] }}; min-height:28px;"></div>
                        @endif
                    </div>
                    <div class="pb-5">
                        <span class="text-xs font-black uppercase tracking-widest" style="color:{{ $s['color'] }};">Step {{ $s['step'] }}</span>
                        <p class="text-sm font-bold text-slate-800 mt-0.5 mb-1">{{ $s['label'] }}</p>
                        <p class="text-sm text-slate-500 leading-relaxed">{{ $s['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- CTA --}}
        <div class="text-center" data-reveal>
            <p class="section-eyebrow mb-3">Ready to Enlist?</p>
            <h3 class="text-2xl font-black text-slate-900 mb-3">Begin Your Enrollment Application</h3>
            <p class="text-slate-600 text-sm leading-relaxed mb-7 max-w-lg mx-auto">
                Create your account first, then fill out the online enrollment form.
                Bring your documents to the ROTC office for final verification.
            </p>
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                @auth
                    <a href="{{ route('enroll.form') }}" class="btn-gold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Continue to Enrollment Form
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn-gold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                        Create Account &amp; Enroll
                    </a>
                    <a href="{{ route('login', ['from' => 'enroll']) }}" class="btn-ghost">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        Already Have an Account?
                    </a>
                @endauth
                <a href="{{ url('/') }}" class="btn-ghost">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Back to Home
                </a>
            </div>
        </div>

    </main>

    {{-- FOOTER --}}
    <footer style="background: #001f3f; border-top: 1px solid #003366;">
        <div class="max-w-6xl mx-auto px-6 lg:px-10 py-8">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('CCJE.png') }}" alt="CCJE Logo" class="h-7 w-auto">
                    <p class="text-sm text-slate-400">
                        &copy; {{ date('Y') }} CCrJE ROTC &mdash; Cagayan State University Aparri
                    </p>
                </div>
                <p class="text-sm font-semibold tracking-wider" style="color:#ffffff;">
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
        }, { threshold: 0.1, rootMargin: '0px 0px -30px 0px' });
        revealEls.forEach(function (el) { io.observe(el); });
    } else {
        revealEls.forEach(function (el) { el.classList.add('is-visible'); });
    }
}());
</script>
</body>
</html>
