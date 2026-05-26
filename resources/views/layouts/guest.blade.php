<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Login</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-blue-50 to-gray-200">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-lg overflow-hidden sm:rounded-xl border border-gray-100">
                <div class="text-center mb-6 mt-2">
                    <h2 class="text-xl font-bold text-gray-800">Selamat Datang</h2>
                    <p class="text-sm text-gray-500">Silakan login untuk mengakses ruang kerja.</p>
                </div>
                
                {{ $slot }}
            </div>
            
            <div class="mt-8 text-xs text-gray-400">
                &copy; {{ date('Y') }} 22 DESIGN Studio. All rights reserved.
            </div>
        </div>
    </body>
</html>