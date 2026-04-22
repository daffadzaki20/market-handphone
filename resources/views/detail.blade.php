<!DOCTYPE html>
<html>
<head>
    <title>Detail Produk</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 p-6">

<a href="/home" class="text-blue-500 mb-4 inline-block">← Kembali</a>

<div class="max-w-6xl mx-auto bg-white rounded-2xl shadow-lg p-6 grid md:grid-cols-2 gap-8">

    <!-- GAMBAR -->
    <div class="flex items-center justify-center bg-gray-100 rounded-xl p-6">
        <img src="{{ asset('images/' . ($product->image ?? 'default.jpg')) }}"
            class="max-h-[400px] object-contain">
    </div>

    <!-- DETAIL -->
    <div class="flex flex-col justify-between">

        <div>
            <h1 class="text-3xl font-bold mb-2">
                {{ $product->name }}
            </h1>

            <p class="text-gray-500 mb-4">
                Brand: {{ $product->brand->name ?? '-' }}
            </p>

            <p class="text-2xl text-green-600 font-bold mb-6">
                Rp {{ number_format($product->price) }}
            </p>

            <!-- DESKRIPSI -->
            <p class="text-gray-700 mb-6">
                {{ $product->description }}
            </p>

            <!-- SPESIFIKASI -->
            <div class="bg-gray-50 p-4 rounded-xl space-y-2">
                <p><b>RAM:</b> {{ $product->ram }}</p>
                <p><b>Storage:</b> {{ $product->storage }}</p>
                <p><b>Baterai:</b> {{ $product->battery }}</p>
            </div>
        </div>

        <!-- BUTTON -->
        <a href="/cart/add/{{ $product->id }}"
            class="mt-6 bg-green-500 text-white text-center py-3 rounded-xl hover:bg-green-600 transition">
            🛒 Tambah ke Keranjang
        </a>

    </div>

</div>

</body>
</html>