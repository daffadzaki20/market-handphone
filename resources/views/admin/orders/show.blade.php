@extends('layouts.app_admin')

@section('content')
<div class="max-w-5xl mx-auto p-6">
    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('admin.orders.index') }}" class="text-blue-600 hover:text-blue-800 font-bold flex items-center gap-2 transition">
            ← Kembali ke Daftar Pesanan
        </a>
        <span class="bg-gray-100 text-gray-700 px-4 py-1.5 rounded-full text-sm font-black border border-gray-200">
            Order #ORD-{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
        </span>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        
        <!-- Informasi Header -->
        <div class="grid grid-cols-1 md:grid-cols-2 p-6 border-b border-gray-100 gap-6">
            <div>
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Informasi Pelanggan</h3>
                <p class="font-black text-gray-800 text-lg">{{ $order->user->name ?? 'User Dihapus' }}</p>
                <p class="text-gray-500 text-sm mt-1">{{ $order->user->email ?? '-' }} <span class="mx-1">•</span> {{ $order->user->phone_number ?? '-' }}</p>
            </div>
            <div>
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Status Pesanan Saat Ini</h3>
                <p class="font-bold text-blue-600 text-lg capitalize">{{ $order->status }}</p>
                <p class="text-gray-500 text-sm">Dibuat: {{ $order->created_at->format('d F Y, H:i') }}</p>
            </div>
        </div>

        <!-- Alamat Pengiriman & Pesan Pembeli -->
        <div class="p-6 border-b border-gray-100 bg-gray-50/50">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kolom Alamat -->
                <div>
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Alamat Pengiriman</h3>
                    @if($order->alamat)
                        <p class="text-sm text-gray-700 leading-relaxed">
                            <span class="font-semibold">{{ $order->alamat->label ?? 'Alamat' }}:</span><br>
                            {{ $order->alamat->alamat_detail }}<br>
                            @if($order->alamat->rt && $order->alamat->rw)
                                RT.{{ str_pad($order->alamat->rt, 3, '0', STR_PAD_LEFT) }}/RW.{{ str_pad($order->alamat->rw, 3, '0', STR_PAD_LEFT) }},
                            @endif
                            {{ $order->alamat->desa }}, {{ $order->alamat->kecamatan }}<br>
                            {{ $order->alamat->kabupaten }}, {{ $order->alamat->provinsi }}, {{ $order->alamat->kode_pos }}
                        </p>
                    @else
                        <p class="text-sm text-red-500 italic bg-red-50 p-2 rounded border border-red-100 inline-block">Alamat tidak ditemukan.</p>
                    @endif
                </div>

                <!-- Kolom Informasi Tambahan -->
                <div>
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Informasi Tambahan</h3>
                    
                    <p class="text-sm text-gray-700 mb-3">
                        <span class="font-semibold block mb-1">Metode Pembayaran:</span>
                        <span class="uppercase font-bold text-orange-600 bg-orange-50 px-2.5 py-1 rounded border border-orange-100 text-xs tracking-wider">
                            @if(str_starts_with($order->metode_pembayaran, 'ewallet_'))
                                E-Wallet
                            @elseif(str_starts_with($order->metode_pembayaran, 'kartu_'))
                                Kartu Tersimpan
                            @else
                                Bayar di Tempat (COD)
                            @endif
                        </span>
                    </p>

                    <p class="text-sm text-gray-700">
                        <span class="font-semibold block mb-1">Pesan dari Pembeli:</span>
                        @if($order->pesan)
                            <span class="italic bg-white border border-gray-200 p-2.5 rounded-md block text-gray-800 shadow-sm">"{{ $order->pesan }}"</span>
                        @else
                            <span class="italic text-gray-400">- Tidak ada pesan -</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- KONSEP FEEDBACK & UPDATE STATUS KE USER -->
        <!-- ========================================== -->
        <div class="m-6 p-6 bg-blue-50/50 rounded-2xl border border-blue-100">
            <div class="flex items-start gap-3 mb-4">
                <div class="mt-0.5 text-blue-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-blue-900">Pembaruan Status & Feedback Pelanggan</h3>
                    <p class="text-xs text-blue-700/80 mt-1">Mengubah status di bawah ini akan secara otomatis memperbarui pesanan dan mengirimkan <strong>Notifikasi Lonceng & Email</strong> ke pelanggan.</p>
                </div>
            </div>

            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="flex flex-col gap-4 ml-8">
                @csrf
                @method('PUT')
                
                <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center w-full">
                    <select name="status" class="rounded-xl border-blue-200 text-blue-900 bg-white w-full sm:w-64 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm font-semibold shadow-sm">
                        <option value="belum_bayar" {{ $order->status == 'belum_bayar' ? 'selected' : '' }}>⏳ Belum Bayar</option>
                        <option value="diproses" {{ $order->status == 'diproses' ? 'selected' : '' }}>⚙️ Diproses</option>
                        <option value="dikirim" {{ $order->status == 'dikirim' ? 'selected' : '' }}>🚚 Dikirim</option>
                        <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>✅ Selesai</option>
                        <option value="ditolak" {{ $order->status == 'ditolak' ? 'selected' : '' }}>❌ Ditolak</option>
                        <option value="dibatalkan" {{ $order->status == 'dibatalkan' ? 'selected' : '' }}>🚫 Dibatalkan</option>
                    </select>
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2.5 rounded-xl text-sm font-bold hover:bg-blue-700 transition shadow-sm w-full sm:w-auto">
                        Kirim Pembaruan ke User
                    </button>
                </div>

                <!-- FORM CATATAN ADMIN -->
                <div class="w-full mt-2">
                    <label class="block text-xs font-bold text-blue-800 mb-1">Catatan untuk Pembeli (Opsional)</label>
                    <textarea name="catatan_admin" rows="2" class="w-full rounded-xl border-blue-200 focus:ring-2 focus:ring-blue-500 text-sm p-3 shadow-sm" placeholder="Contoh: Nomor Resi JNT: 123456789 atau Alasan penolakan pesanan...">{{ $order->catatan_admin }}</textarea>
                </div>
            </form>
        </div>
        
        <!-- Rincian Barang -->
        <div class="px-6 pb-2">
            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Rincian Barang</h3>
            <div class="space-y-4">
                @foreach($order->items as $item)
                <div class="flex justify-between items-center bg-gray-50 p-4 rounded-xl border border-gray-100 transition hover:bg-gray-100">
                    <div class="flex items-center gap-4">
                        
                        <!-- FIX GAMBAR PRODUK DISINI -->
                        <div class="w-16 h-16 bg-white rounded-lg border border-gray-200 overflow-hidden flex items-center justify-center flex-shrink-0">
                            <img src="{{ $item->product->image_url ?? asset('images/products/default.jpg') }}" alt="{{ $item->product->name }}" class="object-cover w-full h-full">
                        </div>

                        <div>
                            <p class="font-bold text-gray-800 text-sm md:text-base line-clamp-2">{{ $item->product->name ?? 'Produk Dihapus' }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    <div class="font-black text-orange-500 flex-shrink-0">
                        Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Opsi Batal Paksa -->
        <div class="px-6 py-4">
            @if($order->status == 'diproses' || $order->status == 'belum_bayar')
                <div class="bg-white rounded-xl shadow-sm border border-red-100 mt-2">
                    <form action="{{ route('admin.orders.cancel', $order->id) }}" method="POST" 
                        onsubmit="return confirm('Yakin ingin membatalkan pesanan ini secara paksa (Admin)?')">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="w-full bg-red-50 hover:bg-red-600 text-red-600 hover:text-white py-3 rounded-xl font-bold transition">
                            Batalkan Pesanan Secara Paksa
                        </button>
                    </form>
                </div>
            @endif
        </div>

        <!-- Rincian Biaya (Total Pembayaran) -->
        <div class="p-6 bg-gray-50 border-t border-gray-100">
            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Rincian Pembayaran</h3>
            <div class="space-y-2 text-sm text-gray-600 max-w-sm ml-auto">
                <div class="flex justify-between">
                    <span>Subtotal Produk</span>
                    <span class="font-medium text-gray-800">Rp {{ number_format($order->subtotal ?? ($order->total - ($order->ongkir ?? 0)), 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Ongkos Kirim ({{ $order->metode_pengiriman ?? 'Reguler' }})</span>
                    <span class="font-medium text-gray-800">Rp {{ number_format($order->ongkir ?? 0, 0, ',', '.') }}</span>
                </div>
                @if($order->proteksi > 0)
                <div class="flex justify-between">
                    <span>Proteksi Kerusakan</span>
                    <span class="font-medium text-gray-800">Rp {{ number_format($order->proteksi, 0, ',', '.') }}</span>
                </div>
                @endif
                <div class="flex justify-between">
                    <span>Biaya Layanan</span>
                    <span class="font-medium text-gray-800">Rp {{ number_format($order->biaya_layanan ?? 0, 0, ',', '.') }}</span>
                </div>
                @if($order->diskon_voucher > 0)
                <div class="flex justify-between text-green-600">
                    <span>Diskon Voucher</span>
                    <span class="font-bold">- Rp {{ number_format($order->diskon_voucher, 0, ',', '.') }}</span>
                </div>
                @endif
            </div>

            <div class="mt-4 pt-4 border-t border-gray-200 flex justify-end">
                <div class="bg-white text-gray-800 px-6 py-4 rounded-xl font-black text-xl border border-gray-200 shadow-sm flex items-center gap-4">
                    <span class="text-sm font-semibold text-gray-500 uppercase tracking-widest">Total Tagihan</span>
                    <span class="text-orange-600">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection