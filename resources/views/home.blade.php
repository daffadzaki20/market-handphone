<!DOCTYPE html>
<html>
<head>
    <title>Marketplace Handphone</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Dark Mode Init -->
    <script>
        if (localStorage.getItem('theme') === 'light') {
            document.documentElement.classList.remove('dark');
        } else {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>

<body class="bg-white text-black dark:bg-gradient-to-b dark:from-gray-900 dark:via-gray-950 dark:to-black dark:text-gray-100 transition">

<!-- Navbar -->
<div class="bg-gray-200 dark:bg-gray-900 border-b border-gray-300 dark:border-gray-800 p-4 flex justify-between items-center shadow">

    <h1 class="font-bold text-xl">DB2 Phone Store</h1>

    <div class="flex items-center gap-3">

        <!-- Search -->
        <form action="/home" method="GET" class="flex gap-2">
            <input type="text" name="search" placeholder="Cari HP..."
                value="{{ request('search') }}"
                class="rounded-lg px-4 py-2 bg-gray-100 dark:bg-gray-800 border border-gray-300 dark:border-gray-700">

            <button class="bg-green-500 text-white px-4 py-2 rounded-lg">
                Cari
            </button>
        </form>

        <!-- Toggle -->
        <button id="themeToggle"
            class="bg-gray-300 dark:bg-gray-700 px-3 py-2 rounded-lg">
            🌙 / ☀️
        </button>

        <!-- Cart -->
        <a href="/cart" class="bg-green-500 text-white px-4 py-2 rounded-lg">
            🛒
        </a>

    </div>
</div>

<!-- Content -->
<div class="container mx-auto p-6">

    <h2 class="text-2xl font-bold mb-6">🔥 Produk Terbaru</h2>

   <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

    @forelse($products as $product)

    <div class="bg-white dark:bg-gray-800 border rounded-2xl overflow-hidden transform hover:scale-105 transition duration-300">

        <!-- LINK KE DETAIL -->
        <a href="/product/{{ $product->id }}">

            <div class="p-4">

                <!-- Image -->
                <img src="{{ asset('images/' . ($product->image ?? 'default.jpg')) }}"
                    class="h-40 mx-auto object-contain">

                <!-- Info -->
                <h3 class="font-bold mt-3">{{ $product->name }}</h3>
                <p class="text-gray-500 text-sm">{{ $product->brand->name ?? '-' }}</p>
                <p class="text-green-500 font-bold">
                    Rp {{ number_format($product->price) }}
                </p>

            </div>

        </a>

        <!-- BUTTON CART -->
        <div class="p-4 pt-0">
            <a href="/cart/add/{{ $product->id }}"
                class="block text-center bg-green-500 text-white py-2 rounded-lg hover:bg-green-600">
                🛒 Tambah ke Keranjang
            </a>
        </div>

    </div>

    @empty
    <p>Tidak ada produk</p>
    @endforelse

</div>

</div>

<!-- Script -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const toggleBtn = document.getElementById('themeToggle');

    if (!toggleBtn) return;

    toggleBtn.addEventListener('click', () => {
        const html = document.documentElement;

        html.classList.toggle('dark');

        localStorage.setItem(
            'theme',
            html.classList.contains('dark') ? 'dark' : 'light'
        );
    });
});
</script>

</body>
</html>