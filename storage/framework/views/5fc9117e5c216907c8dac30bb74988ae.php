<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan MyPhoneStore</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #dddddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .header { text-align: center; margin-bottom: 30px; }
    </style>
</head>
<body>

    <div class="header">
        <h2>Laporan Penjualan MyPhoneStore</h2>
        <p>Dicetak pada: <?php echo e(\Carbon\Carbon::now()->translatedFormat('d F Y H:i')); ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Pesanan</th>
                <th>Nama Pelanggan</th>
                <th>Tanggal Transaksi</th>
                <th>Total Harga</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($index + 1); ?></td>
                <td>#ORD-<?php echo e($order->id); ?></td>
                <td><?php echo e($order->user->name ?? 'User Dihapus'); ?></td> 
                <td><?php echo e($order->created_at->format('d/m/Y')); ?></td>
                <td>Rp <?php echo e(number_format($order->total, 0, ',', '.')); ?></td>
                <td><?php echo e(ucfirst($order->status)); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

</body>
</html><?php /**PATH D:\S6\PengemWeb\market-handphone\resources\views/admin/laporan/pdf_view.blade.php ENDPATH**/ ?>