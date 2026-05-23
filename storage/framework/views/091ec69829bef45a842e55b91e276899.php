<?php $__env->startSection('content'); ?>
<div class="max-w-3xl mx-auto mt-10 bg-white shadow-lg rounded-xl p-8">
    <!-- Judul -->
    <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center gap-2">
        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/>
        </svg>
        Detail Pesanan #<?php echo e($order->id); ?>

    </h2>

    <!-- Info pemesan -->
    <div class="space-y-2 mb-6">
        <p><span class="font-semibold text-gray-700">Pemesan:</span> <?php echo e($order->user->name); ?></p>
        <p><span class="font-semibold text-gray-700">Email:</span> <?php echo e($order->user->email); ?></p>
    </div>

    <!-- Info pesanan -->
    <div class="space-y-2 mb-6">
        <p><span class="font-semibold text-gray-700">Total:</span> 
           <span class="text-blue-600 font-bold">Rp <?php echo e(number_format($order->total, 0, ',', '.')); ?></span>
        </p>
        <p><span class="font-semibold text-gray-700">Status:</span> 
            <span class="px-3 py-1 rounded-full text-xs font-medium
                <?php echo e($order->status === 'diproses' ? 'bg-yellow-100 text-yellow-700' : ''); ?>

                <?php echo e($order->status === 'dikirim' ? 'bg-blue-100 text-blue-700' : ''); ?>

                <?php echo e($order->status === 'selesai' ? 'bg-green-100 text-green-700' : ''); ?>">
                <?php echo e(ucfirst($order->status)); ?>

            </span>
        </p>
    </div>

    <!-- Item pesanan -->
    <h3 class="text-lg font-semibold mb-3 text-gray-800">Item Pesanan:</h3>
    <div class="border rounded-lg divide-y">
        <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="flex justify-between items-center p-3 hover:bg-gray-50 transition">
                <span class="font-medium text-gray-700"><?php echo e($item->product->name); ?></span>
                <span class="text-gray-600">x <?php echo e($item->quantity); ?></span>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="mt-2 border-t border-gray-100 pt-6">
    <?php if($order->status == 'diproses'): ?>
        <div class="bg-red-50 p-4 rounded-2xl border border-red-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h4 class="font-bold text-red-800 text-sm">Ingin membatalkan pesanan?</h4>
                <p class="text-xs text-red-600 mt-0.5">Pembatalan hanya bisa dilakukan selama pesanan belum dikirim oleh admin.</p>
            </div>
            
            
            <form action="<?php echo e(route('user.orders.cancel', $order->id)); ?>" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2.5 px-5 rounded-xl shadow-md transition-all active:scale-95 text-xs uppercase tracking-wider">
                    Batalkan Pesanan
                </button>
            </form>
        </div>
    <?php elseif($order->status == 'dibatalkan'): ?>
        <div class="bg-gray-100 p-4 rounded-2xl border border-gray-200 text-center text-sm text-gray-500 italic font-medium">
            ❌ Pesanan ini telah dibatalkan.
        </div>
    <?php else: ?>
        <div class="bg-blue-50 p-4 rounded-2xl border border-blue-100 text-center text-sm text-blue-600 font-medium">
            🚚 Pesanan sedang dikirim/selesai. Tombol pembatalan sudah dikunci.
        </div>
    <?php endif; ?>
</div>

    <!-- Tombol kembali -->
    <div class="mt-8">
        <a href="<?php echo e(route('orders.index')); ?>" 
           class="inline-flex items-center bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">
           ← Kembali ke Pesanan Saya
        </a>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\S6\PengemWeb\market-handphone\resources\views/user/orders/show.blade.php ENDPATH**/ ?>