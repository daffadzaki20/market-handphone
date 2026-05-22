<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title><?php echo $__env->yieldContent('title', 'Admin Dashboard'); ?></title>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>

<body class="bg-gradient-to-br from-sky-50 via-white to-cyan-50 text-gray-700">

<div class="flex h-screen overflow-hidden">

    
    <aside class="w-72 bg-white border-r border-blue-100 shadow-2xl flex flex-col">

        
        <div class="p-6 border-b border-blue-100 bg-gradient-to-r from-blue-500 to-cyan-400">

            <div class="flex items-center gap-4">

                <div class="w-14 h-14 rounded-3xl bg-white/20 backdrop-blur flex items-center justify-center text-white text-2xl shadow-lg">
                    📱
                </div>

                <div>
                    <h1 class="text-3xl font-extrabold tracking-wide text-white">
                        MarketPhone
                    </h1>

                    <p class="text-sm text-blue-100 mt-1">
                        Admin Dashboard
                    </p>
                </div>

            </div>

        </div>

        
        <nav class="flex-1 p-5 space-y-3 bg-white">

            
            <a href="<?php echo e(route('admin.dashboard')); ?>"
               class="flex items-center gap-4 px-5 py-4 rounded-2xl transition-all duration-300
               <?php echo e(request()->is('admin')
                    ? 'bg-gradient-to-r from-blue-500 to-cyan-400 text-white shadow-lg scale-[1.02]'
                    : 'text-gray-600 hover:bg-blue-50 hover:text-blue-600 hover:shadow-md'); ?>">

                <span class="text-xl">📊</span>
                <span class="font-semibold">Dashboard</span>

            </a>

            
            <a href="<?php echo e(route('admin.handphones.index')); ?>"
               class="flex items-center gap-4 px-5 py-4 rounded-2xl transition-all duration-300
               <?php echo e(request()->is('admin/handphones*')
                    ? 'bg-gradient-to-r from-blue-500 to-cyan-400 text-white shadow-lg scale-[1.02]'
                    : 'text-gray-600 hover:bg-blue-50 hover:text-blue-600 hover:shadow-md'); ?>">

                <span class="text-xl">📱</span>
                <span class="font-semibold">Handphone</span>

            </a>

            
            <a href="<?php echo e(route('admin.aksesoris.index')); ?>"
               class="flex items-center gap-4 px-5 py-4 rounded-2xl transition-all duration-300
               <?php echo e(request()->is('admin/aksesoris*')
                    ? 'bg-gradient-to-r from-blue-500 to-cyan-400 text-white shadow-lg scale-[1.02]'
                    : 'text-gray-600 hover:bg-blue-50 hover:text-blue-600 hover:shadow-md'); ?>">

                <span class="text-xl">🎧</span>
                <span class="font-semibold">Aksesoris</span>

            </a>

            
            <a href="<?php echo e(route('admin.users.index')); ?>"
               class="flex items-center gap-4 px-5 py-4 rounded-2xl transition-all duration-300
               <?php echo e(request()->is('admin/users*')
                    ? 'bg-gradient-to-r from-blue-500 to-cyan-400 text-white shadow-lg scale-[1.02]'
                    : 'text-gray-600 hover:bg-blue-50 hover:text-blue-600 hover:shadow-md'); ?>">

                <span class="text-xl">👤</span>
                <span class="font-semibold">Users</span>

            </a>

        </nav>

        
        <div class="p-5 border-t border-blue-100 bg-blue-50">

            <div class="flex items-center justify-between">

                <div class="flex items-center gap-3">

                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-500 to-cyan-400 flex items-center justify-center text-white font-bold shadow-lg">
                        <?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?>

                    </div>

                    <div>
                        <p class="text-sm font-bold text-gray-700">
                            <?php echo e(Auth::user()->name); ?>

                        </p>

                        <p class="text-xs text-blue-500">
                            Administrator
                        </p>
                    </div>

                </div>

                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>

                    <button type="submit"
                            class="px-4 py-2 rounded-xl bg-red-100 text-red-500 hover:bg-red-200 transition-all duration-300 text-sm font-semibold shadow-sm">

                        Logout

                    </button>

                </form>

            </div>

        </div>

    </aside>

    
    <div class="flex-1 flex flex-col overflow-hidden">

        
        <header class="h-20 bg-white border-b border-blue-100 shadow-sm flex items-center justify-between px-8">

            <div>
                <h2 class="text-3xl font-extrabold text-gray-700">
                    <?php echo $__env->yieldContent('title'); ?>
                </h2>

                <p class="text-sm text-gray-400 mt-1">
                    Welcome back, Admin 👋
                </p>
            </div>

            <div class="px-5 py-3 rounded-2xl bg-gradient-to-r from-blue-500 to-cyan-400 text-white text-sm font-semibold shadow-lg">

                <?php echo e(date('l, d M Y')); ?>


            </div>

        </header>

        
        <main class="flex-1 overflow-y-auto p-8 bg-gradient-to-br from-blue-50/50 to-cyan-50/30">

            <div class="max-w-7xl mx-auto">

                
                <div class="bg-white rounded-[32px] shadow-xl border border-blue-100 p-8 min-h-[300px]">

                    <?php echo $__env->yieldContent('content'); ?>

                </div>

            </div>

        </main>

    </div>

</div>

</body>
</html><?php /**PATH D:\S6\PengemWeb\market-handphone\resources\views/layouts/app_admin.blade.php ENDPATH**/ ?>