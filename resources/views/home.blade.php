<!DOCTYPE html>
<html>
<head>
    <title>Marketplace Handphone</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">

<!-- Navbar -->
<div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white p-4 flex flex-col md:flex-row md:justify-between md:items-center gap-3 shadow-md">

    <h1 class="font-bold text-xl tracking-wide">HandphoneKu</h1>

    <div class="flex items-center gap-3 w-full md:w-auto">

        <!-- Search -->
        <form action="/" method="GET" class="flex items-center gap-2 w-full md:w-auto">
            <input type="text" name="search" placeholder="Cari HP..."
                value="{{ request('search') }}"
                class="rounded-lg px-4 py-2 text-black w-full md:w-64 focus:outline-none shadow-sm">

            <button class="bg-white text-green-600 px-4 py-2 rounded-lg font-medium hover:bg-gray-100 transition">
                Cari
            </button>
        </form>

        <!-- Cart -->
        <a href="/cart" class="bg-white text-green-600 px-4 py-2 rounded-lg font-medium hover:bg-gray-100 transition">
            🛒
        </a>

    </div>
</div>

<div class="container mx-auto p-4 md:p-6">

    @if(session('success'))
<div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4 shadow">
    {{ session('success') }}
</div>
@endif

    <h2 class="text-2xl font-bold mb-6 text-gray-800">
        🔥 Produk Terbaru
    </h2>

    <!-- Grid Produk -->
    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">

        @forelse($products as $product)
        <a href="/product/{{ $product->id }}">

            <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition duration-300 overflow-hidden cursor-pointer group">

                <!-- Gambar -->
                <div class="overflow-hidden">
                    <img src="{{ asset('images/' . $product->image) }}"
                        onerror="this.src='https://via.placeholder.com/300'"
                        class="w-full h-44 object-cover group-hover:scale-105 transition duration-300">
                </div>

                <!-- Detail -->
                <div class="p-4">

                    <h3 class="text-sm md:text-base font-semibold line-clamp-2">
                        {{ $product->name }}
                    </h3>

                    <p class="text-gray-400 text-sm mt-1">
                        {{ $product->brand->name }}
                    </p>

                    <p class="text-green-600 font-bold mt-2 text-base">
                        Rp {{ number_format($product->price) }}
                    </p>

                </div>

            </div>

        </a>
        @empty
            <p class="text-gray-500">Tidak ada produk</p>
        @endforelse

    </div>

</div>

</body>
</html>