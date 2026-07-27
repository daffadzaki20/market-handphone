@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">
    
    <!-- Header Halaman -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
            </svg>
            Pesanan Saya (Aktif & Riwayat)
        </h2>
    </div>

    <!-- Ambil data pesanan KECUALI yang berstatus 'selesai' -->
    @php
        // Menyaring pesanan agar status 'selesai' tidak ditampilkan di halaman ini
        $activeOrders = $orders->where('status', '!=', 'selesai');
    @endphp

    @if($activeOrders->isEmpty())
        <!-- Tampilan Jika Kosong -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 py-20 px-4 flex flex-col items-center justify-center text-center">
            <div class="w-20 h-20 bg-orange-50 text-orange-500 rounded-full flex items-center justify-center mb-4">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <p class="text-lg font-bold text-gray-800">Tidak ada pesanan aktif</p>
            <p class="text-sm text-gray-500 mt-1 max-w-sm">Saat ini Anda tidak memiliki pesanan yang sedang diproses, dikirim, atau dibatalkan.</p>
            <a href="{{ url('/') }}" class="mt-6 bg-orange-500 hover:bg-orange-600 text-white font-bold px-6 py-2.5 rounded-xl text-sm transition shadow-lg shadow-orange-200">
                Mulai Belanja
            </a>
        </div>
    @else
        <!-- Daftar Pesanan Berbentuk Kartu Modern -->
        <div class="space-y-4">
            @foreach($activeOrders as $order)
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 hover:shadow-md transition">
                    
                    <!-- Top Card: No Pesanan & Status -->
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-4 border-b border-gray-50 mb-4">
                        <div>
                            <span class="text-xs text-gray-400">No. Pesanan:</span>
                            <span class="font-bold text-gray-800 text-sm ml-1">#ORD-{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span>
                            <span class="mx-2 text-gray-300">•</span>
                            <span class="text-xs text-gray-500">{{ $order->created_at->format('d M Y, H:i') }}</span>
                        </div>
                        <div>
                            <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider
                                {{ $order->status === 'diproses' ? 'bg-yellow-50 text-yellow-700 border border-yellow-200' : '' }}
                                {{ $order->status === 'dikirim' ? 'bg-blue-50 text-blue-700 border border-blue-200' : '' }}
                                {{ $order->status === 'dibatalkan' ? 'bg-red-50 text-red-700 border border-red-200' : '' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>

                    <!-- Items Preview -->
                    <div class="space-y-3">
                        @foreach($order->items as $item)
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 bg-gray-50 rounded-xl border border-gray-100 overflow-hidden flex-shrink-0">
                                    <img src="{{ $item->product->image_url ?? asset('images/products/default.jpg') }}" alt="" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-bold text-gray-800 text-sm truncate">{{ $item->product->name ?? 'Produk' }}</h4>
                                    <p class="text-xs text-gray-500 mt-0.5">x{{ $item->quantity }} <span class="mx-1">•</span> Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Bottom Card: Total & Tombol Aksi -->
                    <div class="mt-4 pt-4 border-t border-gray-50 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <span class="text-xs text-gray-500">Total Tagihan:</span>
                            <span class="text-base font-black text-orange-500 ml-1">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                        </div>
                        <div>
                            <a href="{{ route('orders.show', $order->id) }}" 
                               class="inline-flex items-center justify-center bg-gray-900 hover:bg-orange-500 text-white font-bold px-5 py-2 rounded-xl text-xs transition shadow-sm">
                                Lihat Detail Pesanan
                            </a>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    @endif

</div>
@endsection