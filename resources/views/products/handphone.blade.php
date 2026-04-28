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
<div class="flex gap-2 mb-6 flex-wrap">

    <!-- Semua -->
    <a href="/products/handphone"
       class="px-3 py-1 rounded-lg text-sm 
       {{ request('brand') == null ? 'bg-blue-500 text-white' : 'bg-gray-200' }}">
        Semua
    </a>

    <!-- Apple -->
    <a href="/products/handphone?brand=Apple"
       class="px-3 py-1 rounded-lg text-sm 
       {{ request('brand') == 'Apple' ? 'bg-blue-500 text-white' : 'bg-gray-200' }}">
        Apple
    </a>

    <!-- Samsung -->
    <a href="/products/handphone?brand=Samsung"
       class="px-3 py-1 rounded-lg text-sm 
       {{ request('brand') == 'Samsung' ? 'bg-blue-500 text-white' : 'bg-gray-200' }}">
        Samsung
    </a>

    <!-- Xiaomi -->
    <a href="/products/handphone?brand=Xiaomi"
       class="px-3 py-1 rounded-lg text-sm 
       {{ request('brand') == 'Xiaomi' ? 'bg-blue-500 text-white' : 'bg-gray-200' }}">
        Xiaomi
    </a>

    <!-- Oppo -->
    <a href="/products/handphone?brand=Oppo"
       class="px-3 py-1 rounded-lg text-sm 
       {{ request('brand') == 'Oppo' ? 'bg-blue-500 text-white' : 'bg-gray-200' }}">
        Oppo
    </a>

    <!-- Vivo -->
    <a href="/products/handphone?brand=Vivo"
       class="px-3 py-1 rounded-lg text-sm 
       {{ request('brand') == 'Vivo' ? 'bg-blue-500 text-white' : 'bg-gray-200' }}">
        Vivo
    </a>

    <!-- Infinix -->
    <a href="/products/handphone?brand=Infinix"
       class="px-3 py-1 rounded-lg text-sm 
       {{ request('brand') == 'Infinix' ? 'bg-blue-500 text-white' : 'bg-gray-200' }}">
        Infinix
    </a>

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

@endsection