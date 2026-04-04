<x-guest-layout>

    {{-- Enrollment context banner --}}
    @if (!empty($enrollMode))
        <div style="background:rgba(79,70,229,.07);border:1px solid rgba(79,70,229,.2);border-radius:.6rem;padding:.7rem 1rem;margin-bottom:1.1rem;display:flex;align-items:flex-start;gap:.6rem;">
            <svg style="width:16px;height:16px;color:#4f46e5;shrink:0;margin-top:.1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            <p style="font-size:.78rem;color:#3730a3;line-height:1.5;margin:0;">
                <strong>Continuing enrollment?</strong> Sign in with your existing account and you'll be taken straight to the enrollment form.
            </p>
        </div>
    @endif

    {{-- Session status --}}
    @if (session('status'))
        <div class="auth-alert auth-alert-success" role="status">
            {{ session('status') }}
        </div>
    @endif

    {{-- Validation errors --}}
    @if ($errors->any())
        <div class="auth-alert auth-alert-error" role="alert">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" id="loginForm" novalidate>
        @csrf

        {{-- ID Number --}}
        <div style="margin-bottom: 1.125rem;">
            <label class="auth-label" for="login_id">ID Number</label>
            <input class="auth-input @error('login_id') is-error @enderror"
                   type="text"
                   id="login_id"
                   name="login_id"
                   value="{{ old('login_id') }}"
                   placeholder="e.g. 2024-00001"
                   autocomplete="username"
                   autofocus
                   required>
            @error('login_id')
                <div class="auth-field-error" id="login_id-error" role="alert">{{ $message }}</div>
            @enderror
            <div class="auth-field-error" id="login_id-client-error" role="alert" style="display:none;"></div>
        </div>

        {{-- Password --}}
        <div style="margin-bottom: 1.125rem;">
            <label class="auth-label" for="password">Password</label>
            <div style="position: relative;">
                <input class="auth-input @error('password') is-error @enderror"
                       type="password"
                       id="password"
                       name="password"
                       placeholder="Enter your password"
                       autocomplete="current-password"
                       required>
                <button type="button"
                        class="auth-pw-toggle"
                        onclick="togglePw('password', this)"
                        aria-label="Toggle password visibility">
                    <svg class="eye-open" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    <svg class="eye-closed" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none;"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                </button>
            </div>
            @error('password')
                <div class="auth-field-error" id="password-error" role="alert">{{ $message }}</div>
            @enderror
            <div class="auth-field-error" id="password-client-error" role="alert" style="display:none;"></div>
        </div>

        {{-- Remember me + Forgot password --}}
        <div class="auth-extras">
            <label class="auth-check-label" for="remember_me">
                <input type="checkbox" id="remember_me" name="remember">
                Remember me
            </label>
            @if (Route::has('password.request'))
                <a class="auth-forgot" href="{{ route('password.request') }}">Forgot password?</a>
            @endif
        </div>

        {{-- Submit --}}
        <button type="submit" class="auth-submit">
            Sign In
        </button>
    </form>

    <div style="margin-top:.875rem;text-align:center;">
        <a href="{{ route('register') }}"
           style="font-size:.8rem;color:#800000;text-decoration:none;font-weight:500;transition:color .15s;"
           onmouseover="this.style.color='#5a0000';this.style.textDecoration='underline';"
           onmouseout="this.style.color='#800000';this.style.textDecoration='none';">
            New cadet? Create your account
        </a>
    </div>

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
        var idInput = document.getElementById('login_id');
        var passwordInput = document.getElementById('password');
        var idErr = document.getElementById('login_id-client-error');
        var passwordErr = document.getElementById('password-client-error');

        function showError(input, errEl, msg) {
            input.classList.add('is-error');
            errEl.textContent = msg;
            errEl.style.display = 'block';
        }

        function clearError(input, errEl) {
            input.classList.remove('is-error');
            errEl.textContent = '';
            errEl.style.display = 'none';
        }

        function validateId() {
            var val = idInput.value.trim();
            if (!val) {
                showError(idInput, idErr, 'ID Number is required.');
                return false;
            }
            if (val.length > 50) {
                showError(idInput, idErr, 'ID Number must not exceed 50 characters.');
                return false;
            }
            clearError(idInput, idErr);
            return true;
        }

        function validatePassword() {
            var val = passwordInput.value;
            if (!val) {
                showError(passwordInput, passwordErr, 'Password is required.');
                return false;
            }
            if (val.length < 8) {
                showError(passwordInput, passwordErr, 'Password must be at least 8 characters.');
                return false;
            }
            clearError(passwordInput, passwordErr);
            return true;
        }

        idInput.addEventListener('blur', validateId);
        idInput.addEventListener('input', function () {
            if (idInput.classList.contains('is-error')) { validateId(); }
        });

        passwordInput.addEventListener('blur', validatePassword);
        passwordInput.addEventListener('input', function () {
            if (passwordInput.classList.contains('is-error')) { validatePassword(); }
        });

        document.getElementById('loginForm').addEventListener('submit', function (e) {
            var idOk = validateId();
            var passwordOk = validatePassword();
            if (!idOk || !passwordOk) {
                e.preventDefault();
                if (!idOk) { idInput.focus(); }
                else { passwordInput.focus(); }
            }
        });
    })();
    </script>

</x-guest-layout>
