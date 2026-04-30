@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-white p-6 rounded-xl shadow">

    <!-- IMAGE -->
    <div>
        <img src="{{ asset('images/products/' . $product->image) }}"
             class="w-full h-96 object-cover rounded-xl">
    </div>

    <!-- INFO -->
    <div>

        <h1 class="text-3xl font-bold mb-2">
            {{ $product->name }}
        </h1>

        <p class="text-gray-500 mb-3">
            Brand: {{ $product->brand?->name ?? '-' }}
        </p>

        <p class="text-2xl text-green-600 font-bold mb-4">
            Rp {{ number_format($product->price) }}
        </p>
        @if ($brandType === 'hp')
        <div class="space-y-2 text-gray-700 mb-6">
            <p>📱 RAM: {{ $product->ram }}</p>
            <p>💾 Storage: {{ $product->storage }}</p>
            <p>🔋 Battery: {{ $product->battery }}</p>
        </div>
        @endif

        <p class="text-gray-600 mb-6">
            {{ $product->description }}
        </p>

        <!-- BUTTON -->
        <button class="w-full bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-lg font-semibold">
            🛒 Beli Sekarang
        </button>

        <a href="{{ $brandType === 'aksesoris' ? '/products/aksesoris' : '/products/handphone' }}" class="block text-center text-blue-500 mt-4">
            ← Kembali
        </a>

    </div>

</div>

@endsection