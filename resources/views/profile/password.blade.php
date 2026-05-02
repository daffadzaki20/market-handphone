
<x-app-layout>

<!-- Wrapper Utama -->
<div class="max-w-6xl mx-auto px-4 py-6 md:py-8 flex flex-col md:flex-row gap-4 md:gap-3">

    <!-- ========================================== -->
    <!-- SIDEBAR KIRI -->
    <!-- ========================================== -->
    <div class="w-full md:w-48 flex-shrink-0">
        
        <!-- User Mini Profile -->
        <div class="flex items-center gap-3 mb-6 pb-6 border-b border-gray-200">
            @if(Auth::user()->profile_photo)
                <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Avatar" class="w-12 h-12 rounded-full object-cover border border-gray-200">
            @else
                <div class="w-12 h-12 bg-slate-500 text-white rounded-full flex items-center justify-center text-xl font-semibold">
                    {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                </div>
            @endif
            
            <div class="overflow-hidden">
                <div class="font-bold text-gray-800 truncate">{{ Auth::user()->username }}</div>
                <a href="/profile" class="text-sm text-gray-500 flex items-center gap-1 mt-0.5 hover:text-orange-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    Ubah Profil
                </a>
            </div>
        </div>

        <!-- Menu Navigasi Sidebar -->
        <nav class="space-y-5 text-sm">
            <!-- Menu: Akun Saya -->
            <div>
                <div class="flex items-center gap-2 font-semibold text-gray-800 mb-2 cursor-pointer hover:text-orange-500 transition-colors">
                    <span class="text-blue-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </span>
                    Akun Saya
                </div>
                
                <div class="pl-7 space-y-3 mt-2">
                    <a href="/profile" class="block text-gray-600 hover:text-orange-500 transition-colors">Profil</a>
                    <a href="/profile/bank" class="block text-gray-600 hover:text-orange-500 transition-colors">Bank & Kartu</a>
                    <a href="/profile/alamat" class="block text-gray-600 hover:text-orange-500 transition-colors">Alamat</a>
                    <a href="/profile/password" class="block text-orange-500 font-medium">Ubah Password</a>
                </div>
            </div>

            <!-- Menu Lainnya -->
            <a href="/profile/pesanan" class="flex items-center gap-2 font-semibold text-gray-700 hover:text-orange-500 transition-colors">
                <span class="text-blue-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </span>
                Pesanan Saya
            </a>
            
           <a href="/profile/notifikasi" class="flex items-center gap-2 font-semibold text-gray-700 hover:text-orange-500 transition-colors">
            <span class="text-orange-500">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
            </span>
            Notifikasi
        </a>

           <a href="/profile/voucher" class="flex items-center gap-2 font-semibold text-gray-700 hover:text-orange-500 transition-colors">
                <span class="text-orange-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                </span>
                Voucher Saya
            </a>
        </nav>

        <!-- Garis Pembatas -->
            <div class="border-t border-gray-100 my-4"></div>

            <!-- Menu Logout di Sidebar -->
            <a href="/logout" class="flex items-center gap-2 font-semibold text-red-500 hover:bg-red-50 p-2 rounded-lg transition-colors">
                <span class="text-red-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                </span>
                Keluar
            </a>
    </div>

    <!-- ========================================== -->
    <!-- KONTEN UTAMA KANAN (UBAH PASSWORD) -->
    <!-- ========================================== -->
    <div class="flex-1 bg-white shadow-sm border border-gray-100 rounded-md p-5 md:p-8">  
        
        <!-- Header -->
        <div class="border-b border-gray-200 pb-4 mb-6 md:mb-8">
            <h1 class="text-xl font-medium text-gray-800">Ubah Password</h1>
            <p class="text-sm text-gray-500 mt-1">Pastikan akun Anda menggunakan password yang panjang dan unik.</p>
        </div>

        <div class="max-w-2xl">
            <!-- Alert Pesan Sukses -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Blok Error -->
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6 text-sm">
                    <strong class="font-bold">Gagal Mengubah Password!</strong>
                    <ul class="list-disc pl-5 mt-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

           <!-- Form Ubah Password -->
            <form action="/profile/password" method="POST">
                @csrf
                
                <!-- Password Lama -->
                <div class="flex flex-col sm:flex-row sm:items-center mb-5 md:mb-6">
                    <label class="sm:w-1/3 sm:text-right pr-5 text-sm text-gray-500 mb-1.5 sm:mb-0">Password Saat Ini</label>
                    <div class="sm:w-2/3">
                        <!-- Triknya: Buat DIV pembungkus yang berfungsi SEPERTI INPUT (ada border) -->
                        <div class="flex items-center w-full border border-gray-300 rounded-sm focus-within:border-orange-500 focus-within:ring-1 focus-within:ring-orange-500 overflow-hidden bg-white transition-colors">
                            
                            <!-- Inputnya dibuat tanpa border (border-none) agar menyatu dengan div pembungkus -->
                            <input type="password" id="current_password" name="current_password" required class="flex-1 w-full pl-3 py-2 text-sm outline-none border-none ring-0 bg-transparent">
                            
                            <!-- Ikon berada di dalam div yang sama, tapi rata kanan -->
                            <button type="button" onclick="togglePassword('current_password', 'icon_current')" class="px-3 text-gray-400 hover:text-orange-500 transition-colors focus:outline-none flex-shrink-0">
                                <svg id="icon_current" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Password Baru -->
                <div class="flex flex-col sm:flex-row sm:items-center mb-5 md:mb-6">
                    <label class="sm:w-1/3 sm:text-right pr-5 text-sm text-gray-500 mb-1.5 sm:mb-0">Password Baru</label>
                    <div class="sm:w-2/3">
                        <div class="flex items-center w-full border border-gray-300 rounded-sm focus-within:border-orange-500 focus-within:ring-1 focus-within:ring-orange-500 overflow-hidden bg-white transition-colors">
                            <input type="password" id="new_password" name="password" required class="flex-1 w-full pl-3 py-2 text-sm outline-none border-none ring-0 bg-transparent">
                            <button type="button" onclick="togglePassword('new_password', 'icon_new')" class="px-3 text-gray-400 hover:text-orange-500 transition-colors focus:outline-none flex-shrink-0">
                                <svg id="icon_new" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Konfirmasi Password Baru -->
                <div class="flex flex-col sm:flex-row sm:items-center mb-8">
                    <label class="sm:w-1/3 sm:text-right pr-5 text-sm text-gray-500 mb-1.5 sm:mb-0">Konfirmasi Password</label>
                    <div class="sm:w-2/3">
                        <div class="flex items-center w-full border border-gray-300 rounded-sm focus-within:border-orange-500 focus-within:ring-1 focus-within:ring-orange-500 overflow-hidden bg-white transition-colors">
                            <input type="password" id="confirm_password" name="password_confirmation" required class="flex-1 w-full pl-3 py-2 text-sm outline-none border-none ring-0 bg-transparent">
                            <button type="button" onclick="togglePassword('confirm_password', 'icon_confirm')" class="px-3 text-gray-400 hover:text-orange-500 transition-colors focus:outline-none flex-shrink-0">
                                <svg id="icon_confirm" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Tombol Simpan -->
                <div class="flex flex-col sm:flex-row sm:items-center">
                    <div class="sm:w-1/3 pr-5 hidden sm:block"></div>
                    <div class="sm:w-2/3">
                        <button type="submit" class="w-full sm:w-auto bg-orange-500 hover:bg-orange-600 text-white px-8 py-2.5 rounded-sm text-sm font-medium transition-colors shadow-sm focus:outline-none">
                            Ubah Password
                        </button>
                    </div>
                </div>

            </form>
        </div>

    </div>

</div>

<!-- SCRIPT UNTUK SHOW/HIDE PASSWORD -->
<script>
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);

        // SVG untuk ikon Mata Terbuka (Show)
        const eyeOpen = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
        `;
        
        // SVG untuk ikon Mata Tercoret (Hide)
        const eyeClosed = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
        `;

        if (input.type === 'password') {
            input.type = 'text'; // Tampilkan teks
            icon.innerHTML = eyeClosed; // Ubah ke ikon coret
        } else {
            input.type = 'password'; // Sembunyikan teks
            icon.innerHTML = eyeOpen; // Ubah ke ikon mata terbuka
        }
    }
</script>


</x-app-layout>