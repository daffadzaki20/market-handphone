

<?php $__env->startSection('content'); ?>

    <!-- WRAPPER UTAMA (Agar tidak menabrak navbar dan responsif di HP) -->
    <div class="py-12 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Bungkusan Konten -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-6 md:p-10">

                <!-- KIRI: FOTO PRODUK -->
                <div class="flex justify-center items-center mb-6 md:mb-0 relative">
                    <!-- Tombol Kembali (Mobile Friendly) diletakkan di sudut kiri atas gambar -->
                    <a href="<?php echo e($brandType === 'aksesoris' ? '/products/aksesoris' : '/products/handphone'); ?>" class="absolute top-0 left-0 bg-white/80 backdrop-blur-sm border border-gray-200 text-gray-600 hover:text-blue-600 p-2 rounded-xl transition-colors shadow-sm md:hidden">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </a>

                    <?php if(isset($product->image) && $product->image): ?>
                        <img id="product-image" 
                             src="<?php echo e($product->image_url); ?>"
                             alt="<?php echo e($product->name); ?>"
                             class="w-full max-w-md h-72 md:h-[400px] object-contain rounded-2xl border border-gray-100 shadow-sm p-6 bg-gray-50 transition-transform duration-500 hover:scale-105">
                    <?php else: ?>
                        <!-- Placeholder jika tidak ada gambar -->
                        <div id="product-image" class="w-full max-w-md h-72 md:h-[400px] flex flex-col items-center justify-center rounded-2xl border border-gray-100 shadow-sm p-6 bg-gray-50 text-gray-300">
                            <svg class="w-24 h-24 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span class="text-sm font-medium text-gray-400">Gambar Belum Tersedia</span>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- KANAN: INFO PRODUK -->
                <div class="flex flex-col justify-center">
                    
                    <!-- Kategori & Brand -->
                    <div class="flex items-center gap-3 mb-3">
                        <span class="bg-blue-50 text-blue-600 text-xs font-black px-3 py-1 rounded-full uppercase tracking-widest border border-blue-100">
                            <?php echo e($product->brand?->name ?? 'Unbranded'); ?>

                        </span>
                        <span class="text-gray-400 text-sm flex items-center font-medium">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                            <?php echo e($brandType === 'hp' ? 'Handphone' : 'Aksesoris'); ?>

                        </span>
                    </div>

                    <h1 class="text-3xl md:text-4xl font-black text-gray-800 mb-4 leading-tight"><?php echo e($product->name); ?></h1>

                    <div class="flex flex-wrap items-end gap-4 mb-6 border-b border-gray-100 pb-6">
                        <p class="text-4xl text-orange-500 font-black tracking-tight">
                            Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?>

                        </p>
                        <?php if(isset($product->stock)): ?>
                            <div class="bg-<?php echo e($product->stock > 5 ? 'green' : 'red'); ?>-50 text-<?php echo e($product->stock > 5 ? 'green' : 'red'); ?>-600 px-3 py-1 rounded-lg text-sm font-bold border border-<?php echo e($product->stock > 5 ? 'green' : 'red'); ?>-100 mb-1">
                                Stok: <?php echo e($product->stock); ?>

                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Spesifikasi Handphone -->
                    <?php if($brandType === 'hp'): ?>
                    <div class="grid grid-cols-2 gap-4 mb-8 bg-gray-50 p-5 rounded-2xl border border-gray-100">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-blue-500 text-xl shadow-inner">📱</div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium uppercase tracking-wider mb-0.5">RAM</p>
                                <p class="text-base font-black text-gray-800"><?php echo e($product->ram ?? '-'); ?></p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center text-purple-500 text-xl shadow-inner">💾</div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium uppercase tracking-wider mb-0.5">Storage</p>
                                <p class="text-base font-black text-gray-800"><?php echo e($product->storage ?? '-'); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="mb-10">
                        <h3 class="text-sm font-black text-gray-800 mb-3 uppercase tracking-widest border-l-4 border-orange-500 pl-3">Deskripsi Produk</h3>
                        <p class="text-gray-600 leading-relaxed text-sm whitespace-pre-line"><?php echo e($product->description); ?></p>
                    </div>

                    <div class="mt-auto flex flex-col sm:flex-row gap-4">
                        <button onclick="addToCartAnimation()" 
                                class="flex-1 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 transition-all text-white py-4 px-4 rounded-xl font-black text-lg flex items-center justify-center gap-2 shadow-lg shadow-orange-200 hover:shadow-none hover:scale-[0.98] active:scale-95 group">
                            <svg class="w-6 h-6 group-hover:-rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            Masukkan Keranjang
                        </button>
                        
                        <a href="<?php echo e($brandType === 'aksesoris' ? '/products/aksesoris' : '/products/handphone'); ?>" class="hidden md:flex flex-none bg-white hover:bg-gray-50 border border-gray-200 transition-all text-gray-700 py-4 px-8 rounded-xl font-bold items-center justify-center shadow-sm hover:shadow-md">
                            Kembali
                        </a>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <!-- SCRIPT ANIMASI MASUK KERANJANG -->
    <script>
    function addToCartAnimation() {
        const imgToDrag = document.getElementById('product-image');
        const cart = document.getElementById('cart-icon');
        const cartCount = document.getElementById('cart-count');

        // Pastikan elemen ada dan tidak terjadi error jika cart di-hide (misal karena auth)
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
                transition: 'all 0.8s cubic-bezier(0.25, 1, 0.5, 1)', // Efek lebih smooth
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
                
                // 🔥 KIRIM DATA KE DATABASE 🔥
                fetch(`/cart/add/<?php echo e($product->id); ?>`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
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
                        // Update angka di navbar (Real-time dari database)
                        if(cartCount) {
                            cartCount.innerText = data.cart_count;
                            // Animasi pop-up pada badge merah
                            cartCount.classList.add('scale-150');
                            setTimeout(() => cartCount.classList.remove('scale-150'), 300);
                        }

                        // Efek visual pada ikon keranjang bergoyang
                        cart.classList.add('scale-125', 'text-orange-500', '-rotate-12');
                        setTimeout(() => cart.classList.remove('scale-125', 'text-orange-500', '-rotate-12'), 300);
                    }
                })
                .catch(error => console.error('Error:', error));

            }, 850);
        } else {
            // Jika user belum login dan icon cart tidak ada, arahkan langsung ke backend untuk diproses Auth
            window.location.href = '/login';
        }
    }
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\projek pak fajar\market-handphone\resources\views/user/products/detail.blade.php ENDPATH**/ ?>