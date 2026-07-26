@extends('layouts.app')
@section('content')
    <div class="max-w-6xl mx-auto px-4 py-8 relative min-h-screen">
        <h1 class="text-3xl font-black mb-8 text-gray-800 flex items-center gap-3">
            ❤️ Wishlist Saya
        </h1>

        @if($wishlists->isEmpty())
            <!-- Tampilan Wishlist Kosong -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-12 text-center mt-10">
                <div class="bg-red-50 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6 text-5xl shadow-inner text-red-500">
                    <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Wishlist kamu masih kosong</h2>
                <p class="text-gray-500 mb-6">Yuk, simpan gadget impianmu sekarang!</p>
                <a href="{{ route('products.handphone') }}" class="inline-block bg-orange-500 hover:bg-orange-600 shadow-lg shadow-orange-200 text-white font-bold py-3 px-8 rounded-xl transition-transform hover:-translate-y-1">
                    Eksplor Produk
                </a>
            </div>
        @else
            <!-- Daftar Produk Wishlist -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 relative">
                @foreach($wishlists as $item)
                    <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl border border-gray-100 transition-all duration-300 overflow-hidden group flex flex-col relative" id="wishlist-item-{{ $item->product_id }}">
                        
                        <!-- Tombol Hapus (Toggle) -->
                        <button onclick="toggleWishlist({{ $item->product_id }})" class="absolute top-3 right-3 z-10 bg-white/80 backdrop-blur-sm hover:bg-red-50 p-2 rounded-full text-red-500 transition-colors shadow-sm" title="Hapus dari Wishlist">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        </button>

                        <a href="{{ route('product.show', $item->product_id) }}" class="flex flex-col flex-grow">
                            <!-- IMAGE -->
                            <div class="h-48 bg-gray-50 flex items-center justify-center overflow-hidden relative p-4">
                                @if(isset($item->product->image_url) && $item->product->image_url)
                                    <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="w-full h-full object-contain group-hover:scale-105 transition duration-500">
                                @else
                                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                @endif
                            </div>

                            <!-- CONTENT -->
                            <div class="p-4 flex flex-col flex-grow">
                                <div class="text-xs font-bold text-blue-600 uppercase tracking-wider mb-1">
                                    {{ $item->product->brand->name ?? 'Unbranded' }}
                                </div>
                                <h2 class="font-bold text-gray-800 text-base line-clamp-2 mb-2 group-hover:text-orange-500 transition-colors">
                                    {{ $item->product->name }}
                                </h2>
                                <p class="text-orange-500 font-black text-lg mb-2 mt-auto">
                                    Rp {{ number_format($item->product->price, 0, ',', '.') }}
                                </p>
                            </div>
                        </a>

                        <!-- Add to cart -->
                        <div class="p-4 pt-0">
                            <button onclick="addToCart({{ $item->product_id }})" class="w-full bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white font-bold py-2 rounded-xl transition-colors border border-blue-100 flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                Keranjang
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <script>
        function toggleWishlist(productId) {
            fetch(`{{ url('/wishlist/toggle') }}/${productId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'removed') {
                    const item = document.getElementById(`wishlist-item-${productId}`);
                    if (item) {
                        item.style.transform = 'scale(0.9)';
                        item.style.opacity = '0';
                        setTimeout(() => {
                            item.remove();
                            // Reload if empty
                            if (document.querySelectorAll('[id^="wishlist-item-"]').length === 0) {
                                window.location.reload();
                            }
                        }, 300);
                    }
                    
                    // Update header/floating count if exists
                    const wlCount = document.getElementById('wishlist-count');
                    if (wlCount) wlCount.innerText = data.count;
                }
            })
            .catch(err => console.error(err));
        }

        function addToCart(productId) {
            fetch(`{{ url('/cart/add') }}/${productId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if(data.status === 'success' || data.cart_count) {
                    alert('Produk berhasil ditambahkan ke keranjang!');
                    const cartCountNavbar = document.getElementById('cart-count'); 
                    if (cartCountNavbar) {
                        cartCountNavbar.innerText = data.cart_count;
                    }
                } else if(data.status === 'error') {
                    alert(data.message || 'Gagal menambahkan ke keranjang');
                    if (data.message === 'Login dulu') {
                        window.location.href = '/login';
                    }
                }
            });
        }
    </script>
@endsection
