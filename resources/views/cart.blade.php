<!DOCTYPE html>
<html class="dark">
<head>
    <title>Keranjang</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 p-5">

<h1 class="text-2xl font-bold mb-6">🛒 Keranjang Belanja</h1>

@php $total = 0; @endphp

@forelse($cart as $id => $item)

@php 
    $subtotal = $item['price'] * $item['quantity']; 
    $total += $subtotal;
@endphp

<div class="bg-white p-4 mb-4 rounded-xl shadow flex items-center justify-between">

    <div class="flex items-center gap-4">
        <img src="{{ asset('images/' . $item['image']) }}" class="w-20 rounded">

        <div>
            <h2 class="font-bold">{{ $item['name'] }}</h2>
            <p class="text-green-600">Rp {{ number_format($item['price']) }}</p>
        </div>
    </div>

    <div class="flex items-center gap-3">

        <!-- Quantity -->
        <a href="/cart/decrease/{{ $id }}" class="bg-gray-200 px-3 py-1 rounded">-</a>

        <span>{{ $item['quantity'] }}</span>

        <a href="/cart/increase/{{ $id }}" class="bg-gray-200 px-3 py-1 rounded">+</a>

        <!-- Remove -->
        <a href="/cart/remove/{{ $id }}" class="text-red-500 ml-4">Hapus</a>

    </div>

    <div class="font-bold text-right">
        Rp {{ number_format($subtotal) }}
    </div>

</div>

@empty
<p class="text-gray-500">Keranjang kosong</p>
@endforelse

<!-- TOTAL -->
@if(count($cart) > 0)
<div class="bg-white p-5 rounded-xl shadow mt-6 flex justify-between items-center">

    <h2 class="text-xl font-bold">Total:</h2>

    <p class="text-green-600 text-xl font-bold">
        Rp {{ number_format($total) }}
    </p>

</div>
@endif
<a href="/checkout" class="bg-green-500 text-white px-5 py-2 rounded-lg">
    Checkout
</a>
</body>
</html>