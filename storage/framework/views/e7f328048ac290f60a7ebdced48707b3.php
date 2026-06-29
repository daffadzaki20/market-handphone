<?php $__env->startSection('content'); ?>

     <!-- PEMBUNGKUS UTAMA -->
     <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
         
         <!-- JUDUL KATEGORI -->
         <h1 class="text-3xl font-black text-gray-800 tracking-tight mb-6">📱 Handphone</h1>

         <!-- 🔍 SEARCH BAR -->
         <form method="GET" action="<?php echo e(route('handphone.index')); ?>" class="mb-6 flex gap-3" id="searchForm">
             <div class="relative w-full">
                 <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                     <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                 </div>
                 <input type="text"
                        id="searchInput"
                        name="search"
                        value="<?php echo e(request('search')); ?>"
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
    <a href="<?php echo e(route('handphone.index', array_filter(['search' => request('search')]))); ?>"
       class="px-4 py-1.5 rounded-full text-sm font-medium transition-all shadow-sm
       <?php echo e(!request('brand') ? 'bg-blue-600 text-white' : 'bg-white text-gray-600 hover:bg-gray-50 border border-gray-200'); ?>">
        Semua Brand
    </a>

    <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <a href="<?php echo e(route('handphone.index', array_filter(['brand' => $brand->slug, 'search' => request('search')]))); ?>"
       class="px-4 py-1.5 rounded-full text-sm font-medium transition-all shadow-sm
       <?php echo e(request('brand') == $brand->slug ? 'bg-blue-600 text-white' : 'bg-white text-gray-600 hover:bg-gray-50 border border-gray-200'); ?>">
        <?php echo e($brand->name); ?>

    </a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

        <!-- ========================================== -->
        <!-- BUNGKUSAN PRODUK (PENTING UNTUK LIVE SEARCH) -->
        <!-- ========================================== -->
        <div id="productContainer" class="transition-opacity duration-300">

            <!-- 📦 GRID PRODUK -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 relative">

                <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <a href="<?php echo e(route('product.show', $product->id)); ?>"
                       class="bg-white rounded-2xl shadow-sm hover:shadow-xl border border-gray-100 transition-all duration-300 overflow-hidden group flex flex-col">

                        <!-- IMAGE -->
                        <div class="h-48 bg-gray-50 flex items-center justify-center overflow-hidden relative">
                            <?php if(isset($product->image) && $product->image): ?>
                                <img src="<?php echo e($product->image_url); ?>"
                                     alt="<?php echo e($product->name); ?>"
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <?php else: ?>
                                <!-- Placeholder jika tidak ada gambar -->
                                <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <?php endif; ?>
                        </div>

                        <!-- CONTENT -->
                        <div class="p-4 flex flex-col flex-grow">
                            <div class="text-xs font-bold text-blue-600 uppercase tracking-wider mb-1">
                                <?php echo e($product->brand->name ?? 'Tanpa Brand'); ?>

                            </div>

                            <h2 class="font-bold text-gray-800 text-base line-clamp-2 mb-2">
                                <?php echo e($product->name); ?>

                            </h2>

                            <p class="text-gray-900 font-black text-lg mb-2 mt-auto">
                                Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?>

                            </p>

                            <div class="flex items-center justify-between text-xs text-gray-500 mt-2 border-t border-gray-100 pt-2">
                                <span><?php echo e($product->ram ?? '-'); ?> / <?php echo e($product->storage ?? '-'); ?></span>
                                <span>Stok: <?php echo e($product->stock ?? 0); ?></span>
                            </div>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <!-- Tampilan jika produk tidak ditemukan -->
                    <div class="col-span-full py-16 flex flex-col items-center justify-center text-gray-500 bg-white rounded-2xl border border-gray-200 border-dashed">
                        <svg class="w-16 h-16 mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <h3 class="text-lg font-bold text-gray-800">Pencarian Tidak Ditemukan</h3>
                        <p class="mt-1">Coba gunakan kata kunci atau brand lain.</p>
                    </div>
                <?php endif; ?>

            </div>

            <!-- PAGINATION -->
            <div class="mt-10">
                <?php echo e($products->links()); ?>

            </div>

        </div>

    </div> <!-- Tutup Wrapper Utama -->

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

                // Efek Loading: Transparan
                productContainer.style.opacity = '0.4';

                typingTimer = setTimeout(function () {
                    // Ambil URL saat ini dan tambahkan/ubah parameter pencarian
                    const url = new URL(window.location.href);
                    if (keyword) {
                        url.searchParams.set('search', keyword);
                    } else {
                        url.searchParams.delete('search');
                    }

                    // Ambil data terbaru dari server di belakang layar
                    fetch(url)
                        .then(response => response.text())
                        .then(html => {
                            // Parsing HTML yang didapat
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');
                            
                            // Timpa kotak produk lama dengan yang baru
                            const newContainer = doc.getElementById('productContainer');
                            if(newContainer) {
                                productContainer.innerHTML = newContainer.innerHTML;
                            }
                            
                            // Kembalikan efek loading
                            productContainer.style.opacity = '1';

                            // Ubah URL di atas browser (agar jika di-refresh hasilnya tetap)
                            window.history.pushState({}, '', url);
                        })
                        .catch(error => {
                            console.error('Error fetching data:', error);
                            productContainer.style.opacity = '1';
                        });
                }, doneTypingInterval);
            });
            
            // Mencegah form di-submit manual dengan Enter jika JS berjalan
            document.getElementById('searchForm').addEventListener('submit', function(e) {
                e.preventDefault();
            });
        });
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XampUtama\htdocs\handphone\resources\views/user/products/handphone.blade.php ENDPATH**/ ?>