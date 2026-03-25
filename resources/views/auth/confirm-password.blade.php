<x-guest-layout>

    <p style="font-family: 'Rajdhani', sans-serif; font-size: .9rem; color: #94a3b8; line-height: 1.55; margin-bottom: 1.25rem;">
        This is a secure area. Please confirm your password before continuing.
    </p>

    @if ($errors->any())
        <div class="ac-alert ac-alert-error" role="alert">
            ✘&nbsp; {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.confirm') }}" novalidate>
        @csrf

        <div style="margin-bottom: 1.25rem;">
            <label class="ac-label" for="password">Password</label>
            <div class="ac-input-wrap">
                <span class="ac-input-icon" aria-hidden="true">🔐</span>
                <input class="ac-input @error('password') is-error @enderror"
                       type="password" id="password" name="password"
                       placeholder="Enter your password"
                       autocomplete="current-password"
                       required>
                <button type="button" class="ac-pw-toggle" onclick="acCpToggle('password', this)" aria-label="Toggle password visibility">👁</button>
            </div>
            @error('password')
                <div class="ac-field-error" role="alert">⚠ {{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="ac-submit">CONFIRM &amp; CONTINUE</button>
    </form>

    <script>
    function acCpToggle(id, btn) {
        var inp = document.getElementById(id);
        if (inp.type === 'password') { inp.type = 'text'; btn.textContent = '🙈'; }
        else { inp.type = 'password'; btn.textContent = '👁'; }
    }
    </script>

</x-guest-layout>
