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

            <a href="{{ route('profile.orders') }}" class="flex items-center gap-2 font-semibold text-orange-500 transition-colors">
                <span class="text-orange-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </span>
                Pesanan Saya
            </a>
            
            <a href="{{ route('profile.notifications') }}" class="flex items-center gap-2 font-semibold text-gray-700 hover:text-orange-500 transition-colors">
                <span class="text-orange-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
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

        <div class="border-t border-gray-100 my-4"></div>

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
    <!-- KONTEN UTAMA KANAN (PESANAN SAYA) -->
    <!-- ========================================== -->
    <div class="flex-1 bg-white shadow-sm border border-gray-100 rounded-md overflow-hidden">  
        <!-- Tab Menu Pesanan Dinamis dengan Badge Angka -->
        @php
            $currentStatus = request('status');
        @endphp
        <div class="flex overflow-x-auto border-b border-gray-200 scrollbar-hide">
            
            <!-- Tab Semua -->
            <a href="{{ route('profile.orders') }}" class="whitespace-nowrap flex-1 text-center py-4 px-2 text-sm font-medium border-b-2 flex items-center justify-center gap-1.5 {{ !$currentStatus ? 'border-orange-500 text-orange-500' : 'border-transparent text-gray-600 hover:text-orange-500' }}">
                <span>Semua</span>
                @if(isset($countSemua) && $countSemua > 0)
                    <span class="bg-gray-100 text-gray-600 text-[10px] font-bold px-1.5 py-0.5 rounded-full">{{ $countSemua }}</span>
                @endif
            </a>

            <!-- Tab Belum Bayar -->
            <a href="{{ route('profile.orders', ['status' => 'belum_bayar']) }}" class="whitespace-nowrap flex-1 text-center py-4 px-2 text-sm font-medium border-b-2 flex items-center justify-center gap-1.5 {{ $currentStatus == 'belum_bayar' ? 'border-orange-500 text-orange-500' : 'border-transparent text-gray-600 hover:text-orange-500' }}">
                <span>Belum Bayar</span>
                @if(isset($countBelum) && $countBelum > 0)
                    <span class="bg-orange-100 text-orange-600 text-[10px] font-bold px-1.5 py-0.5 rounded-full">{{ $countBelum }}</span>
                @endif
            </a>

            <!-- Tab Dikemas -->
            <a href="{{ route('profile.orders', ['status' => 'diproses']) }}" class="whitespace-nowrap flex-1 text-center py-4 px-2 text-sm font-medium border-b-2 flex items-center justify-center gap-1.5 {{ $currentStatus == 'diproses' ? 'border-orange-500 text-orange-500' : 'border-transparent text-gray-600 hover:text-orange-500' }}">
                <span>Dikemas</span>
                @if(isset($countDikemas) && $countDikemas > 0)
                    <span class="bg-orange-100 text-orange-600 text-[10px] font-bold px-1.5 py-0.5 rounded-full">{{ $countDikemas }}</span>
                @endif
            </a>

            <!-- Tab Dikirim -->
            <a href="{{ route('profile.orders', ['status' => 'dikirim']) }}" class="whitespace-nowrap flex-1 text-center py-4 px-2 text-sm font-medium border-b-2 flex items-center justify-center gap-1.5 {{ $currentStatus == 'dikirim' ? 'border-orange-500 text-orange-500' : 'border-transparent text-gray-600 hover:text-orange-500' }}">
                <span>Dikirim</span>
                @if(isset($countDikirim) && $countDikirim > 0)
                    <span class="bg-orange-100 text-orange-600 text-[10px] font-bold px-1.5 py-0.5 rounded-full">{{ $countDikirim }}</span>
                @endif
            </a>

            <!-- Tab Selesai -->
            <a href="{{ route('profile.orders', ['status' => 'selesai']) }}" class="whitespace-nowrap flex-1 text-center py-4 px-2 text-sm font-medium border-b-2 flex items-center justify-center gap-1.5 {{ $currentStatus == 'selesai' ? 'border-orange-500 text-orange-500' : 'border-transparent text-gray-600 hover:text-orange-500' }}">
                <span>Selesai</span>
                @if(isset($countSelesai) && $countSelesai > 0)
                    <span class="bg-gray-100 text-gray-600 text-[10px] font-bold px-1.5 py-0.5 rounded-full">{{ $countSelesai }}</span>
                @endif
            </a>

            <!-- Tab Dibatalkan -->
            <a href="{{ route('profile.orders', ['status' => 'dibatalkan']) }}" class="whitespace-nowrap flex-1 text-center py-4 px-2 text-sm font-medium border-b-2 flex items-center justify-center gap-1.5 {{ $currentStatus == 'dibatalkan' ? 'border-orange-500 text-orange-500' : 'border-transparent text-gray-600 hover:text-orange-500' }}">
                <span>Dibatalkan</span>
                @if(isset($countBatal) && $countBatal > 0)
                    <span class="bg-gray-100 text-gray-600 text-[10px] font-bold px-1.5 py-0.5 rounded-full">{{ $countBatal }}</span>
                @endif
            </a>

        </div>

        <!-- Kolom Pencarian Pesanan -->
        <div class="p-4 bg-gray-50 border-b border-gray-200">
            <div class="relative w-full">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
                <input type="text" placeholder="Cari berdasarkan No. Pesanan atau Nama Handphone" class="w-full border border-gray-300 rounded-sm pl-10 pr-4 py-2.5 text-sm focus:border-orange-500 focus:ring-1 focus:ring-orange-500 outline-none transition-colors bg-white">
            </div>
        </div>

        @if($orders->isEmpty())
            <div class="py-24 flex flex-col items-center justify-center text-gray-400">
                <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mb-5 border border-gray-100">
                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 14l2 2 4-4"></path>
                    </svg>
                </div>
                <p class="text-base font-medium text-gray-600">Belum ada pesanan</p>
                <p class="text-sm mt-1 text-center">Pesanan dengan status ini belum tersedia.</p>
            </div>
        @else
            <div class="space-y-4 p-4">
                @foreach($orders as $order)
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 hover:shadow-md transition">
                        
                        <!-- Header Kartu: No Pesanan & Status -->
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2 border-b border-gray-50 pb-3 mb-3">
                            <div>
                                <p class="text-xs text-gray-400">No. Pesanan: <span class="font-bold text-gray-700">#ORD-{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span></p>
                            </div>
                            <div>
                                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider
                                    {{ $order->status === 'diproses' ? 'bg-yellow-50 text-yellow-600 border border-yellow-200' : '' }}
                                    {{ $order->status === 'dikirim' ? 'bg-blue-50 text-blue-600 border border-blue-200' : '' }}
                                    {{ $order->status === 'selesai' ? 'bg-green-50 text-green-600 border border-green-200' : '' }}
                                    {{ $order->status === 'dibatalkan' ? 'bg-red-50 text-red-600 border border-red-200' : '' }}">
                                    {{ $order->status }}
                                </span>
                            </div>
                        </div>

                        <!-- Daftar Item Produk dalam Pesanan -->
                        <div class="space-y-3">
                            @foreach($order->items as $item)
                                <div class="flex items-center gap-4 py-2">
                                    <!-- Gambar Produk -->
                                    <div class="w-16 h-16 flex-shrink-0 bg-gray-50 rounded-xl border border-gray-100 overflow-hidden">
                                        <img src="{{ $item->product->image_url ?? asset('images/products/default.jpg') }}" alt="{{ $item->product->name ?? 'Produk' }}" class="w-full h-full object-cover">
                                    </div>
                                    <!-- Nama & Kuantitas -->
                                    <div class="flex-1 min-w-0">
                                        <h4 class="font-bold text-gray-800 text-sm truncate">{{ $item->product->name ?? 'Produk' }}</h4>
                                        <p class="text-xs text-gray-500 mt-0.5">x{{ $item->quantity }} <span class="mx-1">•</span> Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                    </div>
                                    <!-- Total Harga Item -->
                                    <div class="text-right flex-shrink-0">
                                        <p class="text-sm font-bold text-orange-500">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Footer Kartu: Tanggal, Total Keseluruhan, & Tombol Detail -->
                        <div class="mt-4 pt-3 border-t border-gray-100 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                            <div class="text-xs text-gray-400">
                                Tanggal Pesan: <span class="text-gray-600 font-medium">{{ $order->created_at->format('d M Y, H:i') }}</span>
                            </div>
                            <div class="flex items-center justify-between md:justify-end gap-4">
                                <div class="text-right">
                                    <span class="text-xs text-gray-500 mr-2">Total Tagihan:</span>
                                    <span class="text-base font-black text-orange-500">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                                </div>
                                <a href="{{ route('orders.show', $order->id) }}" class="bg-gray-100 hover:bg-orange-500 hover:text-white text-gray-700 px-4 py-2 rounded-xl text-xs font-bold transition-all shadow-sm">
                                    Detail Pesanan
                                </a>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif

    </div>

</div>

<!-- CSS Tambahan -->
<style>
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>

@endsection