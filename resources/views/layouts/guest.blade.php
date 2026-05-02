<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'MyPhoneStore') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-50">
        
        <!-- Pembungkus Utama (Tengah Layar) -->
        <div class="min-h-screen flex flex-col justify-center items-center py-10">
            
            <!-- Logo Laravel Dihapus -->

            <!-- Slot Konten (Dihilangkan kotak putih bawaannya agar tidak double-box) -->
            <div class="w-full px-4 sm:px-6 lg:px-8 flex justify-center mt-6">
                {{ $slot }}
            </div>
            
        </div>
        
    </body>
</html>