@extends('layouts.app')

@section('title', 'Handphone')

@section('content')

<h1 class="text-3xl font-bold mb-6">📱 Handphone</h1>

<!-- 🔍 SEARCH BAR -->
<form method="GET" action="/products/handphone" class="mb-6 flex gap-2">

    <input type="text"
           name="search"
           value="{{ request('search') }}"
           placeholder="Cari iPhone, Samsung..."
           class="w-full border p-2 rounded-lg">

    <button class="bg-blue-500 text-white px-4 rounded-lg">
        Cari
    </button>

</form>

<!-- 🏷️ FILTER BRAND -->
<div class="flex flex-wrap gap-2 mb-4">
    <a href="/products/handphone"
       class="px-3 py-1 rounded-full text-sm transition {{ !request('brand') ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
        Semua Brand
    </a>

    @foreach ($brands as $brand)
    <a href="/products/handphone?brand={{ $brand->slug }}{{ request('search') ? '&search='.request('search') : '' }}"
       class="px-3 py-1 rounded-full text-sm transition
       {{ request('brand') == $brand->slug ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
        {{ $brand->name }}
    </a>
    @endforeach
</div>

<!-- 📦 GRID PRODUK -->
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

    @foreach ($products as $product)

        <a href="/product/{{ $product->id }}"
           class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden group">

            <!-- IMAGE -->
            <div class="overflow-hidden">
                <img src="{{ asset('images/products/' . $product->image) }}"
                     class="w-full h-40 object-cover group-hover:scale-105 transition duration-300">
            </div>

            <!-- CONTENT -->
            <div class="p-3">

                <h2 class="font-semibold text-sm truncate">
                    {{ $product->name }}
                </h2>

                <p class="text-xs text-gray-500">
                    {{ $product->brand->name }}
                </p>

                <p class="text-green-600 font-bold mt-1">
                    Rp {{ number_format($product->price) }}
                </p>

                <p class="text-xs text-gray-500 mt-1">
                    {{ $product->ram }} / {{ $product->storage }}
                </p>

            </div>

        </a>

    @endforeach

</div>

<!-- PAGINATION -->
<div class="mt-8">
    {{ $products->links() }}
</div>

@endsection