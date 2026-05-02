<x-app-layout>

    <!-- WRAPPER UTAMA -->
    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <h1 class="text-3xl font-black text-gray-800 tracking-tight mb-6">🎧 Aksesoris</h1>

        <!-- 🔍 SEARCH BAR (LIVE SEARCH) -->
        <form method="GET" action="/products/aksesoris" class="mb-6 flex gap-3" id="searchForm">
            <div class="relative w-full">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text"
                       id="searchInput"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Cari casing, charger, TWS, earphone..."
                       autocomplete="off"
                       class="w-full pl-10 border border-gray-200 p-3 rounded-xl focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition-shadow shadow-sm">
            </div>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 transition-colors text-white px-6 rounded-xl font-bold shadow-sm flex-shrink-0">
                Cari
            </button>
        </form>

        <!-- 🏷️ FILTER BRAND -->
        <div class="flex flex-wrap gap-2 mb-8">
            <a href="/products/aksesoris"
               class="px-4 py-1.5 rounded-full text-sm font-medium transition-all shadow-sm
               {{ !request('brand') ? 'bg-blue-600 text-white' : 'bg-white text-gray-600 hover:bg-gray-50 border border-gray-200' }}">
                Semua Brand
            </a>

            @foreach ($brands as $brand)
            <a href="/products/aksesoris?brand={{ $brand->slug }}{{ request('search') ? '&search='.request('search') : '' }}"
               class="px-4 py-1.5 rounded-full text-sm font-medium transition-all shadow-sm
               {{ request('brand') == $brand->slug ? 'bg-blue-600 text-white' : 'bg-white text-gray-600 hover:bg-gray-50 border border-gray-200' }}">
                {{ $brand->name }}
            </a>
            @endforeach
        </div>

        <!-- ========================================== -->
        <!-- BUNGKUSAN PRODUK (PENTING UNTUK LIVE SEARCH) -->
        <!-- ========================================== -->
        <div id="productContainer" class="transition-opacity duration-300">

            <!-- 📦 GRID PRODUK -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 relative">

                @forelse ($products as $product)
                    <a href="/product/{{ $product->id }}"
                       class="bg-white rounded-2xl shadow-sm hover:shadow-xl border border-gray-100 transition-all duration-300 overflow-hidden group flex flex-col">

                        <!-- IMAGE DENGAN FALLBACK -->
                        <div class="h-48 bg-gray-50 flex items-center justify-center overflow-hidden relative">
                            @if(isset($product->image) && $product->image)
                                <img src="{{ asset('storage/' . $product->image) }}"
                                     alt="{{ $product->name }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            @else
                                <!-- Placeholder jika tidak ada gambar -->
                                <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            @endif
                        </div>

                        <!-- CONTENT -->
                        <div class="p-4 flex flex-col flex-grow">
                            <div class="text-xs font-bold text-blue-600 uppercase tracking-wider mb-1">
                                {{ $product->brand->name ?? 'Tanpa Brand' }}
                            </div>

                            <h2 class="font-bold text-gray-800 text-base line-clamp-2 mb-2">
                                {{ $product->name }}
                            </h2>

                            <p class="text-gray-900 font-black text-lg mb-2 mt-auto">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </p>

                            <!-- Deskripsi dengan batasan 2 baris (line-clamp-2) & garis pembatas -->
                            <p class="text-xs text-gray-500 mt-2 line-clamp-2 leading-relaxed border-t border-gray-100 pt-2">
                                {{ $product->description }}
                            </p>
                        </div>

                    </a>
                @empty
                    <!-- Tampilan jika produk tidak ditemukan -->
                    <div class="col-span-full py-16 flex flex-col items-center justify-center text-gray-500 bg-white rounded-2xl border border-gray-200 border-dashed">
                        <svg class="w-16 h-16 mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <h3 class="text-lg font-bold text-gray-800">Aksesoris Tidak Ditemukan</h3>
                        <p class="mt-1">Coba gunakan kata kunci atau brand lain.</p>
                    </div>
                @endforelse

            </div>

            <!-- PAGINATION -->
            <div class="mt-10">
                {{ $products->links() }}
            </div>

        </div>

    </div> <!-- Tutup Wrapper -->

    <!-- SCRIPT LIVE SEARCH (AJAX) -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInput');
            const productContainer = document.getElementById('productContainer');
            let typingTimer;
            const doneTypingInterval = 500; // Jeda 0.5 detik

            searchInput.addEventListener('input', function () {
                clearTimeout(typingTimer);
                const keyword = this.value;

                // Efek Loading memudar
                productContainer.style.opacity = '0.4';

                typingTimer = setTimeout(function () {
                    const url = new URL(window.location.href);
                    if (keyword) {
                        url.searchParams.set('search', keyword);
                    } else {
                        url.searchParams.delete('search');
                    }

                    // Ambil data terbaru secara background
                    fetch(url)
                        .then(response => response.text())
                        .then(html => {
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');
                            
                            const newContainer = doc.getElementById('productContainer');
                            if(newContainer) {
                                productContainer.innerHTML = newContainer.innerHTML;
                            }
                            
                            productContainer.style.opacity = '1';
                            window.history.pushState({}, '', url);
                        })
                        .catch(error => {
                            console.error('Error fetching data:', error);
                            productContainer.style.opacity = '1';
                        });
                }, doneTypingInterval);
            });
            
            // Mencegah form submit default dari tombol Enter
            document.getElementById('searchForm').addEventListener('submit', function(e) {
                e.preventDefault();
            });
        });
    </script>

</x-app-layout>