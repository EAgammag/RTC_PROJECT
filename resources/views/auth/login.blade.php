<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- Prevent caching of the login page --}}
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <title>Secure Login – CSU Aparri NROTC</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif

    <style>
        body {
            background: linear-gradient(135deg, #030d18 0%, #0a1628 50%, #061020 100%);
            min-height: 100vh;
        }
        .login-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(200,169,81,0.25);
            backdrop-filter: blur(20px);
        }
        .form-input {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.15);
            color: #e2e8f0;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-input:focus {
            outline: none;
            border-color: #c8a951;
            box-shadow: 0 0 0 3px rgba(200,169,81,0.15);
        }
        .form-input::placeholder { color: #64748b; }
        .btn-login {
            background: linear-gradient(135deg, #c8a951 0%, #a08030 100%);
            color: #061020;
            font-weight: 700;
            transition: opacity 0.2s, transform 0.1s;
        }
        .btn-login:hover { opacity: 0.92; transform: translateY(-1px); }
        .btn-login:active { transform: translateY(0); }
        .divider { border-color: rgba(255,255,255,0.1); }
    </style>
</head>
<body class="flex items-center justify-center px-4 py-8">

    <div class="w-full max-w-md">

        {{-- Header branding --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full mb-4"
                 style="background: linear-gradient(135deg, #c8a951 0%, #a08030 100%);">
                <svg class="w-10 h-10 text-navy-900" fill="none" stroke="#061020" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-white tracking-wide">CSU Aparri NROTC</h1>
            <p class="text-sm mt-1" style="color: #c8a951;">Naval Reserve Officers Training Corps</p>
            <p class="text-xs mt-2 text-slate-400">Secure Information Management System</p>
        </div>

        {{-- Status / session expiry message --}}
        @if (session('status'))
            <div class="mb-4 px-4 py-3 rounded-lg text-sm text-center"
                 style="background: rgba(34,197,94,0.12); border: 1px solid rgba(34,197,94,0.3); color: #4ade80;">
                {{ session('status') }}
            </div>
        @endif

        {{-- Login card --}}
        <div class="login-card rounded-2xl p-8 shadow-2xl">

            <h2 class="text-lg font-semibold text-white mb-1">Authorized Personnel Only</h2>
            <p class="text-xs text-slate-400 mb-6">
                Unauthorized access is prohibited. All login attempts are logged.
            </p>

            {{-- Validation errors --}}
            @if ($errors->any())
                <div class="mb-5 px-4 py-3 rounded-lg"
                     style="background: rgba(239,68,68,0.12); border: 1px solid rgba(239,68,68,0.35); color: #fca5a5;">
                    <div class="flex gap-2">
                        <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <ul class="text-sm space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" autocomplete="off" novalidate>
                @csrf

                {{-- Email --}}
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-slate-300 mb-1.5">
                        Email Address
                    </label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="email"
                        maxlength="255"
                        class="form-input w-full px-4 py-2.5 rounded-lg text-sm"
                        placeholder="your.email@csu.edu.ph"
                    >
                </div>

                {{-- Password --}}
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-slate-300 mb-1.5">
                        Password
                    </label>
                    <div class="relative">
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            maxlength="255"
                            class="form-input w-full px-4 py-2.5 rounded-lg text-sm pr-11"
                            placeholder="Enter your password"
                        >
                        {{-- Toggle visibility --}}
                        <button type="button" onclick="togglePassword()"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-200 transition-colors"
                                aria-label="Toggle password visibility">
                            <svg id="eye-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Remember me --}}
                <div class="flex items-center mb-6">
                    <input id="remember" type="checkbox" name="remember"
                           class="w-4 h-4 rounded border-slate-500 text-yellow-600
                                  focus:ring-yellow-600 focus:ring-offset-0
                                  bg-transparent">
                    <label for="remember" class="ml-2 text-sm text-slate-400">
                        Keep me signed in on this device
                    </label>
                </div>

                <button type="submit"
                        class="btn-login w-full py-3 rounded-lg text-sm tracking-wide uppercase">
                    Sign In Securely
                </button>
            </form>

            <hr class="divider my-6">

            <p class="text-center text-xs text-slate-500">
                Account access is granted only by the System Administrator.<br>
                Contact your unit administrator if you cannot log in.
            </p>
        </div>

        {{-- Security notice --}}
        <div class="mt-6 text-center">
            <div class="flex items-center justify-center gap-4 text-xs text-slate-600">
                <span class="flex items-center gap-1">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                              clip-rule="evenodd"/>
                    </svg>
                    bcrypt-hashed
                </span>
                <span>•</span>
                <span class="flex items-center gap-1">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    CSRF protected
                </span>
                <span>•</span>
                <span>Attempts logged</span>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon  = document.getElementById('eye-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7
                             a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878
                             l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59
                             m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7
                             a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>`;
            } else {
                input.type = 'password';
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7
                             -1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
            }
        }
    </script>

</body>
</html>
