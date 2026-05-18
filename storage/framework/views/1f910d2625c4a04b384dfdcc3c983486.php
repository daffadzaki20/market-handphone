<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-[var(--mh-text)] mb-1">Nama Produk</label>
        <input
            type="text"
            name="name"
            value="<?php echo e(old('name', $product?->name)); ?>"
            class="w-full border border-[var(--mh-border)] rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[var(--mh-primary)] focus:outline-none"
            required
        >
        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="mt-1 text-xs text-red-500"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div>
        <label class="block text-sm font-medium text-[var(--mh-text)] mb-1">Brand</label>
        <select
            name="brand_id"
            class="w-full border border-[var(--mh-border)] rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[var(--mh-primary)] focus:outline-none"
            required
        >
            <option value="">Pilih brand</option>
            <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($brand->id); ?>" <?php echo e((string) old('brand_id', $product?->brand_id) === (string) $brand->id ? 'selected' : ''); ?>>
                    <?php echo e($brand->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <?php $__errorArgs = ['brand_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="mt-1 text-xs text-red-500"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div>
        <label class="block text-sm font-medium text-[var(--mh-text)] mb-1">Harga</label>
        <input
            type="number"
            name="price"
            value="<?php echo e(old('price', $product?->price)); ?>"
            class="w-full border border-[var(--mh-border)] rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[var(--mh-primary)] focus:outline-none"
            min="0"
            required
        >
        <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="mt-1 text-xs text-red-500"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div>
        <label class="block text-sm font-medium text-[var(--mh-text)] mb-1">Stok</label>
        <input
            type="number"
            name="stock"
            value="<?php echo e(old('stock', $product?->stock)); ?>"
            class="w-full border border-[var(--mh-border)] rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[var(--mh-primary)] focus:outline-none"
            min="0"
            required
        >
        <?php $__errorArgs = ['stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="mt-1 text-xs text-red-500"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div>
        <label class="block text-sm font-medium text-[var(--mh-text)] mb-1">RAM</label>
        <input
            type="text"
            name="ram"
            value="<?php echo e(old('ram', $product?->ram)); ?>"
            class="w-full border border-[var(--mh-border)] rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[var(--mh-primary)] focus:outline-none"
            placeholder="Contoh: 8 GB"
        >
        <?php $__errorArgs = ['ram'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="mt-1 text-xs text-red-500"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div>
        <label class="block text-sm font-medium text-[var(--mh-text)] mb-1">Storage</label>
        <input
            type="text"
            name="storage"
            value="<?php echo e(old('storage', $product?->storage)); ?>"
            class="w-full border border-[var(--mh-border)] rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[var(--mh-primary)] focus:outline-none"
            placeholder="Contoh: 256 GB"
        >
        <?php $__errorArgs = ['storage'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="mt-1 text-xs text-red-500"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div>
        <label class="block text-sm font-medium text-[var(--mh-text)] mb-1">Battery</label>
        <input
            type="text"
            name="battery"
            value="<?php echo e(old('battery', $product?->battery)); ?>"
            class="w-full border border-[var(--mh-border)] rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[var(--mh-primary)] focus:outline-none"
            placeholder="Contoh: 5000 mAh"
        >
        <?php $__errorArgs = ['battery'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="mt-1 text-xs text-red-500"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-[var(--mh-text)] mb-1">Deskripsi</label>
        <textarea
            name="description"
            rows="4"
            class="w-full border border-[var(--mh-border)] rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[var(--mh-primary)] focus:outline-none"
            placeholder="Deskripsi handphone"
        ><?php echo e(old('description', $product?->description)); ?></textarea>
        <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="mt-1 text-xs text-red-500"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-[var(--mh-text)] mb-1">Gambar Produk</label>
        <input
            type="file"
            name="image"
            accept=".jpg,.jpeg,.png,.webp"
            class="w-full border border-[var(--mh-border)] rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[var(--mh-primary)] focus:outline-none"
        >
        <p class="text-xs text-[var(--mh-muted)] mt-1">Maksimal 2MB. Format: jpg, jpeg, png, webp.</p>
        <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="mt-1 text-xs text-red-500"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

        <?php if($product?->image): ?>
                <div class="mt-3">
                <p class="text-xs text-[var(--mh-muted)] mb-2">Gambar saat ini:</p>
                <img src="<?php echo e(asset('images/products/' . $product->image)); ?>" alt="<?php echo e($product->name); ?>" class="w-24 h-24 object-cover rounded-lg border border-[var(--mh-border)]">
            </div>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH D:\XampUtama\htdocs\handphone\resources\views/admin/handphones/partials/form.blade.php ENDPATH**/ ?>