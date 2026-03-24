<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'NROTC') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased" style="background: #061020;">
        <div class="min-h-screen flex flex-col items-center justify-center p-6">

            {{-- NROTC Branding --}}
            <div class="mb-8 text-center">
                <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4"
                     style="background: linear-gradient(135deg, #c8a951 0%, #a08030 100%);">
                    <svg class="w-8 h-8" fill="none" stroke="#061020" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 2v20M2 12h20"/>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold tracking-[0.2em] uppercase" style="color: #c8a951;">NROTC</h1>
                <p class="text-xs tracking-widest uppercase text-slate-500 mt-1">Naval Reserve Officers Training Corps</p>
            </div>

            {{-- Auth card --}}
            <div class="w-full max-w-md rounded-xl px-8 py-8"
                 style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.1);">
                {{ $slot }}
            </div>

        </div>
    </body>
</html>
