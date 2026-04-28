@extends('layouts.app')

@section('title', 'Aksesoris')

@section('content')

<h1 class="text-3xl font-bold mb-6">🎧 Aksesoris</h1>

<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

    @foreach ($products as $product)
        <a href="/product/{{ $product->id }}"
           class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden group">

            <div class="overflow-hidden">
                <img src="{{ asset('images/products/' . $product->image) }}"
                     class="w-full h-40 object-cover group-hover:scale-105 transition">
            </div>

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
                    {{ $product->description }}
                </p>

            </div>

        </a>
    @endforeach

</div>

@endsection