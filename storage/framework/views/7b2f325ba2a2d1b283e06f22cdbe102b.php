<?php $__env->startSection('content'); ?>

<?php
    $lastReadString = session('notif_last_read_time', '2000-01-01 00:00:00');
    $lastReadTime = \Carbon\Carbon::parse($lastReadString);

    $allNotifs = collect();

    if(isset($vouchers)) {
        foreach($vouchers as $voucher) {
            $allNotifs->push([
                'type'      => 'voucher',
                'timestamp' => $voucher->created_at,
                'is_new'    => $voucher->created_at->gt($lastReadTime), 
                'data'      => $voucher
            ]);
        }
    }

    if(isset($orders)) {
        foreach($orders as $order) {
            $allNotifs->push([
                'type'      => 'order',
                'timestamp' => $order->updated_at,
                'is_new'    => $order->updated_at->gt($lastReadTime), 
                'data'      => $order
            ]);
        }
    }

    $sortedNotifs = $allNotifs->sortByDesc('timestamp')->values();
    $totalNotif   = $sortedNotifs->count();

    session(['notif_last_read_time' => now()->toDateTimeString()]);
    session()->save();
?>

<!-- Wrapper Utama -->
<div class="max-w-6xl mx-auto px-4 py-6 md:py-8 flex flex-col md:flex-row gap-4 md:gap-3">

    <!-- SIDEBAR KIRI -->
    <div class="w-full md:w-48 flex-shrink-0">
        <!-- User Mini Profile -->
        <div class="flex items-center gap-3 mb-6 pb-6 border-b border-gray-200">
            <?php if(Auth::user()->profile_photo): ?>
                <img src="<?php echo e(asset('storage/' . Auth::user()->profile_photo)); ?>" alt="Avatar" class="w-12 h-12 rounded-full object-cover border border-gray-200">
            <?php else: ?>
                <div class="w-12 h-12 bg-slate-500 text-white rounded-full flex items-center justify-center text-xl font-semibold">
                    <?php echo e(strtoupper(substr(Auth::user()->username, 0, 1))); ?>

                </div>
            <?php endif; ?>
            
            <div class="overflow-hidden">
                <div class="font-bold text-gray-800 truncate"><?php echo e(Auth::user()->username); ?></div>
                <a href="<?php echo e(route('profile.edit')); ?>" class="text-sm text-gray-500 flex items-center gap-1 mt-0.5 hover:text-orange-500 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    Ubah Profil
                </a>
            </div>
        </div>

        <!-- Menu Navigasi Sidebar -->
        <nav class="space-y-5 text-sm">
            <div>
                <div class="flex items-center gap-2 font-semibold text-gray-800 mb-2 cursor-pointer hover:text-orange-500 transition-colors">
                    <span class="text-blue-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </span>
                    Akun Saya
                </div>
                <div class="pl-7 space-y-3 mt-2">
                    <a href="<?php echo e(route('profile.edit')); ?>" class="block text-gray-600 hover:text-orange-500 transition-colors">Profil</a>
                    <a href="<?php echo e(route('profile.bank')); ?>" class="block text-gray-600 hover:text-orange-500 transition-colors">Bank & Kartu</a>
                    <a href="<?php echo e(route('alamat.index')); ?>" class="block text-gray-600 hover:text-orange-500 transition-colors">Alamat</a>
                    <a href="<?php echo e(route('profile.password')); ?>" class="block text-gray-600 hover:text-orange-500 transition-colors">Ubah Password</a>
                </div>
            </div>

            <a href="<?php echo e(route('profile.orders')); ?>" class="flex items-center gap-2 font-semibold text-gray-700 hover:text-orange-500 transition-colors">
                <span class="text-blue-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </span>
                Pesanan Saya
            </a>
            
            <a href="<?php echo e(route('profile.notifications')); ?>" class="flex items-center gap-2 font-semibold text-orange-500 transition-colors">
                <span class="text-orange-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                </span>
                Notifikasi
            </a>

           <a href="<?php echo e(route('profile.voucher')); ?>" class="flex items-center gap-2 font-semibold text-gray-700 hover:text-orange-500 transition-colors">
                <span class="text-orange-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                </span>
                Voucher Saya
            </a>
        </nav>

        <div class="border-t border-gray-100 my-4"></div>

        <form method="POST" action="<?php echo e(route('logout')); ?>" class="flex items-center gap-2 font-semibold text-red-500 hover:bg-red-50 p-2 rounded-lg transition-colors">
            <?php echo csrf_field(); ?>
            <button type="submit" class="flex items-center gap-2 w-full text-left">
                <span class="text-red-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                </span>
                Logout
            </button>
        </form>
    </div>

    <!-- KONTEN UTAMA KANAN (NOTIFIKASI) -->
    <div class="flex-1 bg-white shadow-sm border border-gray-100 rounded-md overflow-hidden flex flex-col">  
        
        <!-- Header -->
        <div class="border-b border-gray-200 p-5 md:p-6 flex justify-between items-center bg-white">
            <h1 class="text-xl font-medium text-gray-800">Notifikasi</h1>
            <span class="text-sm text-gray-400">Total: <?php echo e($totalNotif); ?> Pemberitahuan</span>
        </div>

        <!-- AREA FEEDBACK PESAN (Sukses / Error) -->
        <?php if(session('success')): ?>
            <div class="m-5 mb-0 p-4 bg-green-50 border border-green-200 text-green-700 text-sm font-medium rounded-md flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="m-5 mb-0 p-4 bg-red-50 border border-red-200 text-red-700 text-sm font-medium rounded-md flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>

        <!-- Daftar Notifikasi -->
        <div class="flex flex-col" id="notif-wrapper">
            
            <?php $__empty_1 = true; $__currentLoopData = $sortedNotifs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                
                <?php if($notif['type'] == 'voucher'): ?>
                    <?php 
                        $voucher = $notif['data']; 
                        // Cek apakah user sudah punya voucher ini
                        $isClaimed = \App\Models\UserVoucher::where('user_id', Auth::id())->where('voucher_id', $voucher->id)->exists();
                    ?>
                    <!-- Item Voucher -->
                    <div class="notif-item flex gap-4 p-5 md:p-6 transition-all <?php echo e($notif['is_new'] ? 'bg-orange-50/70 border-l-4 border-orange-500' : 'bg-white hover:bg-gray-50 border-b border-gray-100'); ?>">
                        <div class="w-12 h-12 flex-shrink-0 bg-white border border-orange-200 text-orange-500 rounded-full flex items-center justify-center shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-1">
                                <div class="flex items-center gap-2">
                                    <h3 class="text-base font-semibold <?php echo e($notif['is_new'] ? 'text-gray-900' : 'text-gray-700'); ?>">Voucher Belanja Baru! 🎉</h3>
                                    <?php if($notif['is_new']): ?>
                                        <span class="bg-red-500 text-white text-[10px] uppercase font-bold px-2 py-0.5 rounded-full animate-pulse">Baru</span>
                                    <?php endif; ?>
                                </div>
                                <span class="text-xs <?php echo e($notif['is_new'] ? 'text-orange-600 font-semibold' : 'text-gray-400'); ?>"><?php echo e($notif['timestamp']->diffForHumans()); ?></span>
                            </div>
                            <p class="text-sm <?php echo e($notif['is_new'] ? 'text-gray-800' : 'text-gray-500'); ?> leading-relaxed mb-3">
                                Tersedia kode voucher <strong class="text-orange-600 font-bold uppercase"><?php echo e($voucher->code); ?></strong> 
                                (<?php echo e($voucher->type == 'percent' ? 'Diskon ' . $voucher->value . '%' : 'Potongan Rp ' . number_format($voucher->value, 0, ',', '.')); ?>) 
                                dengan minimum belanja Rp <?php echo e(number_format($voucher->min_spend, 0, ',', '.')); ?>. Stok kuota: <?php echo e($voucher->stock); ?>.
                            </p>
                            
                            <!-- LOGIKA TOMBOL KLAIM -->
                            <?php if($isClaimed): ?>
                                <button disabled class="inline-block bg-gray-200 text-gray-500 text-xs font-bold px-4 py-2 rounded-md cursor-not-allowed border border-gray-300">
                                    Sudah Diklaim
                                </button>
                            <?php elseif($voucher->stock <= 0): ?>
                                <button disabled class="inline-block bg-red-100 text-red-500 text-xs font-bold px-4 py-2 rounded-md cursor-not-allowed border border-red-200">
                                    Kuota Habis
                                </button>
                            <?php else: ?>
                                <form action="<?php echo e(route('profile.voucher.claim')); ?>" method="POST" class="inline-block">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="code" value="<?php echo e($voucher->code); ?>">
                                    <button type="submit" class="inline-block bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold px-4 py-2 rounded-md transition-colors shadow-sm">
                                        Klaim Voucher Sekarang
                                    </button>
                                </form>
                            <?php endif; ?>

                        </div>
                    </div>

                <?php elseif($notif['type'] == 'order'): ?>
                    <?php $order = $notif['data']; ?>
                    <!-- Item Pesanan -->
                    <div class="notif-item flex gap-4 p-5 md:p-6 transition-all <?php echo e($notif['is_new'] ? 'bg-blue-50/70 border-l-4 border-blue-500' : 'bg-white hover:bg-gray-50 border-b border-gray-100'); ?>">
                        <div class="w-12 h-12 flex-shrink-0 bg-white border border-blue-200 text-blue-500 rounded-full flex items-center justify-center shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-1">
                                <div class="flex items-center gap-2">
                                    <h3 class="text-base font-semibold <?php echo e($notif['is_new'] ? 'text-gray-900' : 'text-gray-700'); ?>">Status Pesanan: <span class="uppercase text-blue-600"><?php echo e($order->status); ?></span></h3>
                                    <?php if($notif['is_new']): ?>
                                        <span class="bg-red-500 text-white text-[10px] uppercase font-bold px-2 py-0.5 rounded-full animate-pulse">Pembaruan</span>
                                    <?php endif; ?>
                                </div>
                                <span class="text-xs <?php echo e($notif['is_new'] ? 'text-blue-600 font-semibold' : 'text-gray-400'); ?>"><?php echo e($notif['timestamp']->diffForHumans()); ?></span>
                            </div>
                            <p class="text-sm <?php echo e($notif['is_new'] ? 'text-gray-800' : 'text-gray-500'); ?> leading-relaxed mb-2">
                                Pesanan dengan Total Tagihan <strong class="text-gray-800">Rp <?php echo e(number_format($order->total, 0, ',', '.')); ?></strong> saat ini berada dalam status <strong class="uppercase"><?php echo e($order->status); ?></strong>.
                            </p>
                            <a href="<?php echo e(route('profile.orders')); ?>" class="text-xs font-medium text-blue-600 hover:underline">Lihat Detail Pesanan →</a>
                        </div>
                    </div>
                <?php endif; ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <!-- Kosong -->
                <div class="p-10 text-center text-gray-400 text-sm">
                    Belum ada notifikasi atau pemberitahuan saat ini.
                </div>
            <?php endif; ?>
            
        </div>

        <!-- Tombol Tampilkan Lebih Banyak -->
        <?php if($totalNotif > 4): ?>
            <div id="load-more-container" class="p-5 text-center bg-gray-50/50 border-t border-gray-100 hidden">
                <p id="notif-count-text" class="text-xs text-gray-400 mb-2"></p>
                <button id="load-more-btn" class="text-sm font-medium text-orange-500 hover:text-orange-600 transition-colors flex items-center justify-center gap-1 mx-auto">
                    Tampilkan Notifikasi Lainnya
                    <svg class="w-4 h-4 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
            </div>
        <?php endif; ?>
        
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const notifItems = document.querySelectorAll('.notif-item');
    const loadMoreContainer = document.getElementById('load-more-container');
    const loadMoreBtn = document.getElementById('load-more-btn');
    const notifCountText = document.getElementById('notif-count-text');

    const totalItems = notifItems.length;
    const itemsToShow = 4;

    if (totalItems > itemsToShow) {
        notifItems.forEach((item, index) => {
            if (index >= itemsToShow) {
                item.classList.add('hidden');
            }
        });

        if(loadMoreContainer) {
            loadMoreContainer.classList.remove('hidden');
            notifCountText.innerText = `Menampilkan ${itemsToShow} dari ${totalItems} notifikasi`;
        }

        if(loadMoreBtn) {
            loadMoreBtn.addEventListener('click', function() {
                notifItems.forEach(item => item.classList.remove('hidden'));
                loadMoreContainer.classList.add('hidden');
            });
        }
    }
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\projek pak fajar\market-handphone\resources\views/user/profile/notifikasi.blade.php ENDPATH**/ ?>