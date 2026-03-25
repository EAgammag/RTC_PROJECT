<x-guest-layout>

    @if ($errors->any())
        <div class="ac-alert ac-alert-error" role="alert">
            ✘&nbsp; {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.store') }}" novalidate>
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        {{-- Email --}}
        <div style="margin-bottom: 1rem;">
            <label class="ac-label" for="email">Email Address</label>
            <div class="ac-input-wrap">
                <span class="ac-input-icon" aria-hidden="true">✉</span>
                <input class="ac-input @error('email') is-error @enderror"
                       type="email" id="email" name="email"
                       value="{{ old('email', $request->email) }}"
                       placeholder="cadet@csuaparri.edu.ph"
                       autocomplete="username"
                       autofocus required>
            </div>
            @error('email')
                <div class="ac-field-error" role="alert">⚠ {{ $message }}</div>
            @enderror
        </div>

        {{-- New Password --}}
        <div style="margin-bottom: 1rem;">
            <label class="ac-label" for="password">New Password</label>
            <div class="ac-input-wrap">
                <span class="ac-input-icon" aria-hidden="true">🔐</span>
                <input class="ac-input @error('password') is-error @enderror"
                       type="password" id="password" name="password"
                       placeholder="Minimum 8 characters"
                       autocomplete="new-password"
                       required>
                <button type="button" class="ac-pw-toggle" onclick="acRpToggle('password', this)" aria-label="Toggle password visibility">👁</button>
            </div>
            @error('password')
                <div class="ac-field-error" role="alert">⚠ {{ $message }}</div>
            @enderror
        </div>

        {{-- Confirm Password --}}
        <div style="margin-bottom: 1.25rem;">
            <label class="ac-label" for="password_confirmation">Confirm New Password</label>
            <div class="ac-input-wrap">
                <span class="ac-input-icon" aria-hidden="true">🔐</span>
                <input class="ac-input"
                       type="password" id="password_confirmation" name="password_confirmation"
                       placeholder="Repeat new password"
                       autocomplete="new-password"
                       required>
                <button type="button" class="ac-pw-toggle" onclick="acRpToggle('password_confirmation', this)" aria-label="Toggle confirm password visibility">👁</button>
            </div>
        </div>

        <button type="submit" class="ac-submit">RESET PASSWORD</button>
    </form>

    <script>
    function acRpToggle(id, btn) {
        var inp = document.getElementById(id);
        if (inp.type === 'password') { inp.type = 'text'; btn.textContent = '🙈'; }
        else { inp.type = 'password'; btn.textContent = '👁'; }
    }
    </script>

</x-guest-layout>
