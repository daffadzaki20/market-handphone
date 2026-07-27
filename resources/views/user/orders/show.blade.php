@extends('layouts.app')

@section('content')

    @php
        // Mengatur bahasa Carbon ke Indonesia untuk nama bulan (Jan, Feb, Ags, dst)
        \Carbon\Carbon::setLocale('id');
    @endphp

<div class="max-w-6xl mx-auto px-4 py-8">
    
    <!-- HEADER KEMBALI & NO PESANAN -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div class="flex items-center gap-3">
            <a href="{{ route('orders.index') }}" class="w-10 h-10 bg-white border border-gray-200 rounded-full flex items-center justify-center text-gray-600 hover:bg-gray-50 hover:text-orange-500 transition-colors shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Detail Pesanan</h1>
                <p class="text-sm text-gray-500 mt-0.5">
                    No. Pesanan: <span class="font-bold text-orange-500">#ORD-{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span> 
                    <span class="mx-2">•</span> 
                    {{ $order->created_at->translatedFormat('d F Y, H:i') }}
                </p>
            </div>
        </div>
        
        <!-- STATUS BADGE BESAR -->
        <div>
            @if($order->status === 'diproses')
                <span class="px-4 py-2 rounded-lg bg-yellow-50 border border-yellow-200 text-yellow-700 font-bold text-sm flex items-center gap-2 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Sedang Diproses
                </span>
            @elseif($order->status === 'dikirim')
                <span class="px-4 py-2 rounded-lg bg-blue-50 border border-blue-200 text-blue-700 font-bold text-sm flex items-center gap-2 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                    Sedang Dikirim
                </span>
            @elseif($order->status === 'selesai')
                <span class="px-4 py-2 rounded-lg bg-green-50 border border-green-200 text-green-700 font-bold text-sm flex items-center gap-2 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Pesanan Selesai
                </span>
            @elseif($order->status === 'dibatalkan' || $order->status === 'ditolak')
                <span class="px-4 py-2 rounded-lg bg-red-50 border border-red-200 text-red-700 font-bold text-sm flex items-center gap-2 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    Pesanan {{ ucfirst($order->status) }}
                </span>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- KOLOM KIRI (Info Pengiriman & Produk) -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Alamat Pengiriman -->
            <div class="bg-white p-5 md:p-6 rounded-2xl border border-gray-100 shadow-sm mb-6">
                <div class="flex items-center gap-2 mb-4">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <h3 class="font-bold text-gray-800 text-sm md:text-base">Alamat Pengiriman</h3>
                </div>
                
                <div class="ml-7">
                    @if($order->alamat)
                        <p class="font-bold text-gray-800 text-sm mb-1">
                            {{ $order->user->name }} 
                            <span class="text-gray-300 mx-1">|</span> 
                            <span class="text-gray-500 font-normal">{{ $order->user->phone_number }}</span>
                        </p>
                        <p class="text-sm text-gray-600 leading-relaxed mt-1">
                            <span class="font-semibold text-gray-700">{{ $order->alamat->label ?? 'Alamat' }}:</span> 
                            {{ $order->alamat->alamat_detail }}, <br>
                            @if($order->alamat->rt && $order->alamat->rw)
                                RT.{{ str_pad($order->alamat->rt, 3, '0', STR_PAD_LEFT) }}/RW.{{ str_pad($order->alamat->rw, 3, '0', STR_PAD_LEFT) }},
                            @endif
                            {{ $order->alamat->desa }}, {{ $order->alamat->kecamatan }}, <br>
                            {{ $order->alamat->kabupaten }}, {{ $order->alamat->provinsi }}, {{ $order->alamat->kode_pos }}
                        </p>
                    @else
                        <p class="text-sm text-red-500 italic bg-red-50 p-3 rounded-lg border border-red-100">
                            ⚠️ Alamat pengiriman tidak ditemukan atau belum dipilih saat checkout.
                        </p>
                    @endif
                </div>
            </div>

            <!-- DAFTAR PRODUK DIPESAN -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-gray-50/50 border-b border-gray-100 px-6 py-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    <h3 class="font-bold text-gray-800 text-base">Rincian Produk</h3>
                </div>
                
                <div class="p-6 space-y-4">
                    @foreach($order->items as $item)
                        <div class="flex items-start gap-4 pb-4 border-b border-gray-50 last:border-0 last:pb-0">
                            <!-- Gambar Produk -->
                            <div class="w-20 h-20 flex-shrink-0 bg-gray-50 rounded-xl border border-gray-100 overflow-hidden">
                                <img src="{{ $item->product->image_url ?? asset('images/products/default.jpg') }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                            </div>
                            
                            <!-- Detail Produk -->
                            <div class="flex-1 min-w-0 pt-1">
                                <h4 class="font-bold text-gray-800 text-sm md:text-base line-clamp-2">{{ $item->product->name }}</h4>
                                <p class="text-xs text-gray-500 mt-1">Harga Satuan: Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                            
                            <!-- Harga & Kuantitas -->
                            <div class="text-right pt-1 flex-shrink-0">
                                <p class="text-sm text-gray-500 mb-1">x{{ $item->quantity }}</p>
                                <p class="font-bold text-orange-500">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- KOLOM KANAN (Rincian Pembayaran, Informasi Tambahan & Aksi) -->
        <div class="space-y-6">
            
            <!-- RINCIAN PEMBAYARAN MENDETAIL -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-gray-50/50 border-b border-gray-100 px-6 py-4">
                    <h3 class="font-bold text-gray-800 text-base">Ringkasan Belanja</h3>
                </div>
                
                <div class="p-6 space-y-3 text-sm">
                    <div class="flex justify-between items-center text-gray-600">
                        <span>Total Harga ({{ $order->items->sum('quantity') }} Barang)</span>
                        <span class="font-medium text-gray-800">Rp {{ number_format($order->subtotal ?? 0, 0, ',', '.') }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center text-gray-600">
                        <span>Total Ongkos Kirim ({{ $order->metode_pengiriman ?? 'Reguler' }})</span>
                        <span class="font-medium text-gray-800">Rp {{ number_format($order->ongkir ?? 0, 0, ',', '.') }}</span>
                    </div>

                    @if($order->proteksi > 0)
                    <div class="flex justify-between items-center text-gray-600">
                        <span>Proteksi Kerusakan Total</span>
                        <span class="font-medium text-gray-800">Rp {{ number_format($order->proteksi, 0, ',', '.') }}</span>
                    </div>
                    @endif

                    <div class="flex justify-between items-center text-gray-600">
                        <span>Biaya Layanan & Jasa</span>
                        <span class="font-medium text-gray-800">Rp {{ number_format($order->biaya_layanan ?? 0, 0, ',', '.') }}</span>
                    </div>

                    @if($order->diskon_voucher > 0)
                    <div class="flex justify-between items-center text-green-600">
                        <span>Diskon Voucher</span>
                        <span class="font-bold">- Rp {{ number_format($order->diskon_voucher, 0, ',', '.') }}</span>
                    </div>
                    @endif

                    <div class="pt-4 mt-2 border-t border-dashed border-gray-200">
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-gray-800">Total Belanja</span>
                            <span class="text-xl font-black text-orange-500">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- INFORMASI TAMBAHAN (METODE PEMBAYARAN & PESAN) -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-gray-50/50 border-b border-gray-100 px-6 py-4">
                    <h3 class="font-bold text-gray-800 text-base">Informasi Tambahan</h3>
                </div>
                <div class="p-6 space-y-4 text-sm">
                    <div>
                        <span class="text-gray-500 block mb-1">Metode Pembayaran:</span>
                        <span class="font-bold text-orange-600 bg-orange-50 px-3 py-1 border border-orange-100 rounded-md inline-block uppercase text-xs tracking-wider">
                            @if(str_starts_with($order->metode_pembayaran, 'ewallet_'))
                                💳 E-Wallet
                            @elseif(str_starts_with($order->metode_pembayaran, 'kartu_'))
                                🏦 Kartu Tersimpan
                            @else
                                💵 Bayar di Tempat (COD)
                            @endif
                        </span>
                    </div>

                    @if($order->pesan)
                    <div>
                        <span class="text-gray-500 block mb-1">Pesan dari Anda:</span>
                        <span class="text-gray-800 italic bg-gray-50 p-2.5 rounded-md block border border-gray-100">"{{ $order->pesan }}"</span>
                    </div>
                    @endif

                    @if($order->catatan_admin)
                    <div class="mt-3 p-3 bg-blue-50 border border-blue-100 rounded-lg">
                        <span class="text-blue-800 font-bold text-[10px] uppercase tracking-widest block mb-1">Catatan dari Penjual:</span>
                        <span class="text-gray-800 font-medium text-sm">{{ $order->catatan_admin }}</span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- AKSI PEMBATALAN -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden p-6">
                @if($order->status == 'diproses')
                    <div class="text-center">
                        <div class="w-12 h-12 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                        <h4 class="font-bold text-gray-800 mb-1">Berubah Pikiran?</h4>
                        <p class="text-xs text-gray-500 mb-4 leading-relaxed">Anda dapat membatalkan pesanan ini selama admin belum memproses pengiriman paket Anda.</p>
                        
                        <!-- PENTING: Rute pembatalan -->
                        <form action="{{ route('orders.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini secara permanen?')">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="w-full bg-white border border-red-200 hover:bg-red-50 text-red-600 font-bold py-2.5 px-4 rounded-xl transition-all text-sm">
                                Batalkan Pesanan
                            </button>
                        </form>
                    </div>
                @elseif($order->status == 'dibatalkan' || $order->status == 'ditolak')
                    <div class="text-center py-2">
                        <div class="w-12 h-12 bg-red-50 text-red-400 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                        </div>
                        <h4 class="font-bold text-gray-500 mb-1">Pesanan Dibatalkan</h4>
                        <p class="text-xs text-gray-400">Pesanan ini telah dibatalkan atau ditolak dan tidak diproses lebih lanjut.</p>
                    </div>
                @else
                    <div class="text-center py-2">
                        <div class="w-12 h-12 bg-blue-50 text-blue-500 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h4 class="font-bold text-gray-800 mb-1">Pembatalan Dikunci</h4>
                        <p class="text-xs text-gray-500">Pesanan Anda sudah dalam tahap pengiriman/selesai. Anda tidak dapat membatalkannya lagi.</p>
                    </div>
                @endif
            </div>

        </div>

    </div>
</div>

@endsection