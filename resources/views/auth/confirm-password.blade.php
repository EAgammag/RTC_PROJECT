<x-guest-layout>

    <p style="font-size: .85rem; color: #6b7280; line-height: 1.55; margin-bottom: 1.25rem;">
        This is a secure area. Please confirm your password before continuing.
    </p>

    @if ($errors->any())
        <div class="auth-alert auth-alert-error" role="alert">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.confirm') }}" id="confirmForm" novalidate>
        @csrf

        <div style="margin-bottom: 1.25rem;">
            <label class="auth-label" for="password">Password</label>
            <div style="position: relative;">
                <input class="auth-input @error('password') is-error @enderror"
                       type="password" id="password" name="password"
                       placeholder="Enter your password"
                       autocomplete="current-password"
                       required>
                <button type="button" class="auth-pw-toggle" onclick="togglePw('password', this)" aria-label="Toggle password visibility">
                    <svg class="eye-open" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    <svg class="eye-closed" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none;"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                </button>
            </div>
            @error('password')
                <div class="auth-field-error" role="alert">{{ $message }}</div>
            @enderror
            <div class="auth-field-error" id="pw-client-error" role="alert" style="display:none;"></div>
        </div>

        <button type="submit" class="auth-submit">Confirm &amp; Continue</button>
    </form>

    <script>
    function togglePw(id, btn) {
        var inp = document.getElementById(id);
        var open = btn.querySelector('.eye-open');
        var closed = btn.querySelector('.eye-closed');
        if (inp.type === 'password') {
            inp.type = 'text';
            open.style.display = 'none';
            closed.style.display = 'block';
        } else {
            inp.type = 'password';
            open.style.display = 'block';
            closed.style.display = 'none';
        }
    }

    (function () {
        var pwInput = document.getElementById('password');
        var pwErr = document.getElementById('pw-client-error');
        function validate() {
            if (!pwInput.value) { pwInput.classList.add('is-error'); pwErr.textContent = 'Password is required.'; pwErr.style.display = 'block'; return false; }
            pwInput.classList.remove('is-error'); pwErr.style.display = 'none'; return true;
        }
        pwInput.addEventListener('blur', validate);
        pwInput.addEventListener('input', function () { if (pwInput.classList.contains('is-error')) validate(); });
        document.getElementById('confirmForm').addEventListener('submit', function (e) {
            if (!validate()) { e.preventDefault(); pwInput.focus(); }
        });
    })();
    </script>

</x-guest-layout>
