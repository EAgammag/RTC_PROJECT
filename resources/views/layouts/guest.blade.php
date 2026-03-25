<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'CCJE ROTC') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased" style="background: #061020;">
        <div class="min-h-screen flex flex-col items-center justify-center p-6">

            {{-- CSU-Aparri Branding --}}
            <div class="mb-8 text-center">
                <div class="flex items-center justify-center gap-4 mb-4">
                    <img src="{{ asset('csulogo.png') }}" alt="CSU Aparri Logo" class="h-16 w-auto">
                    <img src="{{ asset('CCJE.png') }}" alt="CCJE ROTC Logo" class="h-16 w-auto">
                </div>
                <h1 class="text-xl font-bold tracking-[0.15em] uppercase" style="color: #c8a951;">CCJE — CSU Aparri</h1>
                <p class="text-xs tracking-wider uppercase text-slate-500 mt-1">Reserve Officers' Training Corps</p>
                <p class="text-xs text-slate-600 mt-0.5">Cagayan State University — Aparri</p>
            </div>

            {{-- Auth card --}}
            <div class="w-full max-w-md rounded-xl px-8 py-8"
                 style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.1);">
                {{ $slot }}
            </div>

        </div>
    </body>
</html>
