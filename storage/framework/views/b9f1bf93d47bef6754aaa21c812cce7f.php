<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" style="background-color: #f3f4f6;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'MyPhoneStore')); ?></title>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        .cloak-icon { width: 32px !important; height: 32px !important; color: #6b7280; }
    </style>
</head>

<body class="font-sans antialiased text-gray-900 bg-gray-100" style="background-color: #f3f4f6;">

    <div class="min-h-screen">
        <nav x-data="{ mobileMenuOpen: false }" class="bg-white shadow-md relative z-[50]">
            <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">

                
                <a href="<?php echo e(url('/')); ?>" class="text-xl font-black text-blue-600 tracking-tight hover:scale-105 transition-transform">
                    📱 MyPhoneStore
                </a>

                
                <div class="hidden md:flex space-x-8 text-sm font-bold">
                    <a href="<?php echo e(url('/')); ?>" class="pb-1 transition-colors duration-200 <?php echo e(request()->is('/') || request()->is('dashboard') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-blue-500'); ?>">
                        Home
                    </a>
                    <a href="<?php echo e(route('products.handphone')); ?>" class="pb-1 transition-colors duration-200 <?php echo e(request()->is('products/handphone') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-blue-500'); ?>">
                        Handphone
                    </a>
                    <a href="<?php echo e(route('products.aksesoris')); ?>" class="pb-1 transition-colors duration-200 <?php echo e(request()->is('products/aksesoris') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-blue-500'); ?>">
                        Aksesoris
                    </a>
                    
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('orders.index')); ?>" class="pb-1 transition-colors duration-200 <?php echo e(request()->is('orders') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-blue-500'); ?>">
                            Pesanan Saya
                        </a>
                    <?php endif; ?>
                </div>

                
                <div class="flex items-center gap-4 sm:gap-5">

                    
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('profile.notifications')); ?>" class="relative text-gray-400 hover:text-orange-500 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                            <span class="absolute -top-1.5 -right-1.5 bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full border-2 border-white shadow-sm">
                                3
                            </span>
                        </a>
                    <?php endif; ?>

                    
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('cart.index')); ?>" id="cart-icon" class="relative text-gray-400 hover:text-orange-500 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span id="cart-count" class="absolute -top-1.5 -right-1.5 bg-orange-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full border-2 border-white shadow-sm">
                                <?php echo e(\App\Models\Cart::where('user_id', Auth::id())->sum('quantity')); ?>

                            </span>
                        </a>
                    <?php endif; ?>

                    <div class="hidden sm:block h-6 w-[2px] bg-gray-200 mx-1"></div>

                    
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('profile.edit')); ?>" class="flex items-center gap-2 hover:bg-gray-50 px-2 py-1.5 rounded-full transition-colors group">
                            <?php if(Auth::user()->profile_photo): ?>
                                <img src="<?php echo e(asset('storage/' . Auth::user()->profile_photo)); ?>" class="w-8 h-8 rounded-full border border-gray-200 shadow-sm object-cover group-hover:border-blue-500 transition-colors">
                            <?php else: ?>
                                <div class="w-8 h-8 bg-slate-800 text-white rounded-full flex items-center justify-center text-sm font-bold shadow-sm group-hover:bg-blue-600 transition-colors">
                                    <?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?>

                                </div>
                            <?php endif; ?>
                            <span class="font-bold text-sm text-gray-700 hidden lg:block group-hover:text-blue-600 transition-colors">
                                <?php echo e(Auth::user()->username ?? Auth::user()->name); ?>

                            </span>
                        </a>
                    <?php else: ?>
                        
                        <a href="<?php echo e(route('login')); ?>" class="flex items-center gap-2 hover:bg-gray-50 px-2 py-1.5 rounded-full transition-colors group">
                            <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center border border-gray-200 shadow-sm text-gray-500 group-hover:bg-blue-50 group-hover:text-blue-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <span class="font-bold text-sm text-gray-700 hidden lg:block group-hover:text-blue-600 transition-colors">Login</span>
                        </a>
                    <?php endif; ?>

                    
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-blue-600 hover:bg-gray-100 focus:outline-none transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-show="!mobileMenuOpen">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-show="mobileMenuOpen" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            
            <div x-show="mobileMenuOpen" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-2"
                 class="md:hidden absolute top-full left-0 w-full bg-white border-t border-gray-100 shadow-xl"
                 style="display: none;">
                <div class="px-4 pt-2 pb-4 space-y-1">
                    <a href="<?php echo e(url('/')); ?>" class="block px-4 py-3 rounded-xl font-bold <?php echo e(request()->is('/') || request()->is('dashboard') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-blue-600'); ?>">
                        🏠 Home
                    </a>
                    <a href="<?php echo e(route('products.handphone')); ?>" class="block px-4 py-3 rounded-xl font-bold <?php echo e(request()->is('products/handphone') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-blue-600'); ?>">
                        📱 Handphone
                    </a>
                    <a href="<?php echo e(route('products.aksesoris')); ?>" class="block px-4 py-3 rounded-xl font-bold <?php echo e(request()->is('products/aksesoris') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-blue-600'); ?>">
                        🎧 Aksesoris
                    </a>
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('orders.index')); ?>" class="block px-4 py-3 rounded-xl font-bold <?php echo e(request()->is('orders') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-blue-600'); ?>">
                            📦 Pesanan Saya
                        </a>
                        <a href="<?php echo e(route('profile.edit')); ?>" class="block px-4 py-3 rounded-xl font-bold <?php echo e(request()->is('profile') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-blue-600'); ?>">
                            👤 Profil Saya
                        </a>
                        <div class="border-t border-gray-100 pt-2 mt-2">
                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="w-full text-left block px-4 py-3 rounded-xl font-bold text-red-500 hover:bg-red-50 transition-colors">
                                    🚪 Logout
                                </button>
                            </form>
                        </div>
                    <?php else: ?>
                        <div class="border-t border-gray-100 pt-2 mt-2">
                            <a href="<?php echo e(route('login')); ?>" class="block px-4 py-3 rounded-xl font-bold text-blue-600 hover:bg-blue-50">
                                🔐 Login
                            </a>
                            <a href="<?php echo e(route('register')); ?>" class="block px-4 py-3 rounded-xl font-bold text-orange-500 hover:bg-orange-50">
                                📝 Daftar
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </nav>

        <?php if(isset($header)): ?>
            <header class="bg-white border-b border-gray-100">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    <?php echo e($header); ?>

                </div>
            </header>
        <?php endif; ?>

        <main>
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>

    
    <div x-data="{ wishlistOpen: false }" 
         @click.outside="wishlistOpen = false"
         @mouseenter="if(window.innerWidth >= 768) wishlistOpen = true"
         @mouseleave="if(window.innerWidth >= 768) wishlistOpen = false"
         id="wishlist-toggle" 
         class="fixed right-0 top-1/2 -translate-y-1/2 z-[9999] flex items-center transition-transform duration-500 ease-in-out"
         :class="wishlistOpen ? 'translate-x-0' : 'translate-x-[calc(100%-64px)]'">
         
        <div @click="if(window.innerWidth < 768) wishlistOpen = !wishlistOpen" 
             class="bg-white/80 backdrop-blur-lg border border-white/50 shadow-2xl rounded-l-3xl p-4 cursor-pointer hover:bg-white transition-all">
            <div class="relative">
                <svg class="w-8 h-8 text-red-500 fill-current animate-pulse" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
                <span class="absolute -top-3 -right-3 bg-red-600 text-white text-[10px] font-bold px-2 py-1 rounded-full border-2 border-white shadow-sm">0</span>
            </div>
        </div>
        
        <div class="overflow-hidden transition-all duration-500 ease-in-out"
             :class="wishlistOpen ? 'max-w-xs opacity-100 visible' : 'max-w-0 opacity-0 invisible'">
            <div class="bg-white/90 backdrop-blur-xl border border-white shadow-2xl rounded-l-2xl p-6 w-72">
                <h3 class="font-black text-gray-800 text-base mb-2">❤️ My Favorites</h3>
                <p class="text-xs text-gray-500 mb-4 italic leading-relaxed">Produk impianmu tersimpan aman di sini.</p>
                <a href="#" @click.prevent="alert('Fitur Wishlist sedang dalam tahap pengembangan.')" 
                   class="block text-center bg-gray-100 text-gray-500 py-3 rounded-xl text-xs font-black shadow-sm hover:scale-105 transition-all uppercase tracking-widest border border-gray-200 cursor-not-allowed">
                    Fitur Segera Hadir
                </a>
            </div>
        </div>
    </div>

    <?php echo $__env->yieldPushContent('scripts'); ?>

</body>
</html>
<?php /**PATH D:\projek pak fajar\market-handphone\resources\views/layouts/app.blade.php ENDPATH**/ ?>