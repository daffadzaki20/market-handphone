<?php $__env->startSection('content'); ?>
<div class="max-w-2xl mx-auto mt-10 bg-white shadow-lg rounded-lg p-8 text-center">
    <!-- Ikon check -->
    <div class="flex justify-center mb-4">
        <div class="bg-green-100 text-green-600 rounded-full p-4">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
    </div>

    <h2 class="text-2xl font-bold text-green-600 mb-2">Pesanan Berhasil!</h2>
    <p class="text-gray-600 mb-6">Terima kasih, pesanan kamu sedang diproses.</p>

    <!-- Progress bar tracking -->
    <div class="flex items-center justify-between mb-8">
        <div class="flex-1">
            <div class="flex justify-between mb-2 text-sm font-medium text-gray-600">
                <span>Pesanan Diterima</span>
                <span>Diproses</span>
                <span>Dikirim</span>
                <span>Selesai</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-green-500 h-2 rounded-full" style="width: 50%"></div>
            </div>
        </div>
    </div>

    <div class="bg-gray-50 rounded-lg p-4 mb-6 text-left">
        <h4 class="text-lg font-semibold text-gray-800 mb-3">Detail Pesanan:</h4>
        <ul class="divide-y divide-gray-200 mb-4">
            <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="py-2 flex justify-between">
                    <span class="font-medium text-gray-700"><?php echo e($item->product->name); ?></span>
                    <span class="text-gray-500">x <?php echo e($item->quantity); ?></span>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
        <p class="text-gray-700"><span class="font-semibold">Total:</span> Rp <?php echo e(number_format($order->total, 0, ',', '.')); ?></p>
        <p class="text-gray-700"><span class="font-semibold">Status:</span> 
            <span class="bg-green-100 text-green-600 px-2 py-0.5 rounded"><?php echo e($order->status); ?></span>
        </p>
    </div>

    <div class="flex justify-center gap-3">
        <a href="<?php echo e(route('handphone.index')); ?>" 
           class="bg-blue-600 text-white px-5 py-2 rounded-lg shadow hover:bg-blue-700 transition">
           Kembali ke Beranda
        </a>
        
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XampUtama\htdocs\handphone\resources\views/user/order_success.blade.php ENDPATH**/ ?>