@extends('layouts.app')

@section('title', 'Review Enrollment — ' . $user->name)
@section('page-title', 'Review Enrollment')

@section('sidebar-nav')
    <a href="{{ route('officer.dashboard') }}" class="sidebar-link">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>
        Unit Oversight
    </a>
    <a href="{{ route('officer.enrollments.index') }}" class="sidebar-link active">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        Enrollments
    </a>
    <a href="{{ route('officer.attendance.index') }}" class="sidebar-link">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
        </svg>
        Attendance
    </a>
    <a href="{{ route('officer.grades') }}" class="sidebar-link">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
        </svg>
        Grades
    </a>
@endsection

@section('content')
<div class="max-w-3xl space-y-5">

    {{-- Back + header --}}
    <div class="flex items-center gap-3">
        <a href="{{ route('officer.enrollments.index') }}"
           class="text-xs font-semibold flex items-center gap-1 transition-colors"
           style="color: var(--gold2);">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Enrollees
        </a>
    </div>

    {{-- Hero card --}}
    <div class="card rounded-xl overflow-hidden">
        <div class="h-1.5 w-full" style="background: linear-gradient(90deg, var(--gold2), var(--gold3), var(--gold));"></div>
        <div class="px-6 py-5 flex items-center gap-5">
            <div class="w-16 h-16 rounded-full flex items-center justify-center text-2xl font-black shrink-0"
                 style="background: linear-gradient(135deg, var(--gold3), var(--gold)); color: var(--navy);">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div class="flex-1 min-w-0">
                <h2 class="text-xl font-black" style="color: var(--navy);">{{ $user->name }}</h2>
                <p class="text-sm text-slate-500">{{ $user->email }}</p>
                <div class="flex flex-wrap items-center gap-2 mt-2">
                    @if ($user->student_id)
                        <span class="text-xs font-mono px-2 py-0.5 rounded"
                              style="background: rgba(4,9,15,0.06); color: var(--navy);">
                            {{ $user->student_id }}
                        </span>
                    @endif

                    @if ($user->enrollment_status === 'pending')
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold"
                              style="background: #fffbeb; color: #92400e; border: 1px solid #fde68a;">
                            <span class="w-1.5 h-1.5 rounded-full bg-yellow-400"></span> Pending Validation
                        </span>
                    @elseif ($user->enrollment_status === 'validated')
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold"
                              style="background: #f0fdf4; color: #14532d; border: 1px solid #bbf7d0;">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Validated
                        </span>
                    @elseif ($user->enrollment_status === 'rejected')
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold"
                              style="background: #fff5f5; color: #7f1d1d; border: 1px solid #fecaca;">
                            <span class="w-1.5 h-1.5 rounded-full bg-red-400"></span> Rejected
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Profile details --}}
    <div class="card rounded-xl p-6 space-y-5">
        <div class="flex items-center gap-2 pb-2 border-b border-slate-100">
            <svg class="w-4 h-4" style="color: var(--gold);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            <h3 class="text-xs font-bold uppercase tracking-wider text-slate-600">Personal Information</h3>
        </div>

        <div class="grid grid-cols-2 gap-x-8 gap-y-3 text-sm">
            @php
                $fields = [
                    'Date of Birth'  => $user->date_of_birth?->format('F d, Y'),
                    'Age'            => $user->date_of_birth ? $user->date_of_birth->age . ' years old' : null,
                    'Gender'         => $user->gender,
                    'Blood Type'     => $user->blood_type,
                    'Religion'       => $user->religion,
                    'Course / Year'  => $user->course_year,
                    'Height'         => $user->height ? $user->height . ' cm' : null,
                    'Weight'         => $user->weight ? $user->weight . ' kg' : null,
                    'Contact Number' => $user->contact_number,
                    'Address'        => $user->address,
                ];
            @endphp

            @foreach ($fields as $label => $value)
                <div>
                    <p class="text-xs text-slate-400 font-medium">{{ $label }}</p>
                    <p class="text-sm font-semibold text-slate-800 mt-0.5">{{ $value ?? '—' }}</p>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Emergency contact --}}
    <div class="card rounded-xl p-6 space-y-4">
        <div class="flex items-center gap-2 pb-2 border-b border-slate-100">
            <svg class="w-4 h-4" style="color: var(--gold);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
            </svg>
            <h3 class="text-xs font-bold uppercase tracking-wider text-slate-600">Emergency Contact</h3>
        </div>

        <div class="grid grid-cols-3 gap-x-8 gap-y-3 text-sm">
            <div>
                <p class="text-xs text-slate-400 font-medium">Name</p>
                <p class="text-sm font-semibold text-slate-800 mt-0.5">{{ $user->emergency_name ?? '—' }}</p>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-medium">Relationship</p>
                <p class="text-sm font-semibold text-slate-800 mt-0.5">{{ $user->emergency_relationship ?? '—' }}</p>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-medium">Contact</p>
                <p class="text-sm font-semibold text-slate-800 mt-0.5">{{ $user->emergency_contact ?? '—' }}</p>
            </div>
        </div>
    </div>

    {{-- Existing remarks (if any) --}}
    @if ($user->enrollment_remarks)
        <div class="card rounded-xl p-5"
             style="background: #fff9db; border: 1px solid #fde68a;">
            <p class="text-xs font-bold text-yellow-700 uppercase tracking-wider mb-1">Previous Remarks</p>
            <p class="text-sm text-yellow-900">{{ $user->enrollment_remarks }}</p>
        </div>
    @endif

    {{-- Validate / Reject actions --}}
    @if ($user->enrollment_status === 'pending')
        <div class="card rounded-xl p-6 space-y-5">
            <div class="flex items-center gap-2 pb-2 border-b border-slate-100">
                <svg class="w-4 h-4" style="color: var(--gold);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-600">Enrollment Decision</h3>
            </div>

            <div class="text-xs text-slate-500 bg-slate-50 rounded-lg px-4 py-3 border border-slate-200">
                Validating enables the cadet account. Rejecting disables it and notifies via the system.
                You may add remarks for either decision.
            </div>

            {{-- Remarks field shared by both forms via Alpine --}}
            <div x-data="{ remarks: '' }">
                <label class="block text-xs font-semibold text-slate-600 mb-1.5">
                    Remarks <span class="text-slate-400 font-normal">(optional)</span>
                </label>
                <textarea x-model="remarks"
                          rows="3"
                          placeholder="Add notes for this decision..."
                          class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2"
                          style="--tw-ring-color: var(--gold); resize: vertical;"></textarea>

                <div class="flex items-center gap-3 mt-4">

                    {{-- Validate button/form --}}
                    <form method="POST" action="{{ route('officer.enrollments.validate', $user) }}"
                          @submit.prevent="
                              if (confirm('Validate enrollment for {{ addslashes($user->name) }}?')) {
                                  $el.querySelector('[name=remarks]').value = remarks;
                                  $el.submit();
                              }
                          ">
                        @csrf @method('PATCH')
                        <input type="hidden" name="remarks">
                        <button type="submit"
                                class="px-5 py-2 rounded-lg text-sm font-bold transition-all"
                                style="background: #166534; color: #fff;">
                            Validate Enrollment
                        </button>
                    </form>

                    {{-- Reject button/form --}}
                    <form method="POST" action="{{ route('officer.enrollments.reject', $user) }}"
                          @submit.prevent="
                              if (confirm('Reject enrollment for {{ addslashes($user->name) }}? This will disable their account.')) {
                                  $el.querySelector('[name=remarks]').value = remarks;
                                  $el.submit();
                              }
                          ">
                        @csrf @method('PATCH')
                        <input type="hidden" name="remarks">
                        <button type="submit"
                                class="px-5 py-2 rounded-lg text-sm font-bold transition-all"
                                style="background: #7f1d1d; color: #fff;">
                            Reject Enrollment
                        </button>
                    </form>

                </div>
            </div>
        </div>

    @elseif ($user->enrollment_status !== null)
        {{-- Re-evaluate option for already-decided enrollees --}}
        <div class="card rounded-xl p-5 flex items-center justify-between gap-4"
             style="background: #f8fafc; border: 1px solid #e2e8f0;">
            <p class="text-sm text-slate-500">
                This enrollment was previously
                <strong class="{{ $user->enrollment_status === 'validated' ? 'text-green-700' : 'text-red-700' }}">
                    {{ $user->enrollment_status }}
                </strong>.
                You may reverse the decision below.
            </p>
            @if ($user->enrollment_status === 'validated')
                <form method="POST" action="{{ route('officer.enrollments.reject', $user) }}"
                      onsubmit="return confirm('Reverse: reject this enrollment?')">
                    @csrf @method('PATCH')
                    <button type="submit"
                            class="text-xs px-3 py-1.5 rounded-lg font-bold"
                            style="background: #fff5f5; color: #7f1d1d; border: 1px solid #fecaca;">
                        Reject
                    </button>
                </form>
            @else
                <form method="POST" action="{{ route('officer.enrollments.validate', $user) }}"
                      onsubmit="return confirm('Reverse: validate this enrollment?')">
                    @csrf @method('PATCH')
                    <button type="submit"
                            class="text-xs px-3 py-1.5 rounded-lg font-bold"
                            style="background: #f0fdf4; color: #166534; border: 1px solid #bbf7d0;">
                        Validate
                    </button>
                </form>
            @endif
        </div>
    @endif

</div>
@endsection
