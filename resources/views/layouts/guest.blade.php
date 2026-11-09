<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>ITS Academic</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-800 antialiased">
        <div class="relative min-h-screen flex flex-col items-center justify-center overflow-hidden bg-slate-50 px-4 py-10">
            <div class="pointer-events-none absolute -top-32 left-1/2 h-96 w-[40rem] -translate-x-1/2 rounded-full bg-indigo-200/50 blur-3xl"></div>

            <a href="/" class="relative flex items-center gap-3">
                <x-application-logo class="h-11 w-11" />
                <span class="leading-tight">
                    <span class="block text-lg font-bold text-slate-900">ITS Academic</span>
                    <span class="block text-xs text-slate-500">Portal Mahasiswa</span>
                </span>
            </a>

            <div class="relative mt-8 w-full sm:max-w-md rounded-2xl border border-slate-200 bg-white px-6 py-8 sm:px-8 shadow-xl shadow-slate-200/50">
                {{ $slot }}
            </div>

            <p class="relative mt-6 text-xs text-slate-400">&copy; {{ date('Y') }} Shifa Alya Dewi &middot; PBKK</p>
        </div>
    </body>
</html>
