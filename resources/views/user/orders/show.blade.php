@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white shadow-lg rounded-xl p-8">
    <!-- Judul -->
    <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center gap-2">
        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/>
        </svg>
        Detail Pesanan #{{ $order->id }}
    </h2>

    <!-- Info pemesan -->
    <div class="space-y-2 mb-6">
        <p><span class="font-semibold text-gray-700">Pemesan:</span> {{ $order->user->name }}</p>
        <p><span class="font-semibold text-gray-700">Email:</span> {{ $order->user->email }}</p>
    </div>

    <!-- Info pesanan -->
    <div class="space-y-2 mb-6">
        <p><span class="font-semibold text-gray-700">Total:</span> 
           <span class="text-blue-600 font-bold">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
        </p>
        <p><span class="font-semibold text-gray-700">Status:</span> 
            <span class="px-3 py-1 rounded-full text-xs font-medium
                {{ $order->status === 'diproses' ? 'bg-yellow-100 text-yellow-700' : '' }}
                {{ $order->status === 'dikirim' ? 'bg-blue-100 text-blue-700' : '' }}
                {{ $order->status === 'selesai' ? 'bg-green-100 text-green-700' : '' }}">
                {{ ucfirst($order->status) }}
            </span>
        </p>
    </div>

    <!-- Item pesanan -->
    <h3 class="text-lg font-semibold mb-3 text-gray-800">Item Pesanan:</h3>
    <div class="border rounded-lg divide-y">
        @foreach($order->items as $item)
            <div class="flex justify-between items-center p-3 hover:bg-gray-50 transition">
                <span class="font-medium text-gray-700">{{ $item->product->name }}</span>
                <span class="text-gray-600">x {{ $item->quantity }}</span>
            </div>
        @endforeach
    </div>

    <!-- Tombol kembali -->
    <div class="mt-8">
        <a href="{{ route('orders.index') }}" 
           class="inline-flex items-center bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">
           ← Kembali ke Pesanan Saya
        </a>
    </div>
</div>
@endsection
