<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'MyPhoneStore')</title>

    <!-- Tailwind CSS via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 overflow-x-hidden">

    <div class="flex h-screen overflow-hidden">
        
        <!-- SIDEBAR -->
        <aside class="hidden md:flex flex-col w-64 bg-white border-r border-gray-200">
            <!-- Brand Logo -->
            <div class="p-6 border-b border-gray-100">
                <div class="flex items-center gap-2 font-bold text-xl text-blue-600">
                    <span>📱</span>
                    <span>MyPhoneStore</span>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 overflow-y-auto p-4 space-y-1">
                <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Main Menu</p>
                
                <a href="/dashboard" class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-200 rounded-lg hover:bg-blue-50 hover:text-blue-600 group">
                    <span class="mr-3 text-lg">📊</span>
                    <span class="font-medium">Dashboard</span>
                </a>

                <div class="pt-4">
                    <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Master Data</p>
                    
                    <!-- Menu Handphone -->
                    <a href="/handphones" class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-200 rounded-lg hover:bg-blue-50 hover:text-blue-600 group">
                        <span class="mr-3 text-lg">📱</span>
                        <span class="font-medium">Data Handphone</span>
                    </a>

                    <!-- Menu Aksesoris -->
                    <a href="/accessories" class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-200 rounded-lg hover:bg-blue-50 hover:text-blue-600 group">
                        <span class="mr-3 text-lg">🎧</span>
                        <span class="font-medium">Data Aksesoris</span>
                    </a>
                </div>

                <div class="pt-4 border-t border-gray-100 mt-4">
                    <a href="/settings" class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-200 rounded-lg hover:bg-gray-100 group">
                        <span class="mr-3 text-lg">⚙️</span>
                        <span class="font-medium">Settings</span>
                    </a>
                </div>
            </nav>

            <!-- User Info / Logout -->
            <div class="p-4 border-t border-gray-100 bg-gray-50">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold text-xs">
                            AD
                        </div>
                        <span class="text-sm font-semibold text-gray-700">Admin</span>
                    </div>
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="text-red-500 hover:text-red-700 p-1 rounded-md hover:bg-red-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- MAIN AREA -->
        @include('layouts/sidebar_admin')

            <!-- MAIN CONTENT -->
            <main class="flex-1 overflow-y-auto p-6">
                <!-- Bagian ini akan diisi oleh konten dari halaman lain -->
                <div class="max-w-7xl mx-auto">
                    @yield('content')
                </div>
            </main>

        </div>
    </div>

</body>
</html>