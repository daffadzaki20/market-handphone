<?php $__env->startSection('title', 'Edit Handphone'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto">
    <section class="card p-6 rounded-xl">
        <div class="mb-6">
            <h2 class="text-xl font-bold text-[var(--mh-text)]">Edit Handphone</h2>
            <p class="text-sm text-[var(--mh-muted)] mt-1">Perbarui data produk handphone yang dipilih.</p>
        </div>

        <form action="<?php echo e(route('admin.handphones.update', $product->id)); ?>" method="POST" enctype="multipart/form-data" class="space-y-5">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <?php echo $__env->make('admin.handphones.partials.form', [
                'product' => $product,
                'brands' => $brands,
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="px-4 py-2 rounded-lg btn-primary hover:bg-[var(--mh-primary-600)] transition">Update</button>
                <a href="<?php echo e(route('admin.handphones.index')); ?>" class="px-4 py-2 rounded-lg border border-[var(--mh-border)] text-[var(--mh-muted)] hover:bg-[var(--mh-surface-hover)] transition">Batal</a>
            </div>
        </form>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app_admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XampUtama\htdocs\handphone\resources\views/admin/handphones/edit.blade.php ENDPATH**/ ?>