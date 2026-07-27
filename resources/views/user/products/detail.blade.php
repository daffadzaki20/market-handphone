@extends('layouts.app')

@section('content')

    <!-- WRAPPER UTAMA -->
    <div class="py-12 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Bungkusan Konten Utama -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden relative">
            
            <!-- ⬅️ TOMBOL KEMBALI -->
            <a href="{{ $brandType === 'aksesoris' ? '/products/aksesoris' : '/products/handphone' }}" 
               class="absolute top-6 left-6 z-20 bg-white/90 backdrop-blur-sm border border-gray-200 text-gray-700 hover:text-blue-600 hover:bg-white p-3 rounded-2xl transition-all shadow-sm hover:shadow-md group" title="Kembali">
                <svg class="w-6 h-6 group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
            </a>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-6 md:p-10 pt-20 md:pt-10">

                <!-- KIRI: FOTO PRODUK -->
                <div class="flex justify-center items-center mb-6 md:mb-0 relative">
                    @if(isset($product->image) && $product->image)
                        <img id="product-image" 
                             src="{{ $product->image_url }}"
                             alt="{{ $product->name }}"
                             class="w-full max-w-md h-72 md:h-[400px] object-contain rounded-2xl border border-gray-100 shadow-sm p-6 bg-gray-50 transition-transform duration-500 hover:scale-105 mt-4 md:mt-0">
                    @else
                        <div id="product-image" class="w-full max-w-md h-72 md:h-[400px] flex flex-col items-center justify-center rounded-2xl border border-gray-100 shadow-sm p-6 bg-gray-50 text-gray-300 mt-4 md:mt-0">
                            <svg class="w-24 h-24 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span class="text-sm font-medium text-gray-400">Gambar Belum Tersedia</span>
                        </div>
                    @endif
                </div>

                <!-- KANAN: INFO PRODUK -->
                <div class="flex flex-col justify-center">
                    
                    <div class="flex items-center gap-3 mb-3">
                        <span class="bg-blue-50 text-blue-600 text-xs font-black px-3 py-1 rounded-full uppercase tracking-widest border border-blue-100">
                            {{ $product->brand?->name ?? 'Unbranded' }}
                        </span>
                        <span class="text-gray-400 text-sm flex items-center font-medium">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                            {{ $brandType === 'hp' ? 'Handphone' : 'Aksesoris' }}
                        </span>
                    </div>

                    <h1 class="text-3xl md:text-4xl font-black text-gray-800 mb-4 leading-tight">{{ $product->name }}</h1>

                    <div class="flex flex-wrap items-end gap-4 mb-6 border-b border-gray-100 pb-6">
                        <p class="text-4xl text-orange-500 font-black tracking-tight">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>
                        @if(isset($product->stock))
                            <div class="bg-{{ $product->stock > 5 ? 'green' : 'red' }}-50 text-{{ $product->stock > 5 ? 'green' : 'red' }}-600 px-3 py-1 rounded-lg text-sm font-bold border border-{{ $product->stock > 5 ? 'green' : 'red' }}-100 mb-1">
                                Stok: {{ $product->stock }}
                            </div>
                        @endif
                    </div>

                    @if ($brandType === 'hp')
                    <div class="grid grid-cols-2 gap-4 mb-8 bg-gray-50 p-5 rounded-2xl border border-gray-100">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-blue-500 text-xl shadow-inner">📱</div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium uppercase tracking-wider mb-0.5">RAM</p>
                                <p class="text-base font-black text-gray-800">{{ $product->ram ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center text-purple-500 text-xl shadow-inner">💾</div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium uppercase tracking-wider mb-0.5">Storage</p>
                                <p class="text-base font-black text-gray-800">{{ $product->storage ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="mb-10">
                        <h3 class="text-sm font-black text-gray-800 mb-3 uppercase tracking-widest border-l-4 border-orange-500 pl-3">Deskripsi Produk</h3>
                        <p class="text-gray-600 leading-relaxed text-sm whitespace-pre-line">{{ $product->description }}</p>
                    </div>

                    <!-- 🛒 & 🛍️ TOMBOL AKSI BARU -->
                    <div class="mt-auto flex flex-col sm:flex-row gap-3">
                        
                        <!-- Keranjang -->
                        <button onclick="addToCartAnimation()" 
                                class="flex-1 bg-white border-2 border-orange-500 text-orange-600 hover:bg-orange-50 transition-all py-3.5 px-4 rounded-xl font-black text-base md:text-lg flex items-center justify-center gap-2 shadow-sm hover:shadow-md active:scale-95 group">
                            <svg class="w-5 h-5 md:w-6 md:h-6 group-hover:-rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            Keranjang
                        </button>
                        
                        <!-- Beli Sekarang -->
                        <button onclick="buyNow({{ $product->id }})" 
                                class="flex-1 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 transition-all text-white py-3.5 px-4 rounded-xl font-black text-base md:text-lg flex items-center justify-center gap-2 shadow-lg shadow-orange-200 hover:shadow-none hover:scale-[0.98] active:scale-95">
                            Beli Sekarang
                        </button>

                    </div>

                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- MULAI SECTION PRODUK LAINNYA -->
        <!-- ========================================== -->
        <div class="mt-16 mb-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-black text-gray-800">Produk Lainnya</h2>
                <a href="{{ $brandType === 'aksesoris' ? '/products/aksesoris' : '/products/handphone' }}" class="text-sm font-bold text-blue-600 hover:text-blue-700 hover:underline">
                    Lihat Semua
                </a>
            </div>

            <!-- Grid Produk -->
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4 md:gap-6">
                
                @forelse($relatedProducts ?? [] as $related)
                <a href="/product/{{ $related->id }}" class="group bg-white rounded-2xl border border-gray-100 p-4 hover:shadow-xl hover:border-orange-200 transition-all duration-300 flex flex-col h-full relative">
                    
                    <!-- Kotak Gambar -->
                    <div class="aspect-square mb-4 overflow-hidden rounded-xl bg-gray-50 flex items-center justify-center relative p-2">
                        @if(isset($related->image) && $related->image)
                            <img src="{{ $related->image_url }}" alt="{{ $related->name }}" class="object-contain w-full h-full group-hover:scale-110 transition-transform duration-500">
                        @else
                            <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        @endif
                        
                        <!-- 💗 WISHLIST BUTTON -->
                        <button type="button"
                                class="wishlist-btn absolute top-2 right-2 z-10 bg-white/90 hover:bg-white p-2 rounded-full shadow-md transition-transform hover:scale-110"
                                onclick="toggleWishlist(event, {{ $related->id }}, this)">
                            <svg class="w-5 h-5 love-icon {{ in_array($related->id, $wishlistIds ?? []) ? 'text-red-500 fill-red-500' : 'text-gray-400 fill-none' }}"
                                 stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                            </svg>
                        </button>

                        <!-- Badge Stok -->
                        @if(isset($related->stock) && $related->stock < 5)
                            <span class="absolute top-2 left-2 bg-red-100 text-red-600 text-[10px] font-black px-2 py-1 rounded-md">Sisa {{ $related->stock }}</span>
                        @endif
                    </div>

                    <!-- Info Singkat Produk -->
                    <div class="flex flex-col flex-grow">
                        <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">{{ $related->brand?->name ?? 'Unbranded' }}</p>
                        <h3 class="text-gray-800 font-bold text-sm line-clamp-2 mb-2 group-hover:text-blue-600 transition-colors">{{ $related->name }}</h3>
                        
                        <div class="mt-auto">
                            <p class="text-orange-500 font-black text-base md:text-lg mb-3">
                                Rp {{ number_format($related->price, 0, ',', '.') }}
                            </p>

                            <!-- BAGIAN RAM/ROM & STOK -->
                            <div class="flex items-center justify-between text-[11px] text-gray-500 pt-3 border-t border-gray-100">
                                <span class="font-medium">
                                    {{ $related->ram ?? '-' }} / {{ $related->storage ?? '-' }}
                                </span>
                                <span class="font-medium text-gray-400">
                                    Stok: {{ $related->stock ?? 0 }}
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
                @empty
                <div class="col-span-full py-8 text-center bg-gray-50 rounded-2xl border border-gray-100">
                    <p class="text-gray-500 font-medium">Belum ada produk rekomendasi lainnya.</p>
                </div>
                @endforelse

            </div>
        </div>
        <!-- ========================================== -->
        <!-- SELESAI SECTION PRODUK LAINNYA -->
        <!-- ========================================== -->

    </div>

    <!-- SCRIPT GABUNGAN (CART, BUY NOW & WISHLIST) -->
   <!-- SCRIPT GABUNGAN (CART, BUY NOW & WISHLIST) -->
    <script>
    // 🛒 Script Animasi Keranjang (Tetap sama)
    function addToCartAnimation() {
        const imgToDrag = document.getElementById('product-image');
        const cart = document.getElementById('cart-icon');
        const cartCount = document.getElementById('cart-count');

        if (imgToDrag && cart) {
            const imgClone = imgToDrag.cloneNode(true);
            const imgCoords = imgToDrag.getBoundingClientRect();
            const cartCoords = cart.getBoundingClientRect();

            Object.assign(imgClone.style, {
                zIndex: '9999',
                height: imgCoords.height + 'px',
                width: imgCoords.width + 'px',
                position: 'fixed',
                top: imgCoords.top + 'px',
                left: imgCoords.left + 'px',
                borderRadius: '16px',
                opacity: '0.85',
                transition: 'all 0.8s cubic-bezier(0.25, 1, 0.5, 1)',
                pointerEvents: 'none',
                boxShadow: '0 20px 25px -5px rgba(0, 0, 0, 0.1)'
            });

            document.body.appendChild(imgClone);

            setTimeout(() => {
                Object.assign(imgClone.style, {
                    top: (cartCoords.top) + 'px',
                    left: (cartCoords.left) + 'px',
                    width: '15px',
                    height: '15px',
                    opacity: '0',
                    transform: 'rotate(360deg)'
                });
            }, 50);

            setTimeout(() => {
                imgClone.remove();
                
                fetch(`/cart/add/{{ $product->id }}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest' 
                    }
                })
                .then(response => {
                    if (response.status === 401) {
                        alert('Silakan login terlebih dahulu untuk belanja!');
                        window.location.href = '/login';
                        return;
                    }
                    return response.json();
                })
                .then(data => {
                    if (data && data.status === 'success') {
                        if(cartCount) {
                            cartCount.innerText = data.cart_count;
                            cartCount.classList.add('scale-150');
                            setTimeout(() => cartCount.classList.remove('scale-150'), 300);
                        }
                        cart.classList.add('scale-125', 'text-orange-500', '-rotate-12');
                        setTimeout(() => cart.classList.remove('scale-125', 'text-orange-500', '-rotate-12'), 300);
                    }
                })
                .catch(error => console.error('Error:', error));

            }, 850);
        } else {
            window.location.href = '/login';
        }
    }

    // 🛍️ Script Beli Sekarang (Langsung Bypass ke Checkout)
    function buyNow(productId) {
        @if(Auth::check())
            // Langsung alihkan ke halaman checkout dengan membawa ID produk di URL
            window.location.href = '/checkout?product_id=' + productId + '&quantity=1';
        @else
            alert('Silakan login terlebih dahulu untuk belanja!');
            window.location.href = '/login';
        @endif
    }

    // 💗 Script Toggle Wishlist (Tetap sama)
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
        .then(res => {
            if (res.status === 401) {
                alert('Silakan login terlebih dahulu untuk menambahkan ke wishlist!');
                window.location.href = '/login';
                throw new Error('Unauthorized');
            }
            return res.json();
        })
        .then(data => {
            if (data.status === 'added') {
                icon.classList.remove('text-gray-400', 'fill-none');
                icon.classList.add('text-red-500', 'fill-red-500');
            } else if (data.status === 'removed') {
                icon.classList.remove('text-red-500', 'fill-red-500');
                icon.classList.add('text-gray-400', 'fill-none');
            }

            const newCount = data.wishlist_count !== undefined ? data.wishlist_count : data.count;

            const badge = document.getElementById('wishlist-count');
            if (badge && newCount !== undefined) {
                badge.textContent = newCount;
                badge.classList.add('scale-150');
                setTimeout(() => badge.classList.remove('scale-150'), 300);
            }
        })
        .catch(err => console.error('Wishlist error:', err));
    }
    </script>

@endsection