@extends('layouts.app')

@section('content')

     <!-- PEMBUNGKUS UTAMA -->
     <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
         
         <!-- JUDUL KATEGORI -->
         <h1 class="text-3xl font-black text-gray-800 tracking-tight mb-6">📱 Handphone</h1>

         <!-- 🔍 SEARCH BAR -->
         <form method="GET" action="{{ route('products.handphone') }}" class="mb-6 flex gap-3" id="searchForm">
             <div class="relative w-full">
                 <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                     <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                 </div>
                 <input type="text"
                        id="searchInput"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari iPhone, Samsung, Xiaomi..."
                        autocomplete="off"
                        class="w-full pl-10 border border-gray-200 p-3 rounded-xl focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition-shadow shadow-sm">
             </div>

             <button type="submit" class="bg-blue-600 hover:bg-blue-700 transition-colors text-white px-6 rounded-xl font-bold shadow-sm flex-shrink-0">
                 Cari
             </button>
         </form>

         <!-- 🏷️ FILTER BRAND -->
        <div class="flex flex-wrap gap-2 mb-8">
            <a href="{{ route('products.handphone', array_filter(['search' => request('search')])) }}"
               class="px-4 py-1.5 rounded-full text-sm font-medium transition-all shadow-sm
               {{ !request('brand') ? 'bg-blue-600 text-white' : 'bg-white text-gray-600 hover:bg-gray-50 border border-gray-200' }}">
                Semua Brand
            </a>

            @foreach ($brands as $brand)
            <a href="{{ route('products.handphone', array_filter(['brand' => $brand->slug, 'search' => request('search')])) }}"
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
                    <a href="{{ route('product.show', $product->id) }}"
                       class="bg-white rounded-2xl shadow-sm hover:shadow-xl border border-gray-100 transition-all duration-300 overflow-hidden group flex flex-col">

                        <!-- IMAGE -->
                        <div class="h-48 bg-gray-50 flex items-center justify-center overflow-hidden relative p-4">
                            @if(isset($product->image) && $product->image)
                                <img src="{{ $product->image_url }}"
                                     alt="{{ $product->name }}"
                                     class="w-full h-full object-contain group-hover:scale-105 transition duration-500">
                            @else
                                <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            @endif

                            <!-- 💗 WISHLIST BUTTON -->
                            <button type="button"
                                    class="wishlist-btn absolute top-2 right-2 z-10 bg-white/90 hover:bg-white p-2 rounded-full shadow-md transition-transform hover:scale-110"
                                    data-product-id="{{ $product->id }}"
                                    onclick="toggleWishlist(event, {{ $product->id }}, this)">
                                <svg class="w-5 h-5 love-icon {{ in_array($product->id, $wishlistIds ?? []) ? 'text-red-500 fill-red-500' : 'text-gray-400 fill-none' }}"
                                     stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                </svg>
                            </button>
                        </div>

                        <!-- CONTENT -->
                        <div class="p-4 flex flex-col flex-grow">
                            <div class="text-[10px] font-black text-blue-600 uppercase tracking-widest mb-1">
                                {{ $product->brand->name ?? 'Tanpa Brand' }}
                            </div>

                            <h2 class="font-bold text-gray-800 text-sm md:text-base line-clamp-2 mb-2 group-hover:text-blue-600 transition-colors">
                                {{ $product->name }}
                            </h2>

                            <p class="text-gray-900 font-black text-lg mb-4 mt-auto">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </p>

                            <!-- BAGIAN RAM/ROM & STOK -->
                            <div class="flex items-center justify-between text-[11px] text-gray-500 mt-auto pt-3 border-t border-gray-100">
                                <span class="font-medium">
                                    {{ $product->ram ?? '-' }} / {{ $product->storage ?? '-' }}
                                </span>
                                <span class="font-medium text-gray-400">
                                    Stok: {{ $product->stock ?? 0 }}
                                </span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full py-16 flex flex-col items-center justify-center text-gray-500 bg-white rounded-2xl border border-gray-200 border-dashed">
                        <svg class="w-16 h-16 mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <h3 class="text-lg font-bold text-gray-800">Pencarian Tidak Ditemukan</h3>
                        <p class="mt-1">Coba gunakan kata kunci atau brand lain.</p>
                    </div>
                @endforelse

            </div>

            <!-- PAGINATION -->
            <div class="mt-10">
                {{ $products->links() }}
            </div>

        </div>

    </div>

    <!-- SCRIPT LIVE SEARCH & WISHLIST (AJAX) -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInput');
            const productContainer = document.getElementById('productContainer');
            let typingTimer;
            const doneTypingInterval = 500;

            if(searchInput) {
                searchInput.addEventListener('input', function () {
                    clearTimeout(typingTimer);
                    const keyword = this.value;

                    productContainer.style.opacity = '0.4';

                    typingTimer = setTimeout(function () {
                        const url = new URL(window.location.href);
                        if (keyword) {
                            url.searchParams.set('search', keyword);
                        } else {
                            url.searchParams.delete('search');
                        }

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
            }
            
            const searchForm = document.getElementById('searchForm');
            if(searchForm) {
                searchForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                });
            }
        });

        function toggleWishlist(event, productId, btnEl) {
            event.preventDefault();
            event.stopPropagation();

            const icon = btnEl.querySelector('.love-icon');

            fetch(`/wishlist/toggle/${productId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'added') {
                    icon.classList.remove('text-gray-400', 'fill-none');
                    icon.classList.add('text-red-500', 'fill-red-500');
                } else {
                    icon.classList.remove('text-red-500', 'fill-red-500');
                    icon.classList.add('text-gray-400', 'fill-none');
                }

                // UPDATE BADGE COUNT
                const badge = document.getElementById('wishlist-count');
                if (badge) {
                    badge.textContent = data.count;
                }
            })
            .catch(err => console.error('Wishlist error:', err));
        }
    </script>

@endsection