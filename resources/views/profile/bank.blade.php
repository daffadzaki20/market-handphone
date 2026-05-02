
<x-app-layout>
<!-- Wrapper Utama -->
<div class="max-w-6xl mx-auto px-4 py-6 md:py-8 flex flex-col md:flex-row gap-4 md:gap-3">

    <!-- ========================================== -->
    <!-- SIDEBAR KIRI -->
    <!-- ========================================== -->
<div class="w-full md:w-48 flex-shrink-0">
        
        <!-- User Mini Profile -->
        <div class="flex items-center gap-3 mb-6 pb-6 border-b border-gray-200">
            <!-- Avatar Mini -->
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
                    <!-- Perhatikan class warnanya berubah karena ini halaman Bank -->
                    <a href="/profile" class="block text-gray-600 hover:text-orange-500 transition-colors">Profil</a>
                    <a href="/profile/bank" class="block text-orange-500 font-medium">Bank & Kartu</a>
                    <a href="/profile/alamat" class="block text-gray-600 hover:text-orange-500 transition-colors">Alamat</a>
                    <a href="/profile/password" class="block text-gray-600 hover:text-orange-500 transition-colors">Ubah Password</a>
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
    <!-- KONTEN UTAMA KANAN (BANK & KARTU) -->
    <!-- ========================================== -->
   <div class="flex-1 bg-white shadow-sm border border-gray-100 rounded-md p-6 md:p-8">
        <!-- BAGIAN 1: KARTU KREDIT / DEBIT -->
        <div class="border-b border-gray-200 pb-4 mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-xl font-medium text-gray-800">Kartu Kredit / Debit</h1>
            </div>
            <button class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-sm text-sm font-medium transition-colors shadow-sm flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Kartu Baru
            </button>
        </div>

        <!-- Empty State Kartu (Visual Placeholder) -->
        <div class="py-12 flex flex-col items-center justify-center text-gray-400 mb-10">
            <svg class="w-16 h-16 mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
            <p class="text-sm">Anda belum memiliki kartu kredit / debit yang tersimpan.</p>
        </div>


        <!-- BAGIAN 2: REKENING BANK -->
        <div class="border-b border-gray-200 pb-4 mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-xl font-medium text-gray-800">Rekening Bank Saya</h1>
            </div>
            <button class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-sm text-sm font-medium transition-colors shadow-sm flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Rekening Bank
            </button>
        </div>

        <!-- Empty State Rekening (Visual Placeholder) -->
        <div class="py-12 flex flex-col items-center justify-center text-gray-400">
            <svg class="w-16 h-16 mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path></svg>
            <p class="text-sm">Anda belum memiliki rekening bank yang tersimpan.</p>
        </div>

    </div>

</div>


</x-app-layout>