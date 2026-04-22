<!DOCTYPE html>
<html>
<head>
    <title>Detail Produk</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-5">

    <a href="/" class="text-blue-500 mb-4 inline-block">← Kembali</a>

    <div class="bg-white rounded-2xl shadow p-5 md:flex gap-6">

        <!-- Gambar -->
        <img src="{{ asset('images/' . $product->image) }}" 
     class="w-full h-64 object-contain bg-gray-100 rounded-xl">


        <!-- Detail -->
        <div class="mt-4 md:mt-0">

            <h1 class="text-2xl font-bold">{{ $product->name }}</h1>

            <p class="text-gray-500 mt-2">
                Brand: {{ $product->brand->name }}
            </p>

            <p class="text-green-600 text-xl font-bold mt-4">
                Rp {{ number_format($product->price) }}
            </p>

            <p class="mt-4 text-gray-700">
                {{ $product->description }}
            </p>

            <form action="/cart/add/{{ $product->id }}" method="POST">
    @csrf
    <button class="mt-6 bg-green-500 text-white px-5 py-2 rounded-lg">
        Tambah ke Keranjang
    </button>
</form>

        </div>

    </div>

</div>

</body>
</html>