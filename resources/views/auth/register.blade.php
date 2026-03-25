<x-guest-layout>

    @if ($errors->any())
        <div class="ac-alert ac-alert-error" role="alert">
            ✘&nbsp; {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" novalidate>
        @csrf

        {{-- Full Name --}}
        <div style="margin-bottom: 1rem;">
            <label class="ac-label" for="name">Full Name</label>
            <div class="ac-input-wrap">
                <span class="ac-input-icon" aria-hidden="true">◈</span>
                <input class="ac-input @error('name') is-error @enderror"
                       type="text" id="name" name="name"
                       value="{{ old('name') }}"
                       placeholder="Last, First M."
                       autocomplete="name"
                       aria-required="true"
                       autofocus required>
            </div>
            @error('name')
                <div class="ac-field-error" role="alert">⚠ {{ $message }}</div>
            @enderror
        </div>

        {{-- Email --}}
        <div style="margin-bottom: 1rem;">
            <label class="ac-label" for="email">Email Address</label>
            <div class="ac-input-wrap">
                <span class="ac-input-icon" aria-hidden="true">✉</span>
                <input class="ac-input @error('email') is-error @enderror"
                       type="email" id="email" name="email"
                       value="{{ old('email') }}"
                       placeholder="cadet@csuaparri.edu.ph"
                       autocomplete="username"
                       aria-required="true"
                       required>
            </div>
            @error('email')
                <div class="ac-field-error" role="alert">⚠ {{ $message }}</div>
            @enderror
        </div>

        {{-- Password --}}
        <div style="margin-bottom: 1rem;">
            <label class="ac-label" for="password">Password</label>
            <div class="ac-input-wrap">
                <span class="ac-input-icon" aria-hidden="true">🔐</span>
                <input class="ac-input @error('password') is-error @enderror"
                       type="password" id="password" name="password"
                       placeholder="Minimum 8 characters"
                       autocomplete="new-password"
                       aria-required="true"
                       required>
                <button type="button" class="ac-pw-toggle" onclick="acRegTogglePw('password', this)" aria-label="Toggle password visibility">👁</button>
            </div>
            @error('password')
                <div class="ac-field-error" role="alert">⚠ {{ $message }}</div>
            @enderror
        </div>

        {{-- Confirm Password --}}
        <div style="margin-bottom: 1.25rem;">
            <label class="ac-label" for="password_confirmation">Confirm Password</label>
            <div class="ac-input-wrap">
                <span class="ac-input-icon" aria-hidden="true">🔐</span>
                <input class="ac-input"
                       type="password" id="password_confirmation" name="password_confirmation"
                       placeholder="Repeat password"
                       autocomplete="new-password"
                       required>
                <button type="button" class="ac-pw-toggle" onclick="acRegTogglePw('password_confirmation', this)" aria-label="Toggle confirm password visibility">👁</button>
            </div>
        </div>

        <button type="submit" class="ac-submit">REGISTER ACCOUNT</button>

        <div style="margin-top: 1.1rem; text-align: center;">
            <a href="{{ route('login') }}"
               style="font-family: 'Share Tech Mono', monospace; font-size: .62rem; color: var(--gold); letter-spacing: .1em; text-decoration: none; opacity: .75;">
                ALREADY HAVE AN ACCOUNT? SIGN IN
            </a>
        </div>
    </form>

    <p class="ac-form-footer">Accounts are subject to administrator approval</p>

    <script>
    function acRegTogglePw(id, btn) {
        var inp = document.getElementById(id);
        if (inp.type === 'password') { inp.type = 'text'; btn.textContent = '🙈'; }
        else { inp.type = 'password'; btn.textContent = '👁'; }
    }
    </script>

</x-guest-layout>
