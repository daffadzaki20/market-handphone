<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" style="background-color: #f3f4f6;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'MyPhoneStore')); ?></title>

    <!-- Scripts & Styles -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    
    <!-- CSS Tambahan -->
    <style>
        .cloak-icon { width: 32px !important; height: 32px !important; color: #6b7280; }
        
        /* Efek Sembunyi Wishlist (Diubah classnya agar tidak bentrok dengan class group di Tailwind) */
        .wishlist-group {
            transform: translateX(calc(100% - 45px));
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .wishlist-group:hover {
            transform: translateX(0);
        }
    </style>
</head>

<body class="font-sans antialiased text-gray-900 bg-gray-100" style="background-color: #f3f4f6;">

    <div class="min-h-screen">
        <!-- ========================================== -->
        <!-- NAVBAR CUSTOM MYPHONESTORE -->
        <!-- ========================================== -->
        <nav class="bg-white shadow-md relative z-[50]">
            <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">

                <!-- BRAND -->
                <a href="/dashboard" class="text-xl font-black text-blue-600 tracking-tight hover:scale-105 transition-transform">
                    📱 MyPhoneStore
                </a>

                <!-- MENU (DESKTOP) -->
                <div class="hidden md:flex space-x-8 text-sm font-bold">
                    <a href="/dashboard" class="pb-1 transition-colors duration-200 <?php echo e(request()->is('dashboard') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-blue-500'); ?>">
                        Home
                    </a>
                    <a href="/products/handphone" class="pb-1 transition-colors duration-200 <?php echo e(request()->is('products/handphone') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-blue-500'); ?>">
                        Handphone
                    </a>
                    <a href="/products/aksesoris" class="pb-1 transition-colors duration-200 <?php echo e(request()->is('products/aksesoris') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-blue-500'); ?>">
                        Aksesoris
                    </a>
                    <a href="<?php echo e(route('orders.index')); ?>" class="pb-1 transition-colors duration-200 <?php echo e(request()->is('orders') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-blue-500'); ?>">
                        Pesanan Saya
                    </a>

                </div>

                <div class="flex items-center gap-5">
                    <!-- NOTIFIKASI -->
                    <?php if(auth()->guard()->check()): ?>
                    <a href="/profile/notifikasi" class="relative text-gray-400 hover:text-orange-500 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        <span class="absolute -top-1.5 -right-1.5 bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full border-2 border-white shadow-sm">
                            3
                        </span>
                    </a>
                    <?php endif; ?>
                    
                    <!-- KERANJANG -->
                    <a href="/cart" id="cart-icon" class="relative text-gray-400 hover:text-orange-500 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span id="cart-count" class="absolute -top-1.5 -right-1.5 bg-orange-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full border-2 border-white shadow-sm">
                            <?php echo e(Auth::check() ? \App\Models\Cart::where('user_id', Auth::id())->sum('quantity') : 0); ?>

                        </span>
                    </a>

                    <!-- Garis Pembatas -->
                    <div class="h-6 w-[2px] bg-gray-200 mx-1"></div>

                    <!-- PROFILE -->
                    <a href="<?php echo e(Auth::check() ? '/profile' : '/login'); ?>" class="flex items-center gap-2 hover:bg-gray-50 px-2 py-1.5 rounded-full transition-colors group">
                        <?php if(auth()->guard()->check()): ?>
                            <?php if(Auth::user()->profile_photo): ?>
                                <img src="<?php echo e(asset('storage/' . Auth::user()->profile_photo)); ?>" class="w-8 h-8 rounded-full border border-gray-200 shadow-sm object-cover group-hover:border-blue-500 transition-colors">
                            <?php else: ?>
                                <div class="w-8 h-8 bg-slate-800 text-white rounded-full flex items-center justify-center text-sm font-bold shadow-sm group-hover:bg-blue-600 transition-colors">
                                    <?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?>

                                </div>
                            <?php endif; ?>
                            <span class="font-bold text-sm text-gray-700 hidden sm:block group-hover:text-blue-600 transition-colors">
                                <?php echo e(Auth::user()->username ?? Auth::user()->name); ?>

                            </span>
                        <?php else: ?>
                            <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center border border-gray-200 shadow-sm text-gray-500 group-hover:bg-blue-50 group-hover:text-blue-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <span class="font-bold text-sm text-gray-700 hidden sm:block group-hover:text-blue-600 transition-colors">Login</span>
                        <?php endif; ?>
                    </a>
                </div>
            </div>
        </nav>

        <!-- (Opsional) BREEZE HEADER UNTUK HALAMAN PROFIL -->
        <?php if(isset($header)): ?>
            <header class="bg-white border-b border-gray-100">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    <?php echo e($header); ?>

                </div>
            </header>
        <?php endif; ?>

        <!-- ========================================== -->
        <!-- CONTENT WRAPPER -->
        <!-- ========================================== -->
        <!-- 🔥 Di sinilah isi dari dashboard.blade.php kamu dimasukkan secara otomatis -->
        <main>
    <?php echo $__env->yieldContent('content'); ?>
</main>


    </div>

    <!-- ========================================== -->
    <!-- FLOATING WISHLIST SIDEBAR -->
    <!-- ========================================== -->
    <div class="fixed right-0 top-1/2 -translate-y-1/2 z-[9999] flex items-center wishlist-group">
        <!-- Bagian Tombol -->
        <div class="bg-white border-y border-l border-gray-200 shadow-[-4px_0_10px_rgba(0,0,0,0.05)] rounded-l-2xl p-3 cursor-pointer transition-all duration-300 transform translate-x-1 hover:translate-x-0 group">
            <div class="relative">
                <svg class="w-7 h-7 text-red-500 fill-current group-hover:scale-110 transition-transform" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
                <span class="absolute -top-2 -right-2 bg-gray-800 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full border-2 border-white">
                    0
                </span>
            </div>
        </div>

        <!-- Panel Detail -->
        <div class="max-w-0 overflow-hidden wishlist-group-hover:max-w-xs transition-all duration-500 ease-in-out" style="transition: max-width 0.5s ease;">
            <div class="bg-white border border-gray-200 shadow-xl rounded-l-xl p-4 w-64 mr-[-1px]">
                <h3 class="font-bold text-gray-800 text-sm mb-2 flex items-center gap-2">
                    ❤️ Wishlist Saya
                </h3>
                <p class="text-xs text-gray-500 mb-3 italic">Produk yang Anda sukai akan muncul di sini.</p>
                <a href="/wishlist" class="block text-center bg-red-50 text-red-600 py-2 rounded-lg text-xs font-bold hover:bg-red-100 transition-colors border border-red-100">
                    Lihat Semua Wishlist
                </a>
            </div>
        </div>
    </div>

</body>
</html><?php /**PATH D:\XampUtama\htdocs\handphone\resources\views/layouts/app.blade.php ENDPATH**/ ?>