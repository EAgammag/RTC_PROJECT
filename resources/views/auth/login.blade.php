<x-guest-layout>

    {{-- Session status (e.g. password-reset link sent) --}}
    @if (session('status'))
        <div class="ac-alert ac-alert-success" role="status">
            &check;&nbsp; {{ session('status') }}
        </div>
    @endif

    {{-- Validation errors (general) --}}
    @if ($errors->any())
        <div class="ac-alert ac-alert-error" role="alert">
            &times;&nbsp; {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" novalidate>
        @csrf

        {{-- Cadet ID --}}
        <div style="margin-bottom: 1rem;">
            <label class="ac-label" for="email">Cadet ID / Email</label>
            <div class="ac-input-wrap">
                <span class="ac-input-icon" aria-hidden="true">&commat;</span>
                <input class="ac-input @error('email') is-error @enderror"
                       type="email"
                       id="email"
                       name="email"
                       value="{{ old('email') }}"
                       placeholder="cadet@csuaparri.edu.ph"
                       autocomplete="username"
                       aria-required="true"
                       aria-describedby="email-err"
                       autofocus
                       required>
            </div>
            @error('email')
                <div class="ac-field-error" id="email-err" role="alert">⚠ {{ $message }}</div>
            @enderror
        </div>

        {{-- Password --}}
        <div style="margin-bottom: 1rem;">
            <label class="ac-label" for="password">Password</label>
            <div class="ac-input-wrap">
                <span class="ac-input-icon" aria-hidden="true">&loz;</span>
                <input class="ac-input @error('password') is-error @enderror"
                       type="password"
                       id="password"
                       name="password"
                       placeholder="Enter password"
                       autocomplete="current-password"
                       aria-required="true"
                       aria-describedby="password-err"
                       required>
                <button type="button"
                        class="ac-pw-toggle"
                        onclick="acTogglePw('password', this)"
                        aria-label="Toggle password visibility">&bull;</button>
            </div>
            @error('password')
                <div class="ac-field-error" id="password-err" role="alert">⚠ {{ $message }}</div>
            @enderror
        </div>

        {{-- Remember me + Forgot password --}}
        <div class="ac-extras">
            <label class="ac-check-label" for="remember_me">
                <input type="checkbox" id="remember_me" name="remember">
                Keep me signed in
            </label>
            @if (Route::has('password.request'))
                <a class="ac-forgot" href="{{ route('password.request') }}">FORGOT PASSWORD?</a>
            @endif
        </div>

        {{-- Submit --}}
        <button type="submit" class="ac-submit">
            ACCESS SYSTEM
        </button>

        <p class="ac-form-footer">
            Unauthorized access is strictly prohibited &nbsp;·&nbsp; All sessions are monitored
        </p>
    </form>

    <script>
    function acTogglePw(id, btn) {
        var inp = document.getElementById(id);
        if (inp.type === 'password') { inp.type = 'text';     btn.textContent = '\u25CF'; }
        else                         { inp.type = 'password'; btn.textContent = '\u2022'; }
    }
    </script>

</x-guest-layout>
