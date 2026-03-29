<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Enrollment Application · NROTC CSU Aparri</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        body { margin: 0; font-family: 'Inter', sans-serif; background: #f8fafc; }
        .nav-glass { background: #001f3f; border-bottom: 1px solid #003366; box-shadow: 0 1px 3px rgba(0,0,0,.15); }
        .section-eyebrow { font-size: .65rem; font-weight: 700; letter-spacing: .18em; text-transform: uppercase; color: #800000; }

        /* ── Step Progress ── */
        .step-track { display: flex; align-items: flex-start; gap: 0; }
        .step-node  { flex: 1; display: flex; flex-direction: column; align-items: center; gap: .4rem; position: relative; z-index: 1; }
        .step-dot   { width: 2rem; height: 2rem; border-radius: 9999px; border: 2px solid #d1d5db; background: #fff;
                      display: flex; align-items: center; justify-content: center; font-size: .7rem; font-weight: 800;
                      color: #9ca3af; transition: all .3s; }
        .step-dot.done   { background: #047857; border-color: #047857; color: #fff; }
        .step-dot.active { background: #800000; border-color: #800000; color: #fff; box-shadow: 0 0 0 4px rgba(128,0,0,.12); }
        .step-label { font-size: .6rem; font-weight: 700; text-transform: uppercase; letter-spacing: .06em;
                      color: #9ca3af; text-align: center; transition: color .3s; }
        .step-label.active { color: #800000; }
        .step-label.done   { color: #047857; }
        .step-line  { flex: 1; height: 2px; background: #e5e7eb; margin-top: 1rem; transition: background .3s; }
        .step-line.done { background: #047857; }

        /* ── Cards ── */
        .form-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 1.25rem; box-shadow: 0 1px 4px rgba(0,0,0,.05); overflow: hidden; }
        .card-header { display: flex; align-items: center; gap: 1rem; padding: 1.1rem 1.75rem; border-bottom: 1px solid #f3f4f6; }
        .card-icon { width: 2.5rem; height: 2.5rem; border-radius: .75rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }

        /* ── Inputs ── */
        .fl { display: flex; flex-direction: column; gap: .3rem; }
        .lbl { font-size: .7rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; color: #6b7280; }
        .inp { width: 100%; padding: .6rem .85rem; border: 1px solid #e5e7eb; border-radius: .625rem;
               font-size: .875rem; font-family: 'Inter', sans-serif; color: #111827; background: #fff; outline: none;
               transition: border-color .15s, box-shadow .15s; }
        .inp:focus { border-color: #800000; box-shadow: 0 0 0 3px rgba(128,0,0,.08); }
        .inp::placeholder { color: #c4c9d4; }
        select.inp { cursor: pointer; }
        .divider { border: none; height: 1px; background: #f3f4f6; margin: 1.25rem 0; }
        .req { color: #ef4444; }

        /* ── Radio / Checkbox Pills ── */
        .pill-group { display: flex; flex-wrap: wrap; gap: .4rem; }
        .pill-opt   { position: relative; cursor: pointer; }
        .pill-opt input { position: absolute; opacity: 0; width: 0; height: 0; }
        .pill-opt span  { display: inline-flex; align-items: center; padding: .38rem .85rem; border-radius: .5rem;
                          border: 1px solid #e5e7eb; background: #f9fafb; font-size: .8rem; font-weight: 600;
                          color: #374151; transition: all .15s; user-select: none; }
        .pill-opt input:checked + span { background: rgba(128,0,0,.07); border-color: rgba(128,0,0,.35); color: #800000; }
        .pill-opt span:hover { border-color: rgba(128,0,0,.25); background: rgba(128,0,0,.04); }

        /* ── Photo Upload ── */
        .photo-zone { border: 2px dashed #e5e7eb; border-radius: .875rem; cursor: pointer; text-align: center;
                      transition: border-color .15s, background .15s; display: flex; flex-direction: column;
                      align-items: center; justify-content: center; gap: .6rem; min-height: 200px; padding: 1.5rem; }
        .photo-zone:hover { border-color: rgba(128,0,0,.35); background: rgba(128,0,0,.02); }

        /* ── File Upload Zones ── */
        .upload-zone { display: block; border: 2px dashed #e5e7eb; border-radius: .875rem; cursor: pointer;
                       padding: 1.25rem; text-align: center; transition: border-color .15s, background .15s; }
        .upload-zone:hover { border-color: rgba(128,0,0,.3); background: rgba(128,0,0,.02); }
        .upload-zone.has-file { border-color: rgba(4,120,87,.4); background: rgba(4,120,87,.03); border-style: solid; }

        /* ── Buttons ── */
        .btn-primary { display: inline-flex; align-items: center; gap: .5rem; padding: .8rem 1.75rem; border-radius: .75rem;
                       font-weight: 700; font-size: .85rem; letter-spacing: .07em; text-transform: uppercase;
                       background: #800000; color: #fff; border: none; cursor: pointer;
                       box-shadow: 0 2px 8px rgba(128,0,0,.25); transition: transform .15s, box-shadow .15s, background .15s; }
        .btn-primary:hover { transform: translateY(-2px); background: #5a0000; box-shadow: 0 4px 16px rgba(128,0,0,.3); }
        .btn-back { display: inline-flex; align-items: center; gap: .5rem; padding: .8rem 1.5rem; border-radius: .75rem;
                    font-weight: 700; font-size: .85rem; letter-spacing: .07em; text-transform: uppercase;
                    color: #374151; border: 1px solid #d1d5db; background: #fff; cursor: pointer; text-decoration: none;
                    transition: background .15s, border-color .15s, transform .15s; }
        .btn-back:hover { background: #f3f4f6; border-color: #9ca3af; transform: translateY(-1px); }

        /* Form step visibility */
        .form-step { display: none; }
        .form-step.active { display: block; }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-thumb { background: rgba(128,0,0,.3); border-radius: 3px; }

        /* ── Review Step ── */
        .rv-section { margin-bottom: 1.5rem; }
        .rv-section-title { font-size:.65rem; font-weight:800; text-transform:uppercase; letter-spacing:.12em;
                            color:#800000; padding-bottom:.5rem; border-bottom:1px solid #f3f4f6; margin-bottom:.85rem; }
        .rv-grid { display:grid; gap:.8rem; }
        .rv-lbl  { font-size:.6rem; font-weight:700; text-transform:uppercase; letter-spacing:.07em; color:#9ca3af; display:block; margin-bottom:.15rem; }
        .rv-val  { font-size:.875rem; font-weight:600; color:#111827; word-break:break-word; }
        .rv-empty{ font-size:.875rem; color:#d1d5db; font-style:italic; }
        .rv-att-row { display:flex; align-items:center; gap:.6rem; padding:.55rem .75rem; border-radius:.625rem;
                      font-size:.8rem; font-weight:600; }
        .rv-att-ok  { background:rgba(4,120,87,.05); border:1px solid rgba(4,120,87,.2); color:#065f46; }
        .rv-att-miss{ background:rgba(239,68,68,.04); border:1px solid rgba(239,68,68,.15); color:#b91c1c; }
        .confirm-wrap { display:flex; align-items:flex-start; gap:.75rem; padding:1rem 1.25rem; border-radius:.875rem;
                        background:rgba(128,0,0,.03); border:1px solid rgba(128,0,0,.12); cursor:pointer; }
        .confirm-wrap input[type=checkbox] { accent-color:#800000; width:1rem; height:1rem; margin-top:.1rem; flex-shrink:0; }
    </style>
</head>
<body class="font-sans antialiased">

{{-- NAVBAR --}}
<nav class="nav-glass fixed top-0 inset-x-0 z-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-10 flex items-center justify-between h-16">
        <a href="{{ url('/') }}" class="flex items-center gap-3 no-underline">
            <img src="{{ asset('CCJE.png') }}" alt="CCJE Logo" class="h-9 w-auto shrink-0">
            <div class="leading-none">
                <span class="text-base font-black tracking-wider uppercase" style="color:#fff;">NROTC</span>
                <span class="text-sm font-bold tracking-wide text-slate-300"> · CSU Aparri</span>
                <p class="text-xs text-slate-400 mt-0.5 hidden lg:block">Enrollment Application Form</p>
            </div>
        </a>
        <a href="{{ route('enroll') }}" class="flex items-center gap-1.5 text-sm text-slate-300 hover:text-white transition-colors font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Requirements
        </a>
    </div>
</nav>

{{-- PAGE HEADER --}}
<div id="form-header" class="pt-24 pb-8 px-6 bg-white" style="border-bottom: 1px solid #f3f4f6;">
    <div class="max-w-3xl mx-auto text-center mb-7">
        <p class="section-eyebrow mb-2">CCJE ROTC · CSU Aparri</p>
        <h1 class="text-3xl font-black text-slate-900 mb-1">Enrollment <span style="color:#800000;">Application Form</span></h1>
        <p class="text-slate-500 text-sm max-w-md mx-auto">Complete all four sections. Your application will be reviewed by the ROTC office.</p>
    </div>

    {{-- Step Progress --}}
    <div class="max-w-lg mx-auto">
        <div class="step-track">
            @php $stepDefs = [
                ['n'=>1,'label'=>'Personal Info'],
                ['n'=>2,'label'=>'Family & Contact'],
                ['n'=>3,'label'=>'RIDS Form'],
                ['n'=>4,'label'=>'Attachments'],
                ['n'=>5,'label'=>'Review'],
            ]; @endphp
            @foreach ($stepDefs as $sd)
                <div class="step-node">
                    <div class="step-dot {{ $sd['n'] === 1 ? 'active' : '' }}" id="dot-{{ $sd['n'] }}">
                        <span id="dot-icon-{{ $sd['n'] }}">{{ $sd['n'] }}</span>
                    </div>
                    <span class="step-label {{ $sd['n'] === 1 ? 'active' : '' }}" id="lbl-{{ $sd['n'] }}">{{ $sd['label'] }}</span>
                </div>
                @if (!$loop->last)
                <div class="step-line" id="line-{{ $sd['n'] }}"></div>
                @endif
            @endforeach
        </div>
    </div>
</div>

{{-- FORM --}}
<main class="max-w-4xl mx-auto px-6 lg:px-10 py-8">

@if (session('success'))
<div class="mb-6 rounded-2xl p-5 flex items-start gap-3"
     style="background:rgba(4,120,87,.05); border:1px solid rgba(4,120,87,.2);">
    <svg class="w-5 h-5 mt-0.5 shrink-0" fill="none" stroke="#047857" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    <div>
        <p class="text-sm font-bold text-emerald-800">Application Submitted</p>
        <p class="text-sm text-emerald-700 mt-0.5">{{ session('success') }}</p>
    </div>
</div>
@endif
<form id="enroll-form" method="POST" action="{{ route('enroll.form.submit') }}" enctype="multipart/form-data">
@csrf

{{-- ══════════════════════════════════════════
     STEP 1 · Personal Information
══════════════════════════════════════════ --}}
<div class="form-step active" id="step-1">

    <div class="form-card mb-6">
        <div class="card-header" style="background:rgba(128,0,0,.02);">
            <div class="card-icon" style="background:rgba(128,0,0,.07);border:1px solid rgba(128,0,0,.15);">
                <svg class="w-5 h-5" fill="none" stroke="#800000" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <span class="text-xs font-black uppercase tracking-widest" style="color:#800000;">Page 1 · Section A</span>
                <h2 class="text-lg font-black text-slate-900">Personal Information</h2>
            </div>
        </div>

        <div class="p-6 lg:p-8">
            <div class="grid lg:grid-cols-3 gap-8">

                {{-- Fields --}}
                <div class="lg:col-span-2 flex flex-col gap-5">

                    {{-- Name --}}
                    <div>
                        <p class="lbl mb-3">Full Name</p>
                        <div class="grid grid-cols-3 gap-3">
                            <div class="fl"><label class="lbl" for="last_name">Last Name <span class="req">*</span></label>
                                <input id="last_name" name="last_name" type="text" class="inp" placeholder="dela Cruz" required></div>
                            <div class="fl"><label class="lbl" for="first_name">First Name <span class="req">*</span></label>
                                <input id="first_name" name="first_name" type="text" class="inp" placeholder="Juan" required></div>
                            <div class="fl"><label class="lbl" for="middle_name">Middle Name</label>
                                <input id="middle_name" name="middle_name" type="text" class="inp" placeholder="Santos"></div>
                        </div>
                    </div>

                    <hr class="divider">

                    {{-- DOB / Age / Gender --}}
                    <div class="grid grid-cols-3 gap-3">
                        <div class="fl"><label class="lbl" for="dob">Date of Birth <span class="req">*</span></label>
                            <input id="dob" name="date_of_birth" type="date" class="inp" required></div>
                        <div class="fl"><label class="lbl" for="age">Age <span class="req">*</span></label>
                            <input id="age" name="age" type="number" min="15" max="35" class="inp" placeholder="Auto-calculated" readonly required style="background:#f3f4f6;cursor:default;color:#6b7280;"></div>
                        <div class="fl"><label class="lbl" for="gender">Gender <span class="req">*</span></label>
                            <select id="gender" name="gender" class="inp" required>
                                <option value="" disabled selected>Select</option>
                                <option>Male</option><option>Female</option>
                            </select>
                        </div>
                    </div>

                    {{-- Course / Religion / Blood Type --}}
                    <div class="grid grid-cols-3 gap-3">
                        <div class="fl"><label class="lbl" for="course">Course / Year <span class="req">*</span></label>
                            <input id="course" name="course_year" type="text" class="inp" placeholder="BSCrim 2" required></div>
                        <div class="fl"><label class="lbl" for="religion">Religion</label>
                            <input id="religion" name="religion" type="text" class="inp" placeholder="Roman Catholic"></div>
                        <div class="fl"><label class="lbl" for="blood_type">Blood Type</label>
                            <select id="blood_type" name="blood_type" class="inp">
                                <option value="" disabled selected>Select</option>
                                @foreach (['A+','A−','B+','B−','AB+','AB−','O+','O−'] as $bt)
                                    <option>{{ $bt }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <hr class="divider">

                    {{-- Address --}}
                    <div>
                        <p class="lbl mb-3">Current Address</p>
                        <div class="flex flex-col gap-3">
                            <div class="fl"><label class="lbl" for="street">Street / House No. <span class="req">*</span></label>
                                <input id="street" name="street" type="text" class="inp" placeholder="House/Unit No. and Street Name" required></div>
                            <div class="grid grid-cols-3 gap-3">
                                <div class="fl"><label class="lbl" for="barangay">Barangay <span class="req">*</span></label>
                                    <input id="barangay" name="barangay" type="text" class="inp" placeholder="Barangay" required></div>
                                <div class="fl"><label class="lbl" for="town_city">Town / City <span class="req">*</span></label>
                                    <input id="town_city" name="town_city" type="text" class="inp" placeholder="Town or City" required></div>
                                <div class="fl"><label class="lbl" for="province">Province <span class="req">*</span></label>
                                    <input id="province" name="province" type="text" class="inp" placeholder="Province" required></div>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Photo Upload --}}
                <div class="flex flex-col gap-3">
                    <label class="lbl">2×2 ID Photo <span class="req">*</span></label>
                    <label for="photo_upload" class="photo-zone">
                        <div id="photo-preview-wrap" class="hidden w-full">
                            <img id="photo-preview" src="#" alt="Preview" class="w-full rounded-lg object-cover" style="max-height:190px;">
                        </div>
                        <div id="photo-placeholder" class="flex flex-col items-center gap-2">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center"
                                 style="background:rgba(128,0,0,.06);border:1px solid rgba(128,0,0,.12);">
                                <svg class="w-6 h-6" fill="none" stroke="#800000" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <p class="text-xs font-bold text-slate-700">Click to Upload Photo</p>
                            <p class="text-xs text-slate-400 leading-relaxed text-center">2×2 colored · White background</p>
                        </div>
                        <input id="photo_upload" name="photo" type="file" accept="image/*" class="sr-only">
                    </label>
                    <div class="rounded-xl p-3" style="background:rgba(128,0,0,.03);border:1px solid rgba(128,0,0,.1);">
                        <p class="text-xs font-bold mb-1" style="color:#800000;">Photo Requirements</p>
                        @foreach (['Colored, white background','Recent (within 3 months)','Male: military haircut','Female: hair neatly tied'] as $r)
                        <div class="flex items-center gap-1.5 mb-0.5">
                            <svg class="w-2.5 h-2.5 shrink-0" fill="none" stroke="#047857" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-xs text-slate-600">{{ $r }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>{{-- /step-1 --}}


{{-- ══════════════════════════════════════════
     STEP 2 · Family & Emergency Contact
══════════════════════════════════════════ --}}
<div class="form-step" id="step-2">

    <div class="form-card mb-6">
        <div class="card-header" style="background:rgba(29,78,216,.02);">
            <div class="card-icon" style="background:rgba(29,78,216,.07);border:1px solid rgba(29,78,216,.15);">
                <svg class="w-5 h-5" fill="none" stroke="#1d4ed8" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <div>
                <span class="text-xs font-black uppercase tracking-widest" style="color:#1d4ed8;">Page 1 · Section B</span>
                <h2 class="text-lg font-black text-slate-900">Family & Emergency Contact Details</h2>
            </div>
        </div>

        <div class="p-6 lg:p-8 flex flex-col gap-6">

            {{-- Father --}}
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <span class="w-5 h-5 rounded-md flex items-center justify-center shrink-0 text-xs font-black"
                          style="background:rgba(29,78,216,.07);border:1px solid rgba(29,78,216,.15);color:#1d4ed8;">F</span>
                    <p class="lbl">Father</p>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="fl"><label class="lbl" for="father_name">Full Name</label>
                        <input id="father_name" name="father_name" type="text" class="inp" placeholder="Last Name, First Name, M.I."></div>
                    <div class="fl"><label class="lbl" for="father_occ">Occupation</label>
                        <input id="father_occ" name="father_occupation" type="text" class="inp" placeholder="e.g. Farmer, Gov't Employee"></div>
                </div>
            </div>

            {{-- Mother --}}
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <span class="w-5 h-5 rounded-md flex items-center justify-center shrink-0 text-xs font-black"
                          style="background:rgba(190,24,93,.07);border:1px solid rgba(190,24,93,.15);color:#be185d;">M</span>
                    <p class="lbl">Mother</p>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="fl"><label class="lbl" for="mother_name">Full Name</label>
                        <input id="mother_name" name="mother_name" type="text" class="inp" placeholder="Last Name, First Name, M.I."></div>
                    <div class="fl"><label class="lbl" for="mother_occ">Occupation</label>
                        <input id="mother_occ" name="mother_occupation" type="text" class="inp" placeholder="e.g. Teacher, Housewife"></div>
                </div>
            </div>

            {{-- Parents' Contact --}}
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <span class="w-5 h-5 rounded-md flex items-center justify-center shrink-0"
                          style="background:rgba(4,120,87,.07);border:1px solid rgba(4,120,87,.15);">
                        <svg class="w-3 h-3" fill="none" stroke="#047857" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </span>
                    <p class="lbl">Parents' Contact</p>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="fl"><label class="lbl" for="parents_addr">Address</label>
                        <input id="parents_addr" name="parents_address" type="text" class="inp" placeholder="Street, Barangay, Town, Province"></div>
                    <div class="fl"><label class="lbl" for="parents_tel">Tel / CP No.</label>
                        <input id="parents_tel" name="parents_contact" type="text" class="inp" placeholder="09XX-XXX-XXXX"></div>
                </div>
            </div>

            <div class="rounded-xl p-4 flex items-start gap-3"
                 style="background:rgba(239,68,68,.04);border:1px solid rgba(239,68,68,.15);">
                <svg class="w-4 h-4 mt-0.5 shrink-0" fill="none" stroke="#b91c1c" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                <p class="text-xs text-red-800 leading-relaxed">
                    <strong>Emergency Contact</strong> — person to be notified immediately in case of
                    injury or emergency during training when parents are unavailable.
                </p>
            </div>

            {{-- Emergency Contact --}}
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <span class="w-5 h-5 rounded-md flex items-center justify-center shrink-0"
                          style="background:rgba(239,68,68,.07);border:1px solid rgba(239,68,68,.15);">
                        <svg class="w-3 h-3" fill="none" stroke="#b91c1c" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </span>
                    <p class="lbl">In Case of Emergency <span class="req">*</span></p>
                </div>
                <div class="grid grid-cols-2 gap-3 mb-3">
                    <div class="fl"><label class="lbl" for="emer_name">Contact Person <span class="req">*</span></label>
                        <input id="emer_name" name="emergency_name" type="text" class="inp" placeholder="Last Name, First Name" required></div>
                    <div class="fl"><label class="lbl" for="emer_rel">Relationship <span class="req">*</span></label>
                        <input id="emer_rel" name="emergency_relationship" type="text" class="inp" placeholder="e.g. Parent, Sibling, Guardian" required></div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="fl"><label class="lbl" for="emer_addr">Address</label>
                        <input id="emer_addr" name="emergency_address" type="text" class="inp" placeholder="Street, Barangay, Town, Province"></div>
                    <div class="fl"><label class="lbl" for="emer_tel">Tel / CP No. <span class="req">*</span></label>
                        <input id="emer_tel" name="emergency_contact" type="text" class="inp" placeholder="09XX-XXX-XXXX" required></div>
                </div>
            </div>

        </div>
    </div>

</div>{{-- /step-2 --}}


{{-- ══════════════════════════════════════════
     STEP 3 · RIDS Form
══════════════════════════════════════════ --}}
<div class="form-step" id="step-3">

    {{-- Personal & Contact Info --}}
    <div class="form-card mb-5">
        <div class="card-header" style="background:rgba(4,120,87,.02);">
            <div class="card-icon" style="background:rgba(4,120,87,.07);border:1px solid rgba(4,120,87,.15);">
                <svg class="w-5 h-5" fill="none" stroke="#047857" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <div>
                <span class="text-xs font-black uppercase tracking-widest" style="color:#047857;">Page 2</span>
                <h2 class="text-lg font-black text-slate-900">RIDS Form — Personal & Contact Details</h2>
            </div>
        </div>

        <div class="p-6 lg:p-8 flex flex-col gap-5">

            <div class="grid grid-cols-2 gap-3">
                <div class="fl"><label class="lbl" for="region">Region <span class="req">*</span></label>
                    <input id="region" name="region" type="text" class="inp" placeholder="e.g. Region II - Cagayan Valley" required></div>
                <div class="fl"><label class="lbl" for="special_skill">Special Skill</label>
                    <input id="special_skill" name="special_skill" type="text" class="inp" placeholder="e.g. First Aid, Marksmanship"></div>
            </div>

            <div class="fl"><label class="lbl" for="home_address">Home Address <span class="req">*</span></label>
                <input id="home_address" name="home_address" type="text" class="inp" placeholder="Complete home address" required></div>

            <div class="grid grid-cols-3 gap-3">
                <div class="fl"><label class="lbl" for="tel_nr">Tel No.</label>
                    <input id="tel_nr" name="tel_nr" type="text" class="inp" placeholder="(02) XXX-XXXX"></div>
                <div class="fl"><label class="lbl" for="cp_nr">Cellphone No. <span class="req">*</span></label>
                    <input id="cp_nr" name="cp_nr" type="text" class="inp" placeholder="09XX-XXX-XXXX" required></div>
                <div class="fl"><label class="lbl" for="email">Email Address <span class="req">*</span></label>
                    <input id="email" name="email" type="email" class="inp" placeholder="you@example.com" required></div>
            </div>

            <hr class="divider">

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <p class="lbl mb-2">Gender <span class="req">*</span></p>
                    <div class="pill-group">
                        @foreach (['Male','Female'] as $g)
                        <label class="pill-opt"><input type="radio" name="rids_gender" value="{{ $g }}" required><span>{{ $g }}</span></label>
                        @endforeach
                    </div>
                </div>
                <div>
                    <p class="lbl mb-2">Marital Status <span class="req">*</span></p>
                    <div class="pill-group">
                        @foreach (['Single','Married','Widow','Widower'] as $ms)
                        <label class="pill-opt"><input type="radio" name="marital_status" value="{{ $ms }}" required><span>{{ $ms }}</span></label>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <p class="lbl mb-2">Date of Birth <span class="req">*</span></p>
                    <div class="grid grid-cols-3 gap-2">
                        <div class="fl"><label class="lbl" for="rids_day">Day</label>
                            <input id="rids_day" name="rids_dob_day" type="number" min="1" max="31" class="inp" placeholder="DD"></div>
                        <div class="fl"><label class="lbl" for="rids_month">Month</label>
                            <select id="rids_month" name="rids_dob_month" class="inp">
                                <option value="" disabled selected>Month</option>
                                @php $months=['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']; @endphp
                                @foreach($months as $i=>$m)<option value="{{ $i+1 }}">{{ $m }}</option>@endforeach
                            </select>
                        </div>
                        <div class="fl"><label class="lbl" for="rids_year">Year</label>
                            <input id="rids_year" name="rids_dob_year" type="number" min="1970" max="{{ date('Y')-15 }}" class="inp" placeholder="YYYY"></div>
                    </div>
                </div>
                <div class="fl"><label class="lbl" for="place_of_birth">Place of Birth <span class="req">*</span></label>
                    <input id="place_of_birth" name="place_of_birth" type="text" class="inp" placeholder="City/Municipality, Province" required></div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div class="fl"><label class="lbl" for="rids_religion">Religion</label>
                    <input id="rids_religion" name="rids_religion" type="text" class="inp" placeholder="e.g. Roman Catholic"></div>
                <div class="fl"><label class="lbl" for="dialect">Dialect</label>
                    <input id="dialect" name="dialect" type="text" class="inp" placeholder="e.g. Ilocano, Tagalog"></div>
            </div>

        </div>
    </div>

    {{-- Physical Attributes --}}
    <div class="form-card mb-5">
        <div class="card-header" style="background:rgba(190,24,93,.02);">
            <div class="card-icon" style="background:rgba(190,24,93,.07);border:1px solid rgba(190,24,93,.15);">
                <svg class="w-5 h-5" fill="none" stroke="#be185d" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            </div>
            <div>
                <span class="text-xs font-black uppercase tracking-widest" style="color:#be185d;">RIDS · Section B</span>
                <h2 class="text-lg font-black text-slate-900">Physical Attributes</h2>
            </div>
        </div>

        <div class="p-6 lg:p-8 flex flex-col gap-5">

            <div>
                <p class="lbl mb-2">Blood Type</p>
                <div class="pill-group">
                    @foreach (['O','A','AB','A+','B+','Other'] as $bt)
                    <label class="pill-opt"><input type="checkbox" name="rids_blood_type[]" value="{{ $bt }}"{{ $bt === 'Other' ? ' id="bt_other_cb"' : '' }}><span>{{ $bt }}</span></label>
                    @endforeach
                </div>
                <div id="blood-other-wrap" class="hidden mt-2">
                    <input id="blood_type_other" name="blood_type_other" type="text" class="inp" placeholder="Please specify blood type...">
                </div>
            </div>

            <div class="grid grid-cols-3 gap-3">
                <div class="fl"><label class="lbl" for="height">Height (Feet)</label>
                    <input id="height" name="height" type="text" class="inp" placeholder="e.g. 5'6\""></div>
                <div class="fl"><label class="lbl" for="weight">Weight (Kgs)</label>
                    <input id="weight" name="weight" type="number" class="inp" placeholder="e.g. 70"></div>
                <div class="fl"><label class="lbl" for="identify_mark">Identifying Mark</label>
                    <input id="identify_mark" name="identifying_mark" type="text" class="inp" placeholder="e.g. Mole, Scar, Birthmark"></div>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <p class="lbl mb-2">Eye Color</p>
                    <div class="pill-group">
                        @foreach (['Black','Brown','Blue'] as $ec)
                        <label class="pill-opt"><input type="radio" name="eye_color" value="{{ $ec }}"><span>{{ $ec }}</span></label>
                        @endforeach
                    </div>
                </div>
                <div>
                    <p class="lbl mb-2">Hair Color</p>
                    <div class="pill-group">
                        @foreach (['Black','White'] as $hc)
                        <label class="pill-opt"><input type="radio" name="hair_color" value="{{ $hc }}"><span>{{ $hc }}</span></label>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Uniform Measurements --}}
    <div class="form-card mb-6">
        <div class="card-header" style="background:rgba(146,64,14,.02);">
            <div class="card-icon" style="background:rgba(146,64,14,.07);border:1px solid rgba(251,191,36,.2);">
                <svg class="w-5 h-5" fill="none" stroke="#92400e" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
            </div>
            <div>
                <span class="text-xs font-black uppercase tracking-widest" style="color:#92400e;">RIDS · Section C</span>
                <h2 class="text-lg font-black text-slate-900">Uniform Measurements</h2>
            </div>
        </div>

        <div class="p-6 lg:p-8 flex flex-col gap-5">

            <div>
                <p class="lbl mb-2">Combat Size</p>
                <div class="pill-group">
                    @foreach (['6"','7"','8"','9"','10"','Other'] as $cs)
                    <label class="pill-opt"><input type="radio" name="combat_size" value="{{ $cs }}"><span>{{ $cs }}</span></label>
                    @endforeach
                </div>
                <div id="combat-other-wrap" class="hidden mt-2">
                    <input id="combat_size_other" name="combat_size_other" type="text" class="inp" placeholder="Please specify combat size...">
                </div>
            </div>

            <div>
                <p class="lbl mb-2">Cap Size</p>
                <div class="pill-group">
                    @foreach (['21"','22"','23"','24"'] as $cap)
                    <label class="pill-opt"><input type="radio" name="cap_size" value="{{ $cap }}"><span>{{ $cap }}</span></label>
                    @endforeach
                </div>
            </div>

            <div>
                <p class="lbl mb-2">BDU Size</p>
                <div class="pill-group">
                    @foreach (['Small','Medium','Large','Extra Large'] as $bdu)
                    <label class="pill-opt"><input type="radio" name="bdu_size" value="{{ $bdu }}"><span>{{ $bdu }}</span></label>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    {{-- RIDS Certification — Thumb Marks --}}
    <div class="form-card mb-6">
        <div class="card-header" style="background:rgba(79,70,229,.02);">
            <div class="card-icon" style="background:rgba(79,70,229,.07);border:1px solid rgba(79,70,229,.15);">
                <svg class="w-5 h-5" fill="none" stroke="#4f46e5" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"/>
                </svg>
            </div>
            <div>
                <span class="text-xs font-black uppercase tracking-widest" style="color:#4f46e5;">RIDS · Section D</span>
                <h2 class="text-lg font-black text-slate-900">Certification — Thumb Marks</h2>
            </div>
        </div>

        <div class="p-6 lg:p-8">
            <div class="rounded-xl p-4 flex items-start gap-3 mb-6"
                 style="background:rgba(79,70,229,.04);border:1px solid rgba(79,70,229,.15);">
                <svg class="w-4 h-4 mt-0.5 shrink-0" fill="none" stroke="#4f46e5" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-xs text-indigo-800 leading-relaxed">
                    Since no fingerprint scanner is available, upload a <strong>clear photo or scanned image</strong> of each thumb mark
                    pressed on plain white paper using inkpad or pen ink. Ensure the print is clear and fully visible.
                    Accepted formats: <strong>JPG, PNG</strong> · Max size: <strong>2MB per file</strong>.
                </p>
            </div>

            <div class="grid grid-cols-2 gap-6">

                {{-- Left Thumb --}}
                <div class="flex flex-col gap-3">
                    <label class="lbl">Left Thumb Mark <span class="req">*</span></label>
                    <label for="thumb_left" class="photo-zone" id="zone-thumb_left" style="min-height:180px;">
                        <div id="preview-wrap-thumb_left" class="hidden w-full">
                            <img id="preview-thumb_left" src="#" alt="Left Thumb" class="w-full rounded-lg object-contain"
                                 style="max-height:160px; background:#f9fafb;">
                        </div>
                        <div id="placeholder-thumb_left" class="flex flex-col items-center gap-2">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center"
                                 style="background:rgba(79,70,229,.07);border:1px solid rgba(79,70,229,.2);">
                                <svg class="w-6 h-6" fill="none" stroke="#4f46e5" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"/>
                                </svg>
                            </div>
                            <p class="text-xs font-bold text-slate-700">Upload Left Thumb Mark</p>
                            <p class="text-xs text-slate-400">Click to select image</p>
                        </div>
                        <input id="thumb_left" name="thumb_left" type="file" accept="image/*" class="sr-only" required>
                    </label>
                    <p class="text-xs text-center text-slate-400 font-semibold uppercase tracking-widest">Left</p>
                </div>

                {{-- Right Thumb --}}
                <div class="flex flex-col gap-3">
                    <label class="lbl">Right Thumb Mark <span class="req">*</span></label>
                    <label for="thumb_right" class="photo-zone" id="zone-thumb_right" style="min-height:180px;">
                        <div id="preview-wrap-thumb_right" class="hidden w-full">
                            <img id="preview-thumb_right" src="#" alt="Right Thumb" class="w-full rounded-lg object-contain"
                                 style="max-height:160px; background:#f9fafb;">
                        </div>
                        <div id="placeholder-thumb_right" class="flex flex-col items-center gap-2">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center"
                                 style="background:rgba(79,70,229,.07);border:1px solid rgba(79,70,229,.2);">
                                <svg class="w-6 h-6" fill="none" stroke="#4f46e5" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"/>
                                </svg>
                            </div>
                            <p class="text-xs font-bold text-slate-700">Upload Right Thumb Mark</p>
                            <p class="text-xs text-slate-400">Click to select image</p>
                        </div>
                        <input id="thumb_right" name="thumb_right" type="file" accept="image/*" class="sr-only" required>
                    </label>
                    <p class="text-xs text-center text-slate-400 font-semibold uppercase tracking-widest">Right</p>
                </div>

            </div>
        </div>
    </div>

</div>{{-- /step-3 --}}


{{-- ══════════════════════════════════════════
     STEP 4 · Attachments
══════════════════════════════════════════ --}}
<div class="form-step" id="step-4">

    <div class="form-card mb-6">
        <div class="card-header" style="background:rgba(6,95,70,.02);">
            <div class="card-icon" style="background:rgba(6,95,70,.07);border:1px solid rgba(6,95,70,.15);">
                <svg class="w-5 h-5" fill="none" stroke="#065f46" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                </svg>
            </div>
            <div>
                <span class="text-xs font-black uppercase tracking-widest" style="color:#065f46;">Step 3 of Process</span>
                <h2 class="text-lg font-black text-slate-900">Upload Required Attachments</h2>
            </div>
        </div>

        <div class="p-6 lg:p-8">
            <p class="text-sm text-slate-600 mb-6 leading-relaxed">
                Upload scanned copies or clear photos of each document below.
                Accepted formats: <strong>PDF, JPG, PNG</strong> · Max size: <strong>5MB per file</strong>.
                Bring the originals to the ROTC office for final verification.
            </p>

            <div class="grid sm:grid-cols-2 gap-4">

                @php $attachments = [
                    ['id'=>'att_assessment',   'name'=>'file_assessment',    'label'=>'Assessment Form',           'note'=>'Issued by the CSU Registrar',                         'req'=>true,  'color'=>'#800000',  'bg'=>'rgba(128,0,0,.05)',  'border'=>'rgba(128,0,0,.2)'],
                    ['id'=>'att_medical',      'name'=>'file_medical',       'label'=>'Medical Certificate',       'note'=>'From the campus clinic or accredited hospital',        'req'=>true,  'color'=>'#1d4ed8',  'bg'=>'rgba(29,78,216,.05)','border'=>'rgba(29,78,216,.2)'],
                    ['id'=>'att_consent',      'name'=>'file_consent',       'label'=>'Parental Consent / Waiver', 'note'=>'Signed parent or guardian consent form',               'req'=>true,  'color'=>'#be185d',  'bg'=>'rgba(190,24,93,.05)','border'=>'rgba(190,24,93,.2)'],
                    ['id'=>'att_photos',       'name'=>'file_id_photos',     'label'=>'2×2 ID Photos',             'note'=>'Colored, white background, military haircut (male)',   'req'=>true,  'color'=>'#047857',  'bg'=>'rgba(4,120,87,.05)', 'border'=>'rgba(4,120,87,.2)'],
                    ['id'=>'att_school_id',    'name'=>'file_school_id',     'label'=>'School ID',                 'note'=>'Current semester school ID — both sides',              'req'=>true,  'color'=>'#92400e',  'bg'=>'rgba(146,64,14,.05)','border'=>'rgba(251,191,36,.2)'],
                ]; @endphp

                @foreach ($attachments as $att)
                <div class="flex flex-col gap-2">
                    <div class="flex items-center gap-2">
                        <p class="lbl">{{ $att['label'] }} @if($att['req'])<span class="req">*</span>@endif</p>
                    </div>
                    <label for="{{ $att['id'] }}" class="upload-zone" id="zone-{{ $att['id'] }}"
                           style="border-color:{{ $att['border'] }}; background:{{ $att['bg'] }};">
                        <div id="placeholder-{{ $att['id'] }}" class="flex flex-col items-center gap-2">
                            <div class="w-9 h-9 rounded-xl flex items-center justify-center"
                                 style="background:#fff;border:1px solid {{ $att['border'] }};">
                                <svg class="w-4 h-4" fill="none" stroke="{{ $att['color'] }}" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                            </div>
                            <p class="text-xs font-bold text-slate-700">Click to Upload</p>
                            <p class="text-xs text-slate-400">{{ $att['note'] }}</p>
                        </div>
                        <div id="done-{{ $att['id'] }}" class="hidden flex items-center gap-2 justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="#047857" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-xs font-bold text-emerald-700" id="fname-{{ $att['id'] }}"></span>
                        </div>
                        <input id="{{ $att['id'] }}" name="{{ $att['name'] }}" type="file"
                               accept=".pdf,.jpg,.jpeg,.png" class="sr-only"
                               {{ $att['req'] ? 'required' : '' }}>
                    </label>
                </div>
                @endforeach

            </div>

            <div class="mt-6 rounded-xl p-4 flex items-start gap-3"
                 style="background:rgba(251,191,36,.05);border:1px solid rgba(251,191,36,.25);">
                <svg class="w-4 h-4 mt-0.5 shrink-0" fill="none" stroke="#92400e" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-xs text-yellow-800 leading-relaxed">
                    Digital submissions are preliminary. You must visit the ROTC office with <strong>original documents</strong>
                    for final verification before your account can be created.
                </p>
            </div>
        </div>
    </div>

</div>{{-- /step-4 --}}


{{-- ══════════════════════════════════════════
     STEP 5 · Review & Confirm
══════════════════════════════════════════ --}}
<div class="form-step" id="step-5">

    {{-- Alert banner --}}
    <div class="rounded-2xl p-4 flex items-start gap-3 mb-5"
         style="background:rgba(29,78,216,.04);border:1px solid rgba(29,78,216,.15);">
        <svg class="w-4 h-4 mt-0.5 shrink-0" fill="none" stroke="#1d4ed8" stroke-width="1.8" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <p class="text-sm text-blue-800 leading-relaxed">
            <strong>Review your application carefully.</strong> Once submitted, changes can only be made in person at the ROTC office.
            Click <strong>Back</strong> on any step to correct information before submitting.
        </p>
    </div>

    <div class="form-card mb-5">
        <div class="card-header" style="background:rgba(128,0,0,.02);">
            <div class="card-icon" style="background:rgba(128,0,0,.07);border:1px solid rgba(128,0,0,.15);">
                <svg class="w-5 h-5" fill="none" stroke="#800000" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <span class="text-xs font-black uppercase tracking-widest" style="color:#800000;">Page 1 · Section A</span>
                <h2 class="text-lg font-black text-slate-900">Personal Information</h2>
            </div>
        </div>
        <div class="p-6 lg:p-8">
            <div class="grid lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 flex flex-col gap-4">
                    <div class="rv-section">
                        <p class="rv-section-title">Full Name</p>
                        <div class="rv-grid" style="grid-template-columns:repeat(3,1fr);">
                            <div><span class="rv-lbl">Last Name</span><span class="rv-val rv-empty" id="rv-last_name">—</span></div>
                            <div><span class="rv-lbl">First Name</span><span class="rv-val rv-empty" id="rv-first_name">—</span></div>
                            <div><span class="rv-lbl">Middle Name</span><span class="rv-val rv-empty" id="rv-middle_name">—</span></div>
                        </div>
                    </div>
                    <div class="rv-section">
                        <p class="rv-section-title">Personal Details</p>
                        <div class="rv-grid" style="grid-template-columns:repeat(3,1fr);">
                            <div><span class="rv-lbl">Date of Birth</span><span class="rv-val rv-empty" id="rv-dob">—</span></div>
                            <div><span class="rv-lbl">Age</span><span class="rv-val rv-empty" id="rv-age">—</span></div>
                            <div><span class="rv-lbl">Gender</span><span class="rv-val rv-empty" id="rv-gender">—</span></div>
                            <div><span class="rv-lbl">Course / Year</span><span class="rv-val rv-empty" id="rv-course">—</span></div>
                            <div><span class="rv-lbl">Religion</span><span class="rv-val rv-empty" id="rv-religion">—</span></div>
                            <div><span class="rv-lbl">Blood Type</span><span class="rv-val rv-empty" id="rv-blood_type">—</span></div>
                        </div>
                    </div>
                    <div class="rv-section mb-0">
                        <p class="rv-section-title">Address</p>
                        <div class="rv-grid" style="grid-template-columns:1fr;">
                            <div><span class="rv-lbl">Street / House No.</span><span class="rv-val rv-empty" id="rv-street">—</span></div>
                        </div>
                        <div class="rv-grid mt-2" style="grid-template-columns:repeat(3,1fr);">
                            <div><span class="rv-lbl">Barangay</span><span class="rv-val rv-empty" id="rv-barangay">—</span></div>
                            <div><span class="rv-lbl">Town / City</span><span class="rv-val rv-empty" id="rv-town_city">—</span></div>
                            <div><span class="rv-lbl">Province</span><span class="rv-val rv-empty" id="rv-province">—</span></div>
                        </div>
                    </div>
                </div>
                {{-- Photo preview --}}
                <div class="flex flex-col items-center gap-2">
                    <span class="rv-lbl">ID Photo</span>
                    <div id="rv-photo-wrap" class="hidden w-full">
                        <img id="rv-photo" src="#" alt="ID Photo" class="rounded-xl w-full object-cover" style="max-height:180px;border:1px solid #e5e7eb;">
                    </div>
                    <div id="rv-photo-placeholder" class="w-full rounded-xl flex items-center justify-center"
                         style="height:140px;background:#f9fafb;border:1px dashed #e5e7eb;">
                        <span class="text-xs text-slate-400">No photo uploaded</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-card mb-5">
        <div class="card-header" style="background:rgba(29,78,216,.02);">
            <div class="card-icon" style="background:rgba(29,78,216,.07);border:1px solid rgba(29,78,216,.15);">
                <svg class="w-5 h-5" fill="none" stroke="#1d4ed8" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <div>
                <span class="text-xs font-black uppercase tracking-widest" style="color:#1d4ed8;">Page 1 · Section B</span>
                <h2 class="text-lg font-black text-slate-900">Family & Emergency Contact</h2>
            </div>
        </div>
        <div class="p-6 lg:p-8 flex flex-col gap-4">
            <div class="rv-section">
                <p class="rv-section-title">Parents</p>
                <div class="rv-grid" style="grid-template-columns:repeat(2,1fr);">
                    <div><span class="rv-lbl">Father's Name</span><span class="rv-val rv-empty" id="rv-father_name">—</span></div>
                    <div><span class="rv-lbl">Occupation</span><span class="rv-val rv-empty" id="rv-father_occ">—</span></div>
                    <div><span class="rv-lbl">Mother's Name</span><span class="rv-val rv-empty" id="rv-mother_name">—</span></div>
                    <div><span class="rv-lbl">Occupation</span><span class="rv-val rv-empty" id="rv-mother_occ">—</span></div>
                </div>
            </div>
            <div class="rv-section">
                <p class="rv-section-title">Parents' Contact</p>
                <div class="rv-grid" style="grid-template-columns:repeat(2,1fr);">
                    <div><span class="rv-lbl">Address</span><span class="rv-val rv-empty" id="rv-parents_addr">—</span></div>
                    <div><span class="rv-lbl">Tel / CP No.</span><span class="rv-val rv-empty" id="rv-parents_tel">—</span></div>
                </div>
            </div>
            <div class="rv-section mb-0">
                <p class="rv-section-title">Emergency Contact</p>
                <div class="rv-grid" style="grid-template-columns:repeat(2,1fr);">
                    <div><span class="rv-lbl">Contact Person</span><span class="rv-val rv-empty" id="rv-emer_name">—</span></div>
                    <div><span class="rv-lbl">Relationship</span><span class="rv-val rv-empty" id="rv-emer_rel">—</span></div>
                    <div><span class="rv-lbl">Address</span><span class="rv-val rv-empty" id="rv-emer_addr">—</span></div>
                    <div><span class="rv-lbl">Tel / CP No.</span><span class="rv-val rv-empty" id="rv-emer_tel">—</span></div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-card mb-5">
        <div class="card-header" style="background:rgba(4,120,87,.02);">
            <div class="card-icon" style="background:rgba(4,120,87,.07);border:1px solid rgba(4,120,87,.15);">
                <svg class="w-5 h-5" fill="none" stroke="#047857" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <div>
                <span class="text-xs font-black uppercase tracking-widest" style="color:#047857;">Page 2</span>
                <h2 class="text-lg font-black text-slate-900">RIDS Form Summary</h2>
            </div>
        </div>
        <div class="p-6 lg:p-8 flex flex-col gap-4">
            <div class="rv-section">
                <p class="rv-section-title">Contact & Profile</p>
                <div class="rv-grid" style="grid-template-columns:repeat(2,1fr);">
                    <div><span class="rv-lbl">Region</span><span class="rv-val rv-empty" id="rv-region">—</span></div>
                    <div><span class="rv-lbl">Special Skill</span><span class="rv-val rv-empty" id="rv-special_skill">—</span></div>
                    <div><span class="rv-lbl">Home Address</span><span class="rv-val rv-empty" id="rv-home_address">—</span></div>
                    <div><span class="rv-lbl">Email</span><span class="rv-val rv-empty" id="rv-email">—</span></div>
                    <div><span class="rv-lbl">Cellphone No.</span><span class="rv-val rv-empty" id="rv-cp_nr">—</span></div>
                    <div><span class="rv-lbl">Tel No.</span><span class="rv-val rv-empty" id="rv-tel_nr">—</span></div>
                    <div><span class="rv-lbl">Gender</span><span class="rv-val rv-empty" id="rv-rids_gender">—</span></div>
                    <div><span class="rv-lbl">Marital Status</span><span class="rv-val rv-empty" id="rv-marital_status">—</span></div>
                    <div><span class="rv-lbl">Place of Birth</span><span class="rv-val rv-empty" id="rv-place_of_birth">—</span></div>
                    <div><span class="rv-lbl">Dialect</span><span class="rv-val rv-empty" id="rv-dialect">—</span></div>
                </div>
            </div>
            <div class="rv-section mb-0">
                <p class="rv-section-title">Physical & Uniform</p>
                <div class="rv-grid" style="grid-template-columns:repeat(3,1fr);">
                    <div><span class="rv-lbl">Height</span><span class="rv-val rv-empty" id="rv-height">—</span></div>
                    <div><span class="rv-lbl">Weight (kg)</span><span class="rv-val rv-empty" id="rv-weight">—</span></div>
                    <div><span class="rv-lbl">Identifying Mark</span><span class="rv-val rv-empty" id="rv-identifying_mark">—</span></div>
                    <div><span class="rv-lbl">Eye Color</span><span class="rv-val rv-empty" id="rv-eye_color">—</span></div>
                    <div><span class="rv-lbl">Hair Color</span><span class="rv-val rv-empty" id="rv-hair_color">—</span></div>
                    <div><span class="rv-lbl">BDU Size</span><span class="rv-val rv-empty" id="rv-bdu_size">—</span></div>
                    <div><span class="rv-lbl">Combat Size</span><span class="rv-val rv-empty" id="rv-combat_size">—</span></div>
                    <div><span class="rv-lbl">Cap Size</span><span class="rv-val rv-empty" id="rv-cap_size">—</span></div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-card mb-5">
        <div class="card-header" style="background:rgba(79,70,229,.02);">
            <div class="card-icon" style="background:rgba(79,70,229,.07);border:1px solid rgba(79,70,229,.15);">
                <svg class="w-5 h-5" fill="none" stroke="#4f46e5" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"/>
                </svg>
            </div>
            <div>
                <span class="text-xs font-black uppercase tracking-widest" style="color:#4f46e5;">RIDS · Section D</span>
                <h2 class="text-lg font-black text-slate-900">Certification — Thumb Marks</h2>
            </div>
        </div>
        <div class="p-6 lg:p-8">
            <div class="grid grid-cols-2 gap-8">
                <div class="flex flex-col items-center gap-2">
                    <span class="rv-lbl">Left Thumb Mark</span>
                    <div id="rv-thumb-left-wrap" class="hidden w-full">
                        <img id="rv-thumb-left" src="#" alt="Left Thumb" class="w-full rounded-xl object-contain"
                             style="max-height:150px;border:1px solid #e5e7eb;background:#f9fafb;">
                    </div>
                    <div id="rv-thumb-left-miss" class="w-full rounded-xl flex items-center justify-center"
                         style="height:110px;background:#f9fafb;border:1px dashed rgba(239,68,68,.3);">
                        <span class="text-xs text-red-400 font-semibold">Not uploaded</span>
                    </div>
                    <span class="text-xs text-slate-400 font-semibold uppercase tracking-widest">Left</span>
                </div>
                <div class="flex flex-col items-center gap-2">
                    <span class="rv-lbl">Right Thumb Mark</span>
                    <div id="rv-thumb-right-wrap" class="hidden w-full">
                        <img id="rv-thumb-right" src="#" alt="Right Thumb" class="w-full rounded-xl object-contain"
                             style="max-height:150px;border:1px solid #e5e7eb;background:#f9fafb;">
                    </div>
                    <div id="rv-thumb-right-miss" class="w-full rounded-xl flex items-center justify-center"
                         style="height:110px;background:#f9fafb;border:1px dashed rgba(239,68,68,.3);">
                        <span class="text-xs text-red-400 font-semibold">Not uploaded</span>
                    </div>
                    <span class="text-xs text-slate-400 font-semibold uppercase tracking-widest">Right</span>
                </div>
            </div>
        </div>
    </div>

    <div class="form-card mb-6">
        <div class="card-header" style="background:rgba(6,95,70,.02);">
            <div class="card-icon" style="background:rgba(6,95,70,.07);border:1px solid rgba(6,95,70,.15);">
                <svg class="w-5 h-5" fill="none" stroke="#065f46" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                </svg>
            </div>
            <div>
                <span class="text-xs font-black uppercase tracking-widest" style="color:#065f46;">Step 3 of Process</span>
                <h2 class="text-lg font-black text-slate-900">Attachments</h2>
            </div>
        </div>
        <div class="p-6 lg:p-8">
            <div class="flex flex-col gap-2" id="rv-attachments">
                {{-- populated by JS --}}
            </div>
        </div>
    </div>

    {{-- Confirmation checkbox --}}
    <label class="confirm-wrap mb-6" for="confirm_accurate">
        <input type="checkbox" id="confirm_accurate" name="confirmed" required>
        <span class="text-sm text-slate-700 leading-relaxed">
            <strong>I confirm</strong> that all information I have provided in this application is accurate, complete, and true to the best of my knowledge.
            I understand that providing false information may result in disqualification from the ROTC program.
        </span>
    </label>

</div>{{-- /step-5 --}}


{{-- ── Navigation Buttons ── --}}
<div class="flex flex-col sm:flex-row items-center justify-between gap-4 pb-4">
    <p class="text-xs text-slate-400 max-w-xs leading-relaxed text-center sm:text-left">
        <span class="req font-bold">*</span> Required fields. All information is kept confidential.
    </p>
    <div class="flex gap-3">
        <button type="button" id="btn-prev" onclick="prevStep()"
                class="btn-back" style="display:none;">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back
        </button>
        <button type="button" id="btn-next" onclick="nextStep()" class="btn-primary">
            Next Step
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 5l7 7-7 7"/>
            </svg>
        </button>
    </div>
</div>

</form>
</main>

{{-- FOOTER --}}
<footer style="background:#001f3f;border-top:1px solid #003366;">
    <div class="max-w-6xl mx-auto px-6 lg:px-10 py-8 flex flex-col sm:flex-row items-center justify-between gap-3">
        <div class="flex items-center gap-3">
            <img src="{{ asset('CCJE.png') }}" alt="Logo" class="h-7 w-auto">
            <p class="text-sm text-slate-400">&copy; {{ date('Y') }} CCrJE ROTC &mdash; Cagayan State University Aparri</p>
        </div>
        <p class="text-sm font-semibold tracking-wider" style="color:#fff;">Integrity &bull; Discipline &bull; Service</p>
    </div>
</footer>

<script>
var currentStep = 1;
var totalSteps  = 5;

function showStep(n) {
    document.querySelectorAll('.form-step').forEach(function(el) { el.classList.remove('active'); });
    document.getElementById('step-' + n).classList.add('active');
    for (var i = 1; i <= totalSteps; i++) {
        var dot  = document.getElementById('dot-'  + i);
        var lbl  = document.getElementById('lbl-'  + i);
        var icon = document.getElementById('dot-icon-' + i);
        dot.classList.remove('active','done');
        lbl.classList.remove('active','done');
        if (i < n)        { dot.classList.add('done');   lbl.classList.add('done');   icon.innerHTML = '&#10003;'; }
        else if (i === n) { dot.classList.add('active'); lbl.classList.add('active'); icon.textContent = i; }
        else              { icon.textContent = i; }
    }
    for (var j = 1; j < totalSteps; j++) {
        var line = document.getElementById('line-' + j);
        if (line) line.classList.toggle('done', j < n);
    }
    document.getElementById('btn-prev').style.display = n === 1 ? 'none' : '';
    var btnNext = document.getElementById('btn-next');
    if (n === totalSteps) {
        btnNext.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Submit Application';
    } else if (n === totalSteps - 1) {
        btnNext.innerHTML = 'Review Application <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>';
    } else {
        btnNext.innerHTML = 'Next Step <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 5l7 7-7 7"/></svg>';
    }
    var header = document.getElementById('form-header');
    if (header) window.scrollTo({ top: header.offsetTop - 80, behavior: 'smooth' });
}

function nextStep() {
    if (currentStep < totalSteps) {
        currentStep++;
        if (currentStep === totalSteps) populateReview();
        showStep(currentStep);
    } else {
        document.getElementById('enroll-form').submit();
    }
}

function prevStep() {
    if (currentStep > 1) { currentStep--; showStep(currentStep); }
}

function rv(id) {
    var el = document.getElementById(id);
    if (!el) return '';
    return (el.value || '').trim();
}
function radioVal(name) {
    var checked = document.querySelector('input[name="' + name + '"]:checked');
    return checked ? checked.value : '';
}

function setRv(id, val) {
    var el = document.getElementById('rv-' + id);
    if (!el) return;
    if (val) { el.textContent = val; el.classList.remove('rv-empty'); el.classList.add('rv-val'); }
    else     { el.textContent = '—'; el.classList.add('rv-empty'); }
}

function populateReview() {
    // Personal Info
    setRv('last_name',  rv('last_name'));
    setRv('first_name', rv('first_name'));
    setRv('middle_name',rv('middle_name'));
    setRv('dob',        rv('dob'));
    setRv('age',        rv('age') ? rv('age') + ' yrs' : '');
    setRv('gender',     rv('gender'));
    setRv('course',     rv('course'));
    setRv('religion',   rv('religion'));
    setRv('blood_type', rv('blood_type'));
    setRv('street',     rv('street'));
    setRv('barangay',   rv('barangay'));
    setRv('town_city',  rv('town_city'));
    setRv('province',   rv('province'));

    // Photo
    var photoSrc = document.getElementById('photo-preview').src;
    if (photoSrc && photoSrc !== window.location.href && photoSrc !== '#') {
        document.getElementById('rv-photo').src = photoSrc;
        document.getElementById('rv-photo-wrap').classList.remove('hidden');
        document.getElementById('rv-photo-placeholder').classList.add('hidden');
    }

    // Family
    setRv('father_name', rv('father_name'));
    setRv('father_occ',  rv('father_occ'));
    setRv('mother_name', rv('mother_name'));
    setRv('mother_occ',  rv('mother_occ'));
    setRv('parents_addr',rv('parents_addr'));
    setRv('parents_tel', rv('parents_tel'));
    setRv('emer_name',   rv('emer_name'));
    setRv('emer_rel',    rv('emer_rel'));
    setRv('emer_addr',   rv('emer_addr'));
    setRv('emer_tel',    rv('emer_tel'));

    // RIDS
    setRv('region',         rv('region'));
    setRv('special_skill',  rv('special_skill'));
    setRv('home_address',   rv('home_address'));
    setRv('email',          rv('email'));
    setRv('cp_nr',          rv('cp_nr'));
    setRv('tel_nr',         rv('tel_nr'));
    setRv('rids_gender',    radioVal('rids_gender'));
    setRv('marital_status', radioVal('marital_status'));
    setRv('place_of_birth', rv('place_of_birth'));
    setRv('dialect',        rv('dialect'));
    setRv('height',         rv('height'));
    setRv('weight',         rv('weight') ? rv('weight') + ' kg' : '');
    setRv('identifying_mark', rv('identify_mark'));
    setRv('eye_color',      radioVal('eye_color'));
    setRv('hair_color',     radioVal('hair_color'));
    setRv('combat_size',    radioVal('combat_size'));
    setRv('cap_size',       radioVal('cap_size'));
    setRv('bdu_size',       radioVal('bdu_size'));

    // Attachments
    var attDefs = [
        { id:'att_assessment', label:'Assessment Form' },
        { id:'att_medical',    label:'Medical Certificate' },
        { id:'att_consent',    label:'Parental Consent / Waiver' },
        { id:'att_photos',     label:'2×2 ID Photos' },
        { id:'att_school_id',  label:'School ID' },
    ];
    var container = document.getElementById('rv-attachments');
    container.innerHTML = '';
    attDefs.forEach(function(a) {
        var input = document.getElementById(a.id);
        var row = document.createElement('div');
        if (input && input.files && input.files[0]) {
            row.className = 'rv-att-row rv-att-ok';
            row.innerHTML = '<svg class="w-4 h-4 shrink-0" fill="none" stroke="#047857" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
                          + '<span><strong>' + a.label + ':</strong> ' + input.files[0].name + '</span>';
        } else {
            row.className = 'rv-att-row rv-att-miss';
            row.innerHTML = '<svg class="w-4 h-4 shrink-0" fill="none" stroke="#b91c1c" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>'
                          + '<span><strong>' + a.label + ':</strong> Not uploaded</span>';
        }
        container.appendChild(row);
    });
}

// Photo preview
(function () {
    var input = document.getElementById('photo_upload');
    if (!input) return;
    input.addEventListener('change', function () {
        var file = input.files[0]; if (!file) return;
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('photo-preview').src = e.target.result;
            document.getElementById('photo-preview-wrap').classList.remove('hidden');
            document.getElementById('photo-placeholder').classList.add('hidden');
        };
        reader.readAsDataURL(file);
    });
}());

// Thumb mark previews
['thumb_left','thumb_right'].forEach(function(id) {
    var input = document.getElementById(id);
    if (!input) return;
    input.addEventListener('change', function () {
        var file = input.files[0]; if (!file) return;
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('preview-' + id).src = e.target.result;
            document.getElementById('preview-wrap-' + id).classList.remove('hidden');
            document.getElementById('placeholder-' + id).classList.add('hidden');
        };
        reader.readAsDataURL(file);
    });
});

// Age auto-calc
(function () {
    var dob = document.getElementById('dob');
    var age = document.getElementById('age');
    if (!dob || !age) return;
    dob.addEventListener('change', function () {
        var d = new Date(dob.value); if (isNaN(d)) return;
        var today = new Date();
        var a = today.getFullYear() - d.getFullYear();
        if (today.getMonth() < d.getMonth() || (today.getMonth() === d.getMonth() && today.getDate() < d.getDate())) a--;
        age.value = a > 0 ? a : '';
    });
}());

// Attachment file feedback
(function () {
    var ids = ['att_assessment','att_medical','att_consent','att_photos','att_school_id'];
    ids.forEach(function(id) {
        var input = document.getElementById(id);
        if (!input) return;
        input.addEventListener('change', function () {
            var file = input.files[0];
            var ph   = document.getElementById('placeholder-' + id);
            var done = document.getElementById('done-' + id);
            var fn   = document.getElementById('fname-' + id);
            var zone = document.getElementById('zone-' + id);
            if (file) {
                ph.classList.add('hidden');
                done.classList.remove('hidden');
                fn.textContent = file.name.length > 28 ? file.name.substring(0,26)+'...' : file.name;
                zone.classList.add('has-file');
            }
        });
    });
}());
// "Other" — Blood Type checkbox
(function () {
    var cb = document.getElementById('bt_other_cb');
    var wrap = document.getElementById('blood-other-wrap');
    if (!cb || !wrap) return;
    cb.addEventListener('change', function () {
        if (cb.checked) {
            wrap.classList.remove('hidden');
            document.getElementById('blood_type_other').focus();
        } else {
            wrap.classList.add('hidden');
            document.getElementById('blood_type_other').value = '';
        }
    });
}());

// "Other" — Combat Size radio
(function () {
    var radios = document.querySelectorAll('input[name="combat_size"]');
    var wrap = document.getElementById('combat-other-wrap');
    if (!radios.length || !wrap) return;
    radios.forEach(function (r) {
        r.addEventListener('change', function () {
            if (r.value === 'Other' && r.checked) {
                wrap.classList.remove('hidden');
                document.getElementById('combat_size_other').focus();
            } else {
                wrap.classList.add('hidden');
                document.getElementById('combat_size_other').value = '';
            }
        });
    });
}());
</script>
</body>
</html>
