<?php $__env->startSection('content'); ?>

    <?php
        // Mengatur bahasa Carbon ke Indonesia untuk nama bulan (Jan, Feb, Ags, dst)
        \Carbon\Carbon::setLocale('id');

        // LOGIKA PENGECEKAN KATEGORI HP
        $hasHandphone = $checkoutItems->contains(function($item) {
            return $item->product && $item->product->brand && strtolower($item->product->brand->type) === 'hp';
        });
    ?>

    <!-- PEMBUNGKUS UTAMA -->
    <div class="max-w-5xl mx-auto px-4 pt-6 pb-24 space-y-4">
        
        <h1 class="text-2xl font-bold text-gray-800 mb-2 flex items-center gap-2">
            Checkout
        </h1>

        <!-- 1. ALAMAT PENGIRIMAN -->
        <div class="bg-white rounded-sm shadow-sm border border-gray-100 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-red-500 via-white to-blue-500 bg-[length:40px_100%]"></div>
            
            <div class="p-6">
                <div class="flex items-center justify-between mb-3">
                    <h2 class="font-bold text-orange-500 text-base flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Alamat Pengiriman
                    </h2>
                </div>

                <div class="flex justify-between items-start gap-4 text-gray-800 text-sm">
                    <?php if(isset($alamatUtama) && $alamatUtama): ?>
                        <div class="flex-1 relative bg-gray-50 rounded-xl p-4 border border-gray-100">
                            <div class="absolute top-4 right-4 text-gray-400">
                                <?php if($alamatUtama->label == 'Rumah'): ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                    </svg>
                                <?php elseif($alamatUtama->label == 'Kantor'): ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd" />
                                    </svg>
                                <?php endif; ?>
                            </div>
                            <div class="flex flex-col gap-1 pr-10">
                                <p class="font-bold text-base text-gray-800">
                                    <?php echo e($alamatUtama->user->name ?? 'Pengguna'); ?> 
                                    <span class="font-normal text-gray-600 text-sm ml-1"><?php echo e($alamatUtama->user->phone_number ?? '-'); ?></span>
                                </p>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    <span class="font-semibold text-gray-700">[<?php echo e($alamatUtama->label); ?>]</span> 
                                    <?php echo e($alamatUtama->alamat_detail); ?>, 
                                    <?php if($alamatUtama->rt || $alamatUtama->rw): ?>
                                        RT.<?php echo e($alamatUtama->rt); ?>/RW.<?php echo e($alamatUtama->rw); ?>, 
                                    <?php endif; ?>
                                    <?php echo e($alamatUtama->desa); ?>, <?php echo e($alamatUtama->kecamatan); ?>, 
                                    <?php echo e($alamatUtama->kabupaten); ?>, <?php echo e($alamatUtama->provinsi); ?>, 
                                    <?php echo e($alamatUtama->kode_pos); ?>

                                </p>
                            </div>
                        </div>
                        <div class="flex flex-col gap-2">
                            <button onclick="openModalPilihAlamat()" class="text-blue-600 hover:text-blue-700 font-bold uppercase text-xs tracking-wider transition-colors">
                                UBAH
                            </button>
                        </div>
                    <?php else: ?>
                        <div class="flex-1 bg-orange-50 rounded-xl p-4 border border-orange-100">
                            <p class="text-orange-600 italic flex items-center gap-2 font-medium">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                Alamat pengiriman belum diatur.
                            </p>
                            <p class="text-sm text-orange-500 mt-1">Silakan tambahkan alamat terlebih dahulu untuk melanjutkan pesanan.</p>
                        </div>
                        <a href="<?php echo e(route('alamat.index')); ?>" class="bg-orange-500 text-white px-4 py-2.5 rounded-lg font-bold uppercase text-xs hover:bg-orange-600 transition-all shadow-sm">
                            + TAMBAH
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- 2. PRODUK DIPESAN -->
        <div class="bg-white rounded-sm shadow-sm border border-gray-100 p-6">
            <h2 class="font-bold text-gray-800 text-sm mb-4">Produk Dipesan</h2>
            <div class="space-y-4">
                <?php $__currentLoopData = $checkoutItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex items-center gap-4 border-b border-gray-50 pb-4 last:border-0 last:pb-0">
                        <img src="<?php echo e($item->product->image_url ?? asset('images/products/default.jpg')); ?>" class="w-16 h-16 object-cover border border-gray-200 bg-gray-50 rounded">
                        <div class="flex-1 min-w-0">
                            <h3 class="text-gray-800 text-sm truncate font-medium"><?php echo e($item->product->name); ?></h3>
                            <p class="text-xs text-blue-500 font-bold uppercase mt-0.5"><?php echo e($item->product->brand->name ?? ''); ?></p>
                        </div>
                        <div class="w-32 text-center text-gray-600 text-sm">
                            Rp <?php echo e(number_format($item->product->price, 0, ',', '.')); ?>

                        </div>
                        <div class="w-16 text-center text-gray-600 text-sm font-medium">
                            x<?php echo e($item->quantity); ?>

                        </div>
                        <div class="w-32 text-right text-orange-500 text-sm font-bold">
                            Rp <?php echo e(number_format($item->product->price * $item->quantity, 0, ',', '.')); ?>

                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <!-- 3. PROTEKSI & CATATAN -->
        <div class="bg-white rounded-sm shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-gray-50 hover:bg-gray-50 transition-colors">
                <label class="flex items-center gap-3 cursor-pointer flex-1">
                    <input type="checkbox" id="checkbox-proteksi" class="w-5 h-5 text-orange-500 focus:ring-orange-500 border-gray-300 rounded cursor-pointer">
                    <div>
                        <p class="font-bold text-gray-800 text-sm flex items-center gap-2">
                            Proteksi Kerusakan Total 
                            <span class="text-[10px] font-bold bg-orange-100 text-orange-600 px-1.5 py-0.5 rounded">BARU</span>
                        </p>
                        <p class="text-xs text-gray-500 mt-0.5">Melindungi produk dari kerusakan tidak terduga atau cacat pabrik selama 1 tahun.</p>
                    </div>
                </label>
                <div class="text-gray-800 text-sm font-bold whitespace-nowrap pl-8 sm:pl-0">Rp 45.000</div>
            </div>
            <div class="px-6 py-4 bg-slate-50/50 flex flex-col md:flex-row md:items-center gap-3">
                <div class="flex items-center gap-2 text-gray-600 min-w-[120px]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    <span class="text-sm font-medium">Pesan:</span>
                </div>
                <input type="text" name="note" id="input-pesan"
                       placeholder="(Opsional) Tinggalkan pesan ke penjual..." 
                       class="flex-1 bg-transparent border border-gray-200 rounded px-3 py-1.5 text-sm focus:border-orange-500 focus:ring-1 focus:ring-orange-500 placeholder:text-gray-400"
                       maxlength="200">
            </div>
        </div>

      <!-- 4. VOUCHER -->
        <div class="bg-white rounded-sm shadow-sm border border-gray-100 p-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-center gap-2">
                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                    <span class="text-sm font-bold text-gray-800">Voucher Toko</span>
                </div>
                
                <div class="flex items-center gap-2 w-full sm:w-auto">
                    <select id="select-voucher" class="border border-gray-300 rounded px-3 py-1.5 text-sm flex-1 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500">
                        <option value="">-- Pilih Voucher Saya --</option>
                        <?php if(isset($myVouchers)): ?>
                            <?php $__currentLoopData = $myVouchers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $memenuhiSyarat = $totalHarga >= $v->min_spend;
                                ?>
                                <option value="<?php echo e($v->id); ?>" 
                                        data-code="<?php echo e($v->code); ?>" 
                                        data-type="<?php echo e($v->type); ?>" 
                                        data-value="<?php echo e($v->value); ?>" 
                                        data-min="<?php echo e($v->min_spend); ?>"
                                        <?php echo e(!$memenuhiSyarat ? 'disabled' : ''); ?>>
                                    [<?php echo e($v->code); ?>] 
                                    <?php if($v->type == 'percent'): ?>
                                        Diskon <?php echo e($v->value); ?>%
                                    <?php else: ?>
                                        Potongan Rp <?php echo e(number_format($v->value, 0, ',', '.')); ?>

                                    <?php endif; ?> 
                                    (Min. Belanja Rp <?php echo e(number_format($v->min_spend, 0, ',', '.')); ?>)
                                    <?php echo e(!$memenuhiSyarat ? ' - (Belum Memenuhi Syarat)' : ''); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </select>
                    <button type="button" id="btn-terapkan-voucher" class="bg-gray-800 text-white px-4 py-1.5 rounded text-sm font-bold hover:bg-gray-700 transition">Gunakan</button>
                    <button type="button" id="btn-batalkan-voucher" class="bg-red-100 text-red-600 px-3 py-1.5 rounded text-sm font-bold hover:bg-red-200 transition hidden">Batalkan</button>
                </div>
            </div>
            <p id="pesan-voucher" class="text-xs mt-2 hidden"></p>
        </div>

        <!-- 5. PENGIRIMAN & METODE PEMBAYARAN -->
        <div class="bg-white rounded-sm shadow-sm border border-gray-100">

           <!-- OPSI PENGIRIMAN -->
            <div class="p-6 border-b border-gray-100 flex flex-col md:flex-row md:items-start gap-6">
                <h2 class="font-bold text-gray-800 text-sm w-40 flex-shrink-0 pt-1">Opsi Pengiriman</h2>
                <div class="flex gap-4 flex-wrap flex-1">
                    <label class="relative cursor-pointer select-none">
                        <input type="radio" name="shipping" value="15000" class="hidden" checked>
                        <div class="opsi-box px-5 py-3 border border-gray-200 text-gray-700 rounded-xl transition min-w-[220px]">
                            <div class="flex flex-col">
                                <span class="text-sm font-bold">Reguler (Rp 15.000)</span>
                                <span class="text-xs text-gray-500 mt-1.5 font-medium">Estimasi tiba <span class="text-gray-700 font-bold"><?php echo e(now()->addDays(2)->translatedFormat('d')); ?> - <?php echo e(now()->addDays(4)->translatedFormat('d M')); ?></span></span>
                                <span class="text-[10px] text-gray-400 mt-0.5">(2 - 4 hari perjalanan)</span>
                            </div>
                        </div>
                        <div class="opsi-centang absolute bottom-0 right-0 w-5 h-5 bg-orange-500 hidden justify-center items-center rounded-br-xl rounded-tl-lg">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </label>

                    <label class="relative cursor-pointer select-none">
                        <input type="radio" name="shipping" value="35000" class="hidden">
                        <div class="opsi-box px-5 py-3 border border-gray-200 text-gray-700 rounded-xl transition min-w-[220px]">
                            <div class="flex flex-col">
                                <span class="text-sm font-bold">Kargo (Rp 35.000)</span>
                                <span class="text-xs text-gray-500 mt-1.5 font-medium">Estimasi tiba <span class="text-gray-700 font-bold"><?php echo e(now()->addDays(5)->translatedFormat('d')); ?> - <?php echo e(now()->addDays(7)->translatedFormat('d M')); ?></span></span>
                                <span class="text-[10px] text-gray-400 mt-0.5">(5 - 7 hari perjalanan)</span>
                            </div>
                        </div>
                        <div class="opsi-centang absolute bottom-0 right-0 w-5 h-5 bg-orange-500 hidden justify-center items-center rounded-br-xl rounded-tl-lg">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </label>
                </div>
            </div>

            <!-- METODE PEMBAYARAN -->
            <div class="p-6 flex flex-col gap-6 bg-slate-50/50">
                <h2 class="font-bold text-gray-800 text-sm">Metode Pembayaran</h2>

                <!-- GRUP 1: Metode Umum -->
                <div>
                    <p class="text-[11px] text-gray-400 uppercase tracking-widest font-bold mb-3">Metode Umum</p>
                    <div class="flex gap-3 flex-wrap">
                        <label class="relative select-none <?php echo e($hasHandphone ? 'cursor-not-allowed opacity-50' : 'cursor-pointer'); ?>" 
                               <?php if($hasHandphone): ?> title="COD tidak tersedia untuk pembelian Handphone" <?php endif; ?>>
                            <input type="radio" name="payment" value="cod" class="hidden" <?php echo e(!$hasHandphone ? 'checked' : 'disabled'); ?>>
                            <div class="opsi-box px-4 py-2.5 bg-white border <?php echo e(!$hasHandphone ? 'border-gray-300 text-gray-700 hover:border-orange-500 hover:text-orange-500' : 'border-gray-200 text-gray-400 bg-gray-50'); ?> rounded-lg transition">
                                <span class="text-sm font-medium flex items-center gap-2">💵 Bayar di Tempat (COD)</span>
                            </div>
                            <div class="opsi-centang absolute bottom-0 right-0 w-4 h-4 bg-orange-500 hidden justify-center items-center rounded-br-lg rounded-tl">
                                <svg class="w-2.5 h-2.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                        </label>
                    </div>
                    <?php if($hasHandphone): ?>
                        <p class="text-xs text-red-500 mt-3 font-medium bg-red-50 p-2 rounded inline-block">
                            * COD dinonaktifkan karena Anda membeli unit Handphone. Silakan gunakan metode E-Wallet atau Kartu Tersimpan.
                        </p>
                    <?php endif; ?>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-2">
                    <!-- GRUP 2: E-Wallet Tersimpan -->
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <p class="text-[11px] text-gray-400 uppercase tracking-widest font-bold">E-Wallet Tersimpan</p>
                            <a href="<?php echo e(route('profile.bank')); ?>" class="text-[11px] font-bold text-blue-500 hover:underline">+ Tautkan Baru</a>
                        </div>
                        
                        <?php if(isset($savedEwallets) && $savedEwallets->count() > 0): ?>
                            <div class="flex flex-col gap-3">
                                <?php $__currentLoopData = $savedEwallets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ewallet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label class="relative cursor-pointer select-none w-full">
                                    <input type="radio" name="payment" value="ewallet_<?php echo e($ewallet->id); ?>" class="hidden">
                                    <div class="opsi-box flex items-center bg-white px-4 py-3 border border-gray-200 rounded-xl text-gray-700 hover:border-orange-500 hover:text-orange-500 transition w-full shadow-sm">
                                        <div class="flex items-center gap-3">
                                            <!-- Logo E-Wallet -->
                                            <div class="w-10 h-7 rounded flex items-center justify-center">
                                                <?php if(strtolower($ewallet->provider) === 'gopay'): ?>
                                                    <img src="https://upload.wikimedia.org/wikipedia/commons/8/86/Gopay_logo.svg" alt="GoPay" class="h-5 object-contain">
                                                <?php elseif(strtolower($ewallet->provider) === 'ovo'): ?>
                                                    <img src="https://upload.wikimedia.org/wikipedia/commons/e/eb/Logo_ovo_purple.svg" alt="OVO" class="h-5 object-contain">
                                                <?php elseif(strtolower($ewallet->provider) === 'dana'): ?>
                                                    <img src="https://upload.wikimedia.org/wikipedia/commons/7/72/Logo_dana_blue.svg" alt="DANA" class="h-5 object-contain">
                                                <?php elseif(strtolower($ewallet->provider) === 'shopeepay'): ?>
                                                    <img src="https://upload.wikimedia.org/wikipedia/commons/f/fe/Shopee.svg" alt="ShopeePay" class="h-5 object-contain">
                                                <?php elseif(strtolower($ewallet->provider) === 'linkaja'): ?>
                                                    <img src="https://upload.wikimedia.org/wikipedia/commons/8/85/LinkAja.svg" alt="LinkAja" class="h-5 object-contain">
                                                <?php else: ?>
                                                    <span class="text-[10px] font-bold"><?php echo e($ewallet->provider); ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <div>
                                                <p class="text-sm font-bold text-gray-800">
                                                    <?php echo e($ewallet->provider); ?> •••• <?php echo e(substr($ewallet->account_number, -4)); ?>

                                                </p>
                                                <p class="text-[10px] text-gray-500 uppercase">
                                                    <?php echo e($ewallet->account_name); ?>

                                                </p>
                                            </div>
                                        </div>
                                        <div class="opsi-centang absolute bottom-0 right-0 w-4 h-4 bg-orange-500 hidden justify-center items-center rounded-br-xl rounded-tl">
                                            <svg class="w-2.5 h-2.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                        </div>
                                    </div>
                                </label>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php else: ?>
                            <div class="bg-white border border-dashed border-gray-200 rounded-xl px-4 py-4 flex items-center justify-center">
                                <p class="text-xs text-gray-400 italic">Belum ada E-Wallet tersimpan.</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- GRUP 3: Kartu Tersimpan -->
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <p class="text-[11px] text-gray-400 uppercase tracking-widest font-bold">Kartu Tersimpan</p>
                            <a href="<?php echo e(route('profile.bank')); ?>" class="text-[11px] font-bold text-blue-500 hover:underline">+ Tambah Kartu</a>
                        </div>

                        <?php if(isset($savedCards) && $savedCards->count() > 0): ?>
                            <div class="flex flex-col gap-3">
                                <?php $__currentLoopData = $savedCards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kartu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label class="relative cursor-pointer select-none w-full">
                                    <input type="radio" name="payment" value="kartu_<?php echo e($kartu->id); ?>" class="hidden">
                                    <div class="opsi-box flex items-center bg-white justify-between px-4 py-3 border border-gray-200 rounded-xl text-gray-700 hover:border-orange-500 hover:text-orange-500 transition w-full shadow-sm">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-7 bg-gradient-to-br from-slate-700 to-slate-900 rounded flex items-center justify-center shadow-sm">
                                                <span class="text-white text-[8px] font-black italic tracking-wider">VISA</span>
                                            </div>
                                            <div>
                                                <p class="text-sm font-bold text-gray-800 tracking-widest">
                                                    •••• <?php echo e(substr($kartu->account_number, -4)); ?>

                                                </p>
                                                <p class="text-[10px] text-gray-500 uppercase mt-0.5">
                                                    <?php echo e($kartu->account_name); ?>

                                                </p>
                                            </div>
                                        </div>
                                        <div class="opsi-centang absolute bottom-0 right-0 w-4 h-4 bg-orange-500 hidden justify-center items-center rounded-br-xl rounded-tl">
                                            <svg class="w-2.5 h-2.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                        </div>
                                    </div>
                                </label>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php else: ?>
                            <div class="bg-white border border-dashed border-gray-200 rounded-xl px-4 py-4 flex items-center justify-center">
                                <p class="text-xs text-gray-400 italic">Belum ada kartu tersimpan.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>

        <!-- 6. RINCIAN TAGIHAN -->
        <div class="mt-6 bg-white rounded-xl border border-gray-100 overflow-hidden shadow-sm">
            <div class="p-6">
                <h2 class="text-sm font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                    Rincian Pembayaran
                </h2>

                <div class="space-y-3 text-sm">
                    <div class="flex justify-between items-center text-gray-600">
                        <span>Subtotal Produk</span>
                        <span class="font-medium text-gray-800">Rp <?php echo e(number_format($totalHarga ?? 0, 0, ',', '.')); ?></span>
                    </div>
                    <div class="flex justify-between items-center text-gray-600">
                        <span>Total Ongkos Kirim</span>
                        <span id="display-ongkir" class="font-medium text-gray-800">Rp 15.000</span>
                    </div>
                    <div id="row-proteksi" class="flex justify-between items-center text-gray-600 hidden">
                        <span>Proteksi Kerusakan Total</span>
                        <span class="font-medium text-gray-800">Rp 45.000</span>
                    </div>
                    <div id="row-voucher" class="flex justify-between items-center text-green-600 hidden">
                        <span>Diskon Voucher (<span id="label-kode-voucher"></span>)</span>
                        <span class="font-bold" id="display-diskon-voucher">- Rp 0</span>
                    </div>
                    <div class="flex justify-between items-center text-gray-600">
                        <span>Biaya Layanan & Jasa</span>
                        <span class="font-medium text-gray-800">Rp <?php echo e(number_format($biayaLayanan ?? 0, 0, ',', '.')); ?></span>
                    </div>
                    <div class="pt-4 mt-2 border-t border-dashed border-gray-200">
                        <div class="flex justify-between items-center">
                            <span class="text-base font-bold text-gray-800">Total Pembayaran</span>
                            <div class="bg-orange-50 px-4 py-2 rounded-lg border border-orange-100">
                                <span id="display-grandtotal" class="text-2xl font-black text-orange-500 tracking-tight leading-none">
                                    Rp <?php echo e(number_format($grandTotal ?? 0, 0, ',', '.')); ?>

                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="h-1 w-full bg-[radial-gradient(circle_at_center,_#f3f4f6_6px,_transparent_0)] bg-[length:12px_12px] bg-repeat-x"></div>
        </div>

    </div>

    <!-- 7. BAR LENGKET BAWAH -->
    <div class="fixed bottom-0 left-0 w-full bg-white border-t border-gray-200 shadow-[0_-5px_15px_rgba(0,0,0,0.05)] z-50">
        <div class="max-w-5xl mx-auto flex justify-end items-stretch">
            <div class="px-6 py-4 hidden md:flex items-center">
                <p class="text-xs text-gray-500 text-right">
                    Dengan menekan "Buat Pesanan", Anda menyetujui<br>
                    <a href="#" class="text-blue-500 hover:underline">Syarat & Ketentuan</a> yang berlaku.
                </p>
            </div>
            <div class="flex items-stretch justify-end w-full md:w-auto">
                <div class="text-right flex flex-col justify-center gap-0.5 px-4 py-3 md:py-4 flex-1 md:flex-none">
                    <span class="text-xs text-gray-700 font-bold">Total Tagihan</span>
                    <span class="text-xl md:text-2xl font-black text-orange-500 leading-none truncate" id="bottom-grandtotal">Rp 0</span>
                </div>
                
                <form id="form-buat-pesanan" action="<?php echo e(route('checkout.process')); ?>" method="POST" class="flex">
                    <?php echo csrf_field(); ?>
                    
                    <!-- PENTING: LOGIKA INPUT UNTUK MEMBEDAKAN BELI LANGSUNG ATAU KERANJANG -->
                    <?php if(request()->has('product_id')): ?>
                        <!-- Jalur Beli Langsung -->
                        <input type="hidden" name="cart_ids[]" value="direct">
                        <input type="hidden" name="product_id" value="<?php echo e(request('product_id')); ?>">
                        <input type="hidden" name="quantity" value="<?php echo e(request('quantity', 1)); ?>">
                    <?php else: ?>
                        <!-- Jalur Keranjang Belanja Normal -->
                        <?php $__currentLoopData = $checkoutItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <input type="hidden" name="cart_ids[]" value="<?php echo e($item->id); ?>">
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    <!-- ================================================================== -->

                    <input type="hidden" name="alamat_id" value="<?php echo e(isset($alamatUtama) ? $alamatUtama->id : ''); ?>">
                    <input type="hidden" name="pengiriman" id="input-final-pengiriman" value="15000">
                    <input type="hidden" name="pembayaran" id="input-final-pembayaran" value="<?php echo e(!$hasHandphone ? 'cod' : ''); ?>">
                    <input type="hidden" name="proteksi" id="input-final-proteksi" value="0">
                    <input type="hidden" name="voucher" id="input-final-voucher" value="">
                    <input type="hidden" name="pesan" id="input-final-pesan" value="">
                    <input type="hidden" name="pin_pembayaran" id="input-final-pin" value="">

                    <button type="button" onclick="prosesPesanan()" class="bg-orange-500 hover:bg-orange-600 text-white font-bold text-sm md:text-lg px-8 md:px-12 flex-shrink-0 transition flex flex-col justify-center items-center shadow-lg shadow-orange-200">
                        <span>Buat Pesanan</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL PIN PEMBAYARAN -->
    <div id="modalPinPembayaran" class="fixed inset-0 z-[100] hidden overflow-y-auto">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity" onclick="tutupModalPin()"></div>
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative w-full max-w-sm bg-white rounded-2xl shadow-2xl overflow-hidden p-6 text-center transform transition-all">
                <div class="mb-4">
                    <div class="w-16 h-16 bg-orange-100 text-orange-500 rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Verifikasi Pembayaran</h3>
                    <p class="text-sm text-gray-500 mt-1">Masukkan 6 digit PIN <span id="nama-metode-pin" class="font-bold text-gray-700">Metode</span> Anda untuk mengonfirmasi.</p>
                </div>

                <!-- 6 Kotak Input PIN -->
                <div class="flex justify-center gap-2 mb-2" id="pin-container">
                    <input type="password" maxlength="1" inputmode="numeric" class="pin-input w-12 h-14 text-center text-2xl font-bold border border-gray-300 rounded-lg focus:border-orange-500 focus:ring-2 focus:ring-orange-500 focus:outline-none transition-shadow" oninput="pindahPin(this, 1)" onkeydown="hapusPin(event, 0)" id="pin-0">
                    <input type="password" maxlength="1" inputmode="numeric" class="pin-input w-12 h-14 text-center text-2xl font-bold border border-gray-300 rounded-lg focus:border-orange-500 focus:ring-2 focus:ring-orange-500 focus:outline-none transition-shadow" oninput="pindahPin(this, 2)" onkeydown="hapusPin(event, 1)" id="pin-1">
                    <input type="password" maxlength="1" inputmode="numeric" class="pin-input w-12 h-14 text-center text-2xl font-bold border border-gray-300 rounded-lg focus:border-orange-500 focus:ring-2 focus:ring-orange-500 focus:outline-none transition-shadow" oninput="pindahPin(this, 3)" onkeydown="hapusPin(event, 2)" id="pin-2">
                    <input type="password" maxlength="1" inputmode="numeric" class="pin-input w-12 h-14 text-center text-2xl font-bold border border-gray-300 rounded-lg focus:border-orange-500 focus:ring-2 focus:ring-orange-500 focus:outline-none transition-shadow" oninput="pindahPin(this, 4)" onkeydown="hapusPin(event, 3)" id="pin-3">
                    <input type="password" maxlength="1" inputmode="numeric" class="pin-input w-12 h-14 text-center text-2xl font-bold border border-gray-300 rounded-lg focus:border-orange-500 focus:ring-2 focus:ring-orange-500 focus:outline-none transition-shadow" oninput="pindahPin(this, 5)" onkeydown="hapusPin(event, 4)" id="pin-4">
                    <input type="password" maxlength="1" inputmode="numeric" class="pin-input w-12 h-14 text-center text-2xl font-bold border border-gray-300 rounded-lg focus:border-orange-500 focus:ring-2 focus:ring-orange-500 focus:outline-none transition-shadow" oninput="pindahPin(this, 6)" onkeydown="hapusPin(event, 5)" id="pin-5">
                </div>
                <p id="pin-error" class="text-xs text-red-500 hidden mb-4 mt-2 font-medium">Harap masukkan 6 digit PIN dengan lengkap.</p>

                <div class="mt-6 flex gap-3">
                    <button type="button" onclick="tutupModalPin()" class="flex-1 px-4 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-xl font-bold hover:bg-gray-50 transition">Batal</button>
                    <button type="button" onclick="konfirmasiPin()" id="btn-konfirmasi-pin" class="flex-1 px-4 py-2.5 bg-orange-500 text-white rounded-xl font-bold hover:bg-orange-600 transition shadow-lg shadow-orange-200">Konfirmasi</button>
                </div>
            </div>
        </div>
    </div>

    <!-- STYLE HIGHLIGHT OPSI TERPILIH -->
    <style>
        .opsi-terpilih {
            outline: 2px solid #f97316;
            outline-offset: -1px;
        }
    </style>

    <!-- SCRIPT LOGIKA CHECKOUT -->
    <script>
   document.addEventListener('DOMContentLoaded', function() {
        const subtotalProduk = <?php echo e($totalHarga ?? 0); ?>;
        const biayaLayanan = <?php echo e($biayaLayanan ?? 0); ?>;
        
        let biayaOngkir = 15000;
        let biayaProteksi = 0;
        let diskonVoucher = 0;

        const allRadios = document.querySelectorAll('input[type="radio"]');
        const proteksiCheckbox = document.getElementById('checkbox-proteksi');
        const rowProteksi = document.getElementById('row-proteksi');
        const rowVoucher = document.getElementById('row-voucher');
        const btnVoucher = document.getElementById('btn-terapkan-voucher');
        const btnBatalVoucher = document.getElementById('btn-batalkan-voucher');
        const selectVoucher = document.getElementById('select-voucher');
        const pesanVoucher = document.getElementById('pesan-voucher');
        const labelKodeVoucher = document.getElementById('label-kode-voucher');
        const displayDiskonVoucher = document.getElementById('display-diskon-voucher');
        const inputPesan = document.getElementById('input-pesan');
        
        const displayOngkir = document.getElementById('display-ongkir');
        const displayGrandTotal = document.getElementById('display-grandtotal');
        const bottomGrandTotal = document.getElementById('bottom-grandtotal');

        const inputFinalPengiriman = document.getElementById('input-final-pengiriman');
        const inputFinalPembayaran = document.getElementById('input-final-pembayaran');
        const inputFinalProteksi = document.getElementById('input-final-proteksi');
        const inputFinalVoucher = document.getElementById('input-final-voucher');
        const inputFinalPesan = document.getElementById('input-final-pesan');

        const formatRp = (angka) => {
            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(angka);
        };

        function hitungTotal() {
            // Kalkulasi Grand Total secara real-time
            const grandTotal = subtotalProduk + biayaOngkir + biayaLayanan + biayaProteksi - diskonVoucher;
            displayOngkir.innerText = formatRp(biayaOngkir);
            displayGrandTotal.innerText = formatRp(grandTotal);
            bottomGrandTotal.innerText = formatRp(grandTotal);
        }

        // Highlight visual opsi yang sedang dipilih (Pengiriman & Pembayaran)
    function toggleOpsiSelected(radio) {
        const groupName = radio.name;
        document.querySelectorAll(`input[name="${groupName}"]`).forEach(r => {
            const label = r.closest('label');
            if (!label) return;
            const box = label.querySelector('.opsi-box');
            const centang = label.querySelector('.opsi-centang');
            if (r.checked) {
                box?.classList.add('opsi-terpilih');
                if (centang) {
                    centang.classList.remove('hidden');
                    centang.classList.add('flex');
                }
            } else {
                box?.classList.remove('opsi-terpilih');
                if (centang) {
                    centang.classList.add('hidden');
                    centang.classList.remove('flex');
                }
            }
        });
    }

    // Tombol Terapkan Voucher
    if (btnVoucher) {
        btnVoucher.addEventListener('click', function(e) {
            e.preventDefault();
            const selectedOption = selectVoucher.options[selectVoucher.selectedIndex];
            
            if (!selectVoucher.value) {
                alert('Silakan pilih voucher terlebih dahulu.');
                return;
            }

            const minSpend = parseFloat(selectedOption.getAttribute('data-min')) || 0;
            const type = selectedOption.getAttribute('data-type');
            const rawValue = parseFloat(selectedOption.getAttribute('data-value')) || 0;
            const code = selectedOption.getAttribute('data-code');

            // Aturan: Jika subtotal produk kurang dari minimum belanja, auto disable & tolak
            if (subtotalProduk < minSpend) {
                selectedOption.disabled = true;
                selectVoucher.value = "";
                diskonVoucher = 0;
                inputFinalVoucher.value = "";
                rowVoucher.classList.add('hidden');
                
                pesanVoucher.classList.remove('hidden', 'text-green-600');
                pesanVoucher.classList.add('text-red-600');
                pesanVoucher.innerText = `Voucher [${code}] otomatis dinonaktifkan. Belanjaan Anda belum memenuhi syarat minimum Rp ${new Intl.NumberFormat('id-ID').format(minSpend)}.`;
                
                hitungTotal();
                return;
            }

            // Kalkulasi Nominal Potongan
            if (type === 'percent') {
                diskonVoucher = (subtotalProduk * rawValue) / 100;
            } else {
                diskonVoucher = rawValue;
            }

            inputFinalVoucher.value = code;
            if (labelKodeVoucher) labelKodeVoucher.innerText = code;
            if (displayDiskonVoucher) displayDiskonVoucher.innerText = `- ${formatRp(diskonVoucher)}`;
            
            rowVoucher.classList.remove('hidden');
            pesanVoucher.classList.remove('hidden', 'text-red-600');
            pesanVoucher.classList.add('text-green-600');
            pesanVoucher.innerText = `Voucher ${code} berhasil diterapkan!`;

            // Ubah tombol jadi Batalkan agar interaktif
            selectVoucher.disabled = true;
            btnVoucher.classList.add('hidden');
            btnBatalVoucher.classList.remove('hidden');

            hitungTotal();
        });
    }

        // Tombol Batalkan Voucher
        if (btnBatalVoucher) {
            btnBatalVoucher.addEventListener('click', function(e) {
                e.preventDefault();
                selectVoucher.disabled = false;
                selectVoucher.value = "";
                diskonVoucher = 0;
                inputFinalVoucher.value = "";
                
                rowVoucher.classList.add('hidden');
                pesanVoucher.classList.add('hidden');
                
                btnBatalVoucher.classList.add('hidden');
                btnVoucher.classList.remove('hidden');

                hitungTotal();
            });
        }

        allRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                toggleOpsiSelected(this);
                if (this.name === 'shipping') {
                    biayaOngkir = parseInt(this.value);
                    inputFinalPengiriman.value = this.value;
                    hitungTotal();
                } else if (this.name === 'payment') {
                    inputFinalPembayaran.value = this.value;
                }
            });
        });

        if (proteksiCheckbox) {
            proteksiCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    biayaProteksi = 45000;
                    inputFinalProteksi.value = "1";
                    rowProteksi.classList.remove('hidden');
                } else {
                    biayaProteksi = 0;
                    inputFinalProteksi.value = "0";
                    rowProteksi.classList.add('hidden');
                }
                hitungTotal();
            });
        }

        if (inputPesan) {
            inputPesan.addEventListener('input', function() {
                inputFinalPesan.value = this.value;
            });
        }

        // Set highlight awal (sesuai default: Reguler & COD) saat halaman pertama dibuka
        document.querySelectorAll('input[name="shipping"], input[name="payment"]').forEach(r => toggleOpsiSelected(r));

        hitungTotal();
    });

    // ==========================================
    // LOGIKA MODAL PIN DAN PROSES PESANAN
    // ==========================================
    function prosesPesanan() {
        const alamatId = document.querySelector('input[name="alamat_id"]').value;
        if (!alamatId) {
            alert('Mohon tambahkan alamat pengiriman terlebih dahulu!');
            return;
        }

        const pembayaran = document.getElementById('input-final-pembayaran').value;
        if (!pembayaran || pembayaran === '') {
            alert('Mohon pilih metode pembayaran terlebih dahulu!');
            return;
        }

        // Pengecekan Jika Memilih E-Wallet atau Kartu Tersimpan
        if (pembayaran.startsWith('ewallet_') || pembayaran.startsWith('kartu_')) {
            bukaModalPin(pembayaran);
        } else {
            // Jika memilih COD, Langsung submit tanpa PIN
            document.getElementById('form-buat-pesanan').submit();
        }
    }

    function bukaModalPin(pembayaran) {
        const modal = document.getElementById('modalPinPembayaran');
        const textMetode = document.getElementById('nama-metode-pin');
        
        // Ubah Teks Metode Sesuai Pilihan
        if(pembayaran.startsWith('ewallet_')) {
            textMetode.innerText = "E-Wallet";
        } else if(pembayaran.startsWith('kartu_')) {
            textMetode.innerText = "Kartu Kredit";
        }

        // Kosongkan dan fokuskan input PIN
        document.querySelectorAll('.pin-input').forEach(input => input.value = '');
        document.getElementById('pin-error').classList.add('hidden');
        
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        
        setTimeout(() => document.getElementById('pin-0').focus(), 100);
    }

    function tutupModalPin() {
        document.getElementById('modalPinPembayaran').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Pindah otomatis ke kotak selanjutnya saat PIN diketik
    function pindahPin(input, nextId) {
        input.value = input.value.replace(/[^0-9]/g, ''); // Hanya boleh angka
        if (input.value.length === 1 && nextId < 6) {
            document.getElementById(`pin-${nextId}`).focus();
        }
    }

    // Pindah ke kotak sebelumnya saat menekan Backspace
    function hapusPin(event, prevId) {
        if (event.key === "Backspace" && event.target.value === "" && prevId >= 0) {
            document.getElementById(`pin-${prevId}`).focus();
        }
        if (event.key === "Enter") {
            konfirmasiPin();
        }
    }

    // Fungsi Submit setelah PIN dirasa lengkap
    function konfirmasiPin() {
        let pin = '';
        document.querySelectorAll('.pin-input').forEach(input => pin += input.value);
        
        const errorText = document.getElementById('pin-error');

        if (pin.length === 6) {
            errorText.classList.add('hidden');
            document.getElementById('btn-konfirmasi-pin').innerText = "Memproses...";
            
            // Masukkan PIN ke hidden input lalu kirim form
            document.getElementById('input-final-pin').value = pin;
            
            // Jeda sedikit agar terlihat elegan sebelum berpindah halaman
            setTimeout(() => {
                document.getElementById('form-buat-pesanan').submit();
            }, 500);
        } else {
            errorText.classList.remove('hidden');
            // Efek getar untuk error
            const container = document.getElementById('pin-container');
            container.classList.add('animate-pulse');
            setTimeout(() => container.classList.remove('animate-pulse'), 300);
        }
    }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\projek pak fajar\market-handphone\resources\views/user/checkout.blade.php ENDPATH**/ ?>