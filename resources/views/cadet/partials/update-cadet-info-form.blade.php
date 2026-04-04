<form method="post" action="{{ route('cadet.profile.update') }}" class="space-y-3">
    @csrf
    @method('patch')

    {{-- ── Personal ─────────────────────────────────────────────────────────── --}}
    <p class="text-xs font-bold uppercase tracking-widest pb-1"
       style="color: var(--gold); border-bottom: 1px solid rgba(200,169,81,.15);">Personal</p>

    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3"
         x-data="{
             dob: '{{ old('date_of_birth', $user->date_of_birth?->format('Y-m-d') ?? '') }}',
             get age() {
                 if (!this.dob) return '';
                 return Math.floor((Date.now() - new Date(this.dob).getTime()) / (1000*60*60*24*365.25));
             }
         }">

        <div>
            <label class="block text-xs text-slate-400 mb-0.5">Date of Birth</label>
            <input type="date" name="date_of_birth" x-model="dob"
                   value="{{ old('date_of_birth', $user->date_of_birth?->format('Y-m-d')) }}"
                   class="w-full rounded-md border border-slate-200 px-2.5 py-1.5 text-xs text-slate-800 focus:outline-none focus:ring-1" />
            <x-input-error :messages="$errors->get('date_of_birth')" class="mt-0.5" />
        </div>

        <div>
            <label class="block text-xs text-slate-400 mb-0.5">Age <span class="text-slate-300">(auto)</span></label>
            <input type="text" :value="age" readonly
                   class="w-full rounded-md border border-slate-200 px-2.5 py-1.5 text-xs text-slate-400 bg-slate-50 cursor-default" />
        </div>

        <div>
            <label class="block text-xs text-slate-400 mb-0.5">Gender</label>
            <select name="gender"
                    class="w-full rounded-md border border-slate-200 px-2.5 py-1.5 text-xs text-slate-800 bg-white focus:outline-none focus:ring-1">
                <option value="">—</option>
                <option value="Male"   {{ old('gender', $user->gender) === 'Male'   ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ old('gender', $user->gender) === 'Female' ? 'selected' : '' }}>Female</option>
            </select>
            <x-input-error :messages="$errors->get('gender')" class="mt-0.5" />
        </div>

        <div>
            <label class="block text-xs text-slate-400 mb-0.5">Blood Type</label>
            <select name="blood_type"
                    class="w-full rounded-md border border-slate-200 px-2.5 py-1.5 text-xs text-slate-800 bg-white focus:outline-none focus:ring-1">
                <option value="">—</option>
                @foreach (['A+','A−','B+','B−','AB+','AB−','O+','O−'] as $bt)
                    <option value="{{ $bt }}" {{ old('blood_type', $user->blood_type) === $bt ? 'selected' : '' }}>{{ $bt }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('blood_type')" class="mt-0.5" />
        </div>

        <div>
            <label class="block text-xs text-slate-400 mb-0.5">Religion</label>
            <input type="text" name="religion" maxlength="100"
                   value="{{ old('religion', $user->religion) }}"
                   placeholder="e.g. Roman Catholic"
                   class="w-full rounded-md border border-slate-200 px-2.5 py-1.5 text-xs text-slate-800 focus:outline-none focus:ring-1" />
            <x-input-error :messages="$errors->get('religion')" class="mt-0.5" />
        </div>

        <div>
            <label class="block text-xs text-slate-400 mb-0.5">Contact No.</label>
            <input type="text" name="contact_number" maxlength="20"
                   value="{{ old('contact_number', $user->contact_number) }}"
                   placeholder="09XX-XXX-XXXX"
                   class="w-full rounded-md border border-slate-200 px-2.5 py-1.5 text-xs text-slate-800 focus:outline-none focus:ring-1" />
            <x-input-error :messages="$errors->get('contact_number')" class="mt-0.5" />
        </div>

        <div>
            <label class="block text-xs text-slate-400 mb-0.5">Course / Year</label>
            <input type="text" name="course_year" maxlength="100"
                   value="{{ old('course_year', $user->course_year) }}"
                   placeholder="e.g. BSCrim 2"
                   class="w-full rounded-md border border-slate-200 px-2.5 py-1.5 text-xs text-slate-800 focus:outline-none focus:ring-1" />
            <x-input-error :messages="$errors->get('course_year')" class="mt-0.5" />
        </div>

        <div class="grid grid-cols-2 gap-2">
            <div>
                <label class="block text-xs text-slate-400 mb-0.5">Height</label>
                <input type="text" name="height" maxlength="20"
                       value="{{ old('height', $user->height) }}"
                       placeholder="5'6&quot;"
                       class="w-full rounded-md border border-slate-200 px-2.5 py-1.5 text-xs text-slate-800 focus:outline-none focus:ring-1" />
                <x-input-error :messages="$errors->get('height')" class="mt-0.5" />
            </div>
            <div>
                <label class="block text-xs text-slate-400 mb-0.5">Weight (kg)</label>
                <input type="text" name="weight" maxlength="20"
                       value="{{ old('weight', $user->weight) }}"
                       placeholder="65"
                       class="w-full rounded-md border border-slate-200 px-2.5 py-1.5 text-xs text-slate-800 focus:outline-none focus:ring-1" />
                <x-input-error :messages="$errors->get('weight')" class="mt-0.5" />
            </div>
        </div>

    </div>

    {{-- ── Address ───────────────────────────────────────────────────────────── --}}
    <div>
        <label class="block text-xs text-slate-400 mb-0.5">Home Address</label>
        <input type="text" name="address" maxlength="500"
               value="{{ old('address', $user->address) }}"
               placeholder="House/Unit No., Street, Barangay, Town/City, Province"
               class="w-full rounded-md border border-slate-200 px-2.5 py-1.5 text-xs text-slate-800 focus:outline-none focus:ring-1" />
        <x-input-error :messages="$errors->get('address')" class="mt-0.5" />
    </div>

    {{-- ── Emergency Contact ────────────────────────────────────────────────── --}}
    <p class="text-xs font-bold uppercase tracking-widest pb-1 pt-1"
       style="color: var(--gold); border-bottom: 1px solid rgba(200,169,81,.15);">Emergency Contact</p>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">

        <div>
            <label class="block text-xs text-slate-400 mb-0.5">Contact Person</label>
            <input type="text" name="emergency_name" maxlength="255"
                   value="{{ old('emergency_name', $user->emergency_name) }}"
                   placeholder="Last Name, First Name"
                   class="w-full rounded-md border border-slate-200 px-2.5 py-1.5 text-xs text-slate-800 focus:outline-none focus:ring-1" />
            <x-input-error :messages="$errors->get('emergency_name')" class="mt-0.5" />
        </div>

        <div>
            <label class="block text-xs text-slate-400 mb-0.5">Relationship</label>
            <input type="text" name="emergency_relationship" maxlength="100"
                   value="{{ old('emergency_relationship', $user->emergency_relationship) }}"
                   placeholder="e.g. Parent, Guardian"
                   class="w-full rounded-md border border-slate-200 px-2.5 py-1.5 text-xs text-slate-800 focus:outline-none focus:ring-1" />
            <x-input-error :messages="$errors->get('emergency_relationship')" class="mt-0.5" />
        </div>

        <div>
            <label class="block text-xs text-slate-400 mb-0.5">Contact No.</label>
            <input type="text" name="emergency_contact" maxlength="20"
                   value="{{ old('emergency_contact', $user->emergency_contact) }}"
                   placeholder="09XX-XXX-XXXX"
                   class="w-full rounded-md border border-slate-200 px-2.5 py-1.5 text-xs text-slate-800 focus:outline-none focus:ring-1" />
            <x-input-error :messages="$errors->get('emergency_contact')" class="mt-0.5" />
        </div>

    </div>

    {{-- ── Submit ───────────────────────────────────────────────────────────── --}}
    <div class="flex items-center gap-4 pt-1">
        <x-primary-button>Save Cadet Info</x-primary-button>

        @if (session('success'))
            <p x-data="{ show: true }"
               x-show="show"
               x-transition
               x-init="setTimeout(() => show = false, 3000)"
               style="font-size: .75rem; color: #16a34a; letter-spacing: .02em;">
                {{ session('success') }}
            </p>
        @endif
    </div>

</form>
