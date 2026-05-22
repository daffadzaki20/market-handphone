@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white shadow-lg rounded-lg p-8 text-center">
    <!-- Ikon check -->
    <div class="flex justify-center mb-4">
        <div class="bg-green-100 text-green-600 rounded-full p-4">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
    </div>

    <h2 class="text-2xl font-bold text-green-600 mb-2">Pesanan Berhasil!</h2>
    <p class="text-gray-600 mb-6">Terima kasih, pesanan kamu sedang diproses.</p>

    <!-- Progress bar tracking -->
    <div class="flex items-center justify-between mb-8">
        <div class="flex-1">
            <div class="flex justify-between mb-2 text-sm font-medium text-gray-600">
                <span>Pesanan Diterima</span>
                <span>Diproses</span>
                <span>Dikirim</span>
                <span>Selesai</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-green-500 h-2 rounded-full" style="width: 50%"></div>
            </div>
        </div>
    </div>

    <div class="bg-gray-50 rounded-lg p-4 mb-6 text-left">
        <h4 class="text-lg font-semibold text-gray-800 mb-3">Detail Pesanan:</h4>
        <ul class="divide-y divide-gray-200 mb-4">
            @foreach($order->items as $item)
                <li class="py-2 flex justify-between">
                    <span class="font-medium text-gray-700">{{ $item->product->name }}</span>
                    <span class="text-gray-500">x {{ $item->quantity }}</span>
                </li>
            @endforeach
        </ul>
        <p class="text-gray-700"><span class="font-semibold">Total:</span> Rp {{ number_format($order->total, 0, ',', '.') }}</p>
        <p class="text-gray-700"><span class="font-semibold">Status:</span> 
            <span class="bg-green-100 text-green-600 px-2 py-0.5 rounded">{{ $order->status }}</span>
        </p>
    </div>

    <div class="flex justify-center gap-3">
        <a href="{{ route('handphone.index') }}" 
           class="bg-blue-600 text-white px-5 py-2 rounded-lg shadow hover:bg-blue-700 transition">
           Kembali ke Beranda
        </a>
        
    </div>
</div>
@endsection
