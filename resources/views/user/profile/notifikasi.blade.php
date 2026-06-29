@extends('layouts.app')

@section('content')

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
                <a href="{{ route('profile.edit') }}" class="text-sm text-gray-500 flex items-center gap-1 mt-0.5 hover:text-orange-500 transition-colors">
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
                    <a href="{{ route('profile.edit') }}" class="block text-gray-600 hover:text-orange-500 transition-colors">Profil</a>
                    <a href="{{ route('profile.bank') }}" class="block text-gray-600 hover:text-orange-500 transition-colors">Bank & Kartu</a>
                    <a href="{{ route('alamat.index') }}" class="block text-gray-600 hover:text-orange-500 transition-colors">Alamat</a>
                    <a href="{{ route('profile.password') }}" class="block text-gray-600 hover:text-orange-500 transition-colors">Ubah Password</a>
                </div>
            </div>

            <!-- Menu Lainnya -->
            <a href="{{ route('profile.orders') }}" class="flex items-center gap-2 font-semibold text-gray-700 hover:text-orange-500 transition-colors">
                <span class="text-blue-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </span>
                Pesanan Saya
            </a>
            
            <!-- 👇 Menu Notifikasi SEKARANG AKTIF (Oranye) 👇 -->
            <a href="{{ route('profile.notifications') }}" class="flex items-center gap-2 font-semibold text-orange-500 transition-colors">
                <span class="text-orange-500">
                    <!-- Icon Lonceng -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                </span>
                Notifikasi
            </a>

           <a href="{{ route('profile.voucher') }}" class="flex items-center gap-2 font-semibold text-gray-700 hover:text-orange-500 transition-colors">
                <span class="text-orange-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                </span>
                Voucher Saya
            </a>
        </nav>

        <!-- Garis Pembatas -->
            <div class="border-t border-gray-100 my-4"></div>

            <!-- Menu Logout di Sidebar -->
            <form method="POST" action="{{ route('logout') }}" class="flex items-center gap-2 font-semibold text-red-500 hover:bg-red-50 p-2 rounded-lg transition-colors">
                @csrf
                <button type="submit" class="flex items-center gap-2 w-full text-left">
                    <span class="text-red-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                    </span>
                    Logout
                </button>
            </form>
    </div>

    <!-- ========================================== -->
    <!-- KONTEN UTAMA KANAN (NOTIFIKASI) -->
    <!-- ========================================== -->
    <div class="flex-1 bg-white shadow-sm border border-gray-100 rounded-md overflow-hidden flex flex-col">  
        
        <!-- Header -->
        <div class="border-b border-gray-200 p-5 md:p-6 flex justify-between items-center bg-white">
            <h1 class="text-xl font-medium text-gray-800">Notifikasi</h1>
            <button class="text-sm text-orange-500 hover:text-orange-600 font-medium transition-colors">
                Tandai semua dibaca
            </button>
        </div>

        <!-- Daftar Notifikasi -->
        <div class="flex flex-col">
            
            <!-- Item Notifikasi 1 (Belum Dibaca - background agak oranye) -->
            <a href="#" class="flex gap-4 p-5 md:p-6 border-b border-gray-100 bg-orange-50 hover:bg-orange-100/50 transition-colors cursor-pointer group">
                <!-- Icon -->
                <div class="w-12 h-12 flex-shrink-0 bg-white border border-orange-200 text-orange-500 rounded-full flex items-center justify-center shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                </div>
                <!-- Konten -->
                <div class="flex-1">
                    <h3 class="text-base font-semibold text-gray-800 mb-1">Pesanan Anda Telah Dikirim!</h3>
                    <p class="text-sm text-gray-600 leading-relaxed mb-2">Pesanan <span class="font-medium">#INV-202604-001</span> (Samsung Galaxy S24 Ultra) sedang dalam perjalanan menuju alamat Anda oleh kurir JNE.</p>
                    <span class="text-xs text-gray-400">Hari ini, 10:30 WIB</span>
                </div>
                <!-- Titik merah tanda belum dibaca -->
                <div class="w-2.5 h-2.5 bg-orange-500 rounded-full mt-2"></div>
            </a>

            <!-- Item Notifikasi 2 (Sudah Dibaca - background putih biasa) -->
            <a href="#" class="flex gap-4 p-5 md:p-6 border-b border-gray-100 bg-white hover:bg-gray-50 transition-colors cursor-pointer group">
                <div class="w-12 h-12 flex-shrink-0 bg-blue-50 text-blue-500 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-base font-medium text-gray-700 mb-1">Pembayaran Berhasil Diverifikasi</h3>
                    <p class="text-sm text-gray-500 leading-relaxed mb-2">Pembayaran untuk pesanan #INV-202604-001 telah kami terima. Penjual sedang menyiapkan pesanan Anda.</p>
                    <span class="text-xs text-gray-400">Kemarin, 14:15 WIB</span>
                </div>
            </a>

            <!-- Item Notifikasi 3 (Sudah Dibaca) -->
            <a href="#" class="flex gap-4 p-5 md:p-6 border-b border-gray-100 bg-white hover:bg-gray-50 transition-colors cursor-pointer group">
                <div class="w-12 h-12 flex-shrink-0 bg-green-50 text-green-500 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"></path></svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-base font-medium text-gray-700 mb-1">Promo Khusus Pengguna Baru! 🎉</h3>
                    <p class="text-sm text-gray-500 leading-relaxed mb-2">Selamat datang di MyPhoneStore! Nikmati cashback hingga Rp100.000 untuk pembelian pertama Anda menggunakan kode voucher: <strong>NEWPHONE100</strong>.</p>
                    <span class="text-xs text-gray-400">3 Hari yang lalu</span>
                </div>
            </a>

            <!-- Tombol Muat Lebih Banyak -->
            <div class="p-6 text-center bg-gray-50/50">
                <button class="text-sm font-medium text-gray-500 hover:text-orange-500 transition-colors">
                    Muat Lebih Banyak Notifikasi
                </button>
            </div>

        </div>
    </div>

</div>


@endsection
