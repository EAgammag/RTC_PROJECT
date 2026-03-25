<x-guest-layout>

    <p style="font-family: 'Rajdhani', sans-serif; font-size: .9rem; color: #94a3b8; line-height: 1.55; margin-bottom: 1.25rem;">
        Enter your registered email address and we will send you a password reset link.
    </p>

    @if (session('status'))
        <div class="ac-alert ac-alert-success" role="status">
            ✔&nbsp; {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" novalidate>
        @csrf

        <div style="margin-bottom: 1.25rem;">
            <label class="ac-label" for="email">Email Address</label>
            <div class="ac-input-wrap">
                <span class="ac-input-icon" aria-hidden="true">✉</span>
                <input class="ac-input @error('email') is-error @enderror"
                       type="email" id="email" name="email"
                       value="{{ old('email') }}"
                       placeholder="cadet@csuaparri.edu.ph"
                       autofocus required>
            </div>
            @error('email')
                <div class="ac-field-error" role="alert">⚠ {{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="ac-submit">SEND RESET LINK</button>

        <div style="margin-top: 1.1rem; text-align: center;">
            <a href="{{ route('login') }}"
               style="font-family: 'Share Tech Mono', monospace; font-size: .62rem; color: var(--gold); letter-spacing: .1em; text-decoration: none; opacity: .75;">
                ← BACK TO SIGN IN
            </a>
        </div>
    </form>

</x-guest-layout>
