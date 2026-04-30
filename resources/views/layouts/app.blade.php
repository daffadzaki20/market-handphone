<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-900">

    <!-- NAVBAR -->
    <nav class="bg-white shadow-md relative z-50">
        <div class="max-w-6xl mx-auto px-4 py-3 flex justify-between items-center">

            <!-- BRAND -->
            <div class="text-xl font-bold text-blue-600">
                📱 MyPhoneStore
            </div>

            <!-- MENU (DESKTOP) -->
            <div class="hidden md:flex space-x-6 text-sm font-medium">

                <a href="/dashboard" 
                   class="pb-1 transition-colors duration-200 {{ request()->is('dashboard') ? 'text-blue-600 font-bold border-b-2 border-blue-600' : 'text-gray-600 hover:text-blue-500' }}">
                   Home
                </a>

                <a href="/products/handphone" 
                   class="pb-1 transition-colors duration-200 {{ request()->is('products/handphone') ? 'text-blue-600 font-bold border-b-2 border-blue-600' : 'text-gray-600 hover:text-blue-500' }}">
                   Handphone
                </a>

                <a href="/products/aksesoris" 
                   class="pb-1 transition-colors duration-200 {{ request()->is('products/aksesoris') ? 'text-blue-600 font-bold border-b-2 border-blue-600' : 'text-gray-600 hover:text-blue-500' }}">
                   Aksesoris
                </a>

            </div>
            
            <!-- PROFILE & LOGOUT DROPDOWN -->
            <div class="relative">
                
               <!-- Profil Button (Icon/Photo) -->
<button id="profileButton" class="flex items-center text-gray-500 hover:text-blue-600 focus:outline-none transition-colors">
    
    @if(Auth::check() && Auth::user()->profile_photo)
        <!-- 1. Tampilkan Foto Profil Jika Ada -->
        <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" 
             alt="Profile" 
             class="w-8 h-8 rounded-full object-cover border border-gray-200 shadow-sm">
    @else
        <!-- 2. Tampilkan Icon Default Jika Belum Ada Foto -->
        <svg class="w-8 h-8 p-1 bg-gray-100 rounded-full border border-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
        </svg>
    @endif
    
</button>

                <!-- Dropdown Menu (Hidden by default) -->
                <div id="profileDropdown" class="hidden absolute right-0 mt-3 w-48 bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden transform transition-all">
                    
                    <a href="/profile" class="block px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Profil Saya
                    </a>
                    
                    <div class="border-t border-gray-100"></div>
                    
                    <a href="/logout" class="block px-4 py-3 text-sm text-red-500 hover:bg-red-50 transition-colors flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Logout
                    </a>

                </div>

            </div>

        </div>
    </nav>

    <!-- CONTENT WRAPPER -->
    <div class="max-w-6xl mx-auto px-4 py-6">

        @yield('content')

    </div>

    <!-- SCRIPT UNTUK MENGATUR DROPDOWN -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const profileButton = document.getElementById('profileButton');
            const profileDropdown = document.getElementById('profileDropdown');

            // Toggle dropdown saat icon diklik
            profileButton.addEventListener('click', function (event) {
                profileDropdown.classList.toggle('hidden');
                event.stopPropagation(); // Mencegah event click menyebar ke window
            });

            // Tutup dropdown jika user mengklik area lain di luar menu
            window.addEventListener('click', function (event) {
                if (!profileButton.contains(event.target) && !profileDropdown.contains(event.target)) {
                    if (!profileDropdown.classList.contains('hidden')) {
                        profileDropdown.classList.add('hidden');
                    }
                }
            });
        });
    </script>

</body>
</html>