@extends('layouts.app_admin')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('admin.orders.index') }}" class="text-blue-600 hover:text-blue-800 font-bold flex items-center gap-2">
            ← Kembali ke Daftar Pesanan
        </a>
        <span class="bg-gray-100 text-gray-700 px-4 py-1.5 rounded-full text-sm font-black border border-gray-200">
            Order #ORD-{{ $order->id }}
        </span>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-2 p-6 border-b border-gray-100 gap-6">
            <div>
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Informasi Pelanggan</h3>
                <p class="font-black text-gray-800 text-lg">{{ $order->user->name ?? 'User Dihapus' }}</p>
                <p class="text-gray-500 text-sm">{{ $order->user->email ?? '-' }}</p>
            </div>
            <div>
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Status Pesanan</h3>
                <p class="font-bold text-blue-600 text-lg capitalize">{{ $order->status }}</p>
                <p class="text-gray-500 text-sm">Dibuat: {{ $order->created_at->format('d M Y H:i') }}</p>
            </div>
        </div>
    <div class="mt-6 p-6 bg-gray-50 rounded-2xl border border-gray-200">
        <h3 class="text-sm font-bold text-gray-700 mb-4">Ubah Status Pesanan</h3>
        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="flex gap-4">
            @csrf
            @method('PUT')
            <select name="status" class="rounded-xl border-gray-300 w-full md:w-64">
                <option value="diproses" {{ $order->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="dikirim" {{ $order->status == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="dibatalkan" {{ $order->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-xl font-bold hover:bg-blue-700 transition">
                Update
            </button>
        </form>
    </div>
        <div class="p-6">
            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Rincian Barang</h3>
            <div class="space-y-4">
                @foreach($order->items as $item)
                <div class="flex justify-between items-center bg-gray-50 p-4 rounded-xl border border-gray-100">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-white rounded-lg border border-gray-200 overflow-hidden flex items-center justify-center">
                            @if($item->product && $item->product->image)
                                <img src="{{ asset('images/products/' . $item->product->image) }}" class="object-cover w-full h-full">
                            @else
                                📱
                            @endif
                        </div>
                        <div>
                            <p class="font-bold text-gray-800">{{ $item->product->name ?? 'Produk Dihapus' }}</p>
                            <p class="text-xs text-gray-500">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    <div class="font-black text-gray-800">
                        Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-6">
                <div class="bg-white rounded-sm shadow-sm border border-gray-100">
                    @if($order->status == 'diproses')
                        <form action="{{ route('admin.orders.cancel', $order->id) }}" method="POST" 
                            onsubmit="return confirm('Yakin ingin membatalkan pesanan ini secara paksa (Admin)?')">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-xl font-bold transition">
                                Batalkan Pesanan
                            </button>
                        </form>
                    @else
                        <p class="text-center text-gray-500 italic p-3 border border-gray-200 rounded-xl">
                            Pesanan tidak dapat dibatalkan (Sudah dikirim/selesai).
                        </p>
                    @endif
                </div>
            </div>
            </div>
            <div class="mt-6 flex justify-end">
                <div class="bg-blue-50 text-blue-800 px-6 py-4 rounded-xl font-black text-xl border border-blue-100 shadow-inner">
                    Total: Rp {{ number_format($order->total, 0, ',', '.') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
