

<?php $__env->startSection('content'); ?>
    <!-- PEMBUNGKUS UTAMA -->
    <div class="max-w-5xl mx-auto px-4 pt-6 pb-24 space-y-4">
        
        <h1 class="text-2xl font-bold text-gray-800 mb-2 flex items-center gap-2">
            Checkout
        </h1>

        <!-- 1. ALAMAT PENGIRIMAN -->
        <div class="bg-white rounded-sm shadow-sm border border-gray-100 relative overflow-hidden">
            <!-- Dekorasi Garis Atas (Style Marketplace) -->
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
                            <!-- Icon Rumah/Kantor di Pojok Kanan Atas Alamat -->
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
                                    <span class="font-normal text-gray-600 text-sm ml-1">
                                        <?php echo e($alamatUtama->user->phone_number ?? '-'); ?>

                                    </span>
                                </p>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    <span class="font-semibold text-gray-700">[<?php echo e($alamatUtama->label); ?>]</span> 
                                    <?php echo e($alamatUtama->alamat_detail); ?>, 
                                    <?php if($alamatUtama->rt || $alamatUtama->rw): ?>
                                        RT.<?php echo e($alamatUtama->rt); ?>/RW.<?php echo e($alamatUtama->rw); ?>, 
                                    <?php endif; ?>
                                    <?php echo e($alamatUtama->desa); ?>, 
                                    <?php echo e($alamatUtama->kecamatan); ?>, 
                                    <?php echo e($alamatUtama->kabupaten); ?>, 
                                    <?php echo e($alamatUtama->provinsi); ?>, 
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
                        <!-- Tampilan Jika Alamat Kosong -->
                        <div class="flex-1 bg-orange-50 rounded-xl p-4 border border-orange-100">
                            <p class="text-orange-600 italic flex items-center gap-2 font-medium">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                Alamat pengiriman belum diatur.
                            </p>
                            <p class="text-sm text-orange-500 mt-1">Silakan tambahkan alamat terlebih dahulu untuk melanjutkan pesanan.</p>
                        </div>
                        <!-- Asumsi rute alamat.index sudah ada, kalau belum arahkan ke /profile -->
                        <a href="<?php echo e(route('alamat.index') ?? '/profile'); ?>" class="bg-orange-500 text-white px-4 py-2.5 rounded-lg font-bold uppercase text-xs hover:bg-orange-600 transition-all shadow-sm">
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

        <!-- FITUR BARU: PROTEKSI GADGET & CATATAN -->
        <div class="bg-white rounded-sm shadow-sm border border-gray-100 overflow-hidden">
            <!-- Konten Proteksi -->
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
                <div class="text-gray-800 text-sm font-bold whitespace-nowrap pl-8 sm:pl-0">
                    Rp 45.000
                </div>
            </div>

            <!-- Catatan Penjual -->
            <div class="px-6 py-4 bg-slate-50/50 flex flex-col md:flex-row md:items-center gap-3">
                <div class="flex items-center gap-2 text-gray-600 min-w-[120px]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    <span class="text-sm font-medium">Pesan:</span>
                </div>
                <input type="text" 
                       name="note" 
                       id="input-pesan"
                       placeholder="(Opsional) Tinggalkan pesan ke penjual..." 
                       class="flex-1 bg-transparent border border-gray-200 rounded px-3 py-1.5 text-sm focus:border-orange-500 focus:ring-1 focus:ring-orange-500 placeholder:text-gray-400"
                       maxlength="200">
            </div>
        </div>

        <!-- FITUR BARU: VOUCHER -->
        <div class="bg-white rounded-sm shadow-sm border border-gray-100 p-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-center gap-2">
                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                    <span class="text-sm font-bold text-gray-800">Voucher Toko</span>
                </div>
                
                <div class="flex items-center gap-2 w-full sm:w-auto">
                    <input type="text" id="input-voucher" placeholder="Ketik: DISKON50" class="border border-gray-300 rounded px-3 py-1.5 text-sm flex-1 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500">
                    <button id="btn-terapkan-voucher" class="bg-gray-800 text-white px-4 py-1.5 rounded text-sm font-bold hover:bg-gray-700 transition">Terapkan</button>
                </div>
            </div>
            <p id="pesan-voucher" class="text-xs text-green-600 mt-2 hidden">Voucher berhasil digunakan! Anda mendapat potongan Rp 50.000</p>
        </div>

        <!-- 3. PENGIRIMAN & PEMBAYARAN -->
        <div class="bg-white rounded-sm shadow-sm border border-gray-100">
            <!-- Opsi Pengiriman -->
            <div class="p-6 border-b border-gray-100 flex flex-col md:flex-row md:items-center gap-6">
                <h2 class="font-bold text-gray-800 text-sm w-40 flex-shrink-0">Opsi Pengiriman</h2>
                <div class="flex gap-4 flex-wrap flex-1">
                    <label class="relative cursor-pointer select-none">
                        <input type="radio" name="shipping" value="15000" class="hidden" checked>
                        <div class="opsi-box px-4 py-2 border-2 border-orange-500 text-orange-500 rounded transition bg-orange-50/50">
                            <span class="text-sm font-bold">Reguler (Rp 15.000)</span>
                        </div>
                        <div class="opsi-centang absolute bottom-0 right-0 w-4 h-4 bg-orange-500 flex justify-center items-center rounded-br">
                            <svg class="w-2.5 h-2.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </label>
                    <label class="relative cursor-pointer select-none">
                        <input type="radio" name="shipping" value="35000" class="hidden">
                        <div class="opsi-box px-4 py-2 border border-gray-300 text-gray-700 hover:border-orange-500 hover:text-orange-500 rounded transition">
                            <span class="text-sm font-medium">Kargo (Rp 35.000)</span>
                        </div>
                        <div class="opsi-centang absolute bottom-0 right-0 w-4 h-4 bg-orange-500 hidden justify-center items-center rounded-br">
                            <svg class="w-2.5 h-2.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Metode Pembayaran -->
            <div class="p-6 flex flex-col md:flex-row md:items-start gap-6">
                <h2 class="font-bold text-gray-800 text-sm w-40 flex-shrink-0">Metode Pembayaran</h2>
                <div class="flex gap-3 flex-wrap flex-1">
                    <label class="relative cursor-pointer select-none">
                        <input type="radio" name="payment" value="transfer" class="hidden" checked>
                        <div class="opsi-box px-4 py-2 border-2 border-orange-500 text-orange-500 rounded transition bg-orange-50/50">
                            <span class="text-sm font-bold">Transfer Bank</span>
                        </div>
                        <div class="opsi-centang absolute bottom-0 right-0 w-4 h-4 bg-orange-500 flex justify-center items-center rounded-br">
                            <svg class="w-2.5 h-2.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </label>
                    <label class="relative cursor-pointer select-none">
                        <input type="radio" name="payment" value="ewallet" class="hidden">
                        <div class="opsi-box px-4 py-2 border border-gray-300 text-gray-700 hover:border-orange-500 hover:text-orange-500 rounded transition">
                            <span class="text-sm font-medium">E-Wallet</span>
                        </div>
                        <div class="opsi-centang absolute bottom-0 right-0 w-4 h-4 bg-orange-500 hidden justify-center items-center rounded-br">
                            <svg class="w-2.5 h-2.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </label>
                    <label class="relative cursor-pointer select-none">
                        <input type="radio" name="payment" value="cod" class="hidden">
                        <div class="opsi-box px-4 py-2 border border-gray-300 text-gray-700 hover:border-orange-500 hover:text-orange-500 rounded transition">
                            <span class="text-sm font-medium">COD (Bayar di Tempat)</span>
                        </div>
                        <div class="opsi-centang absolute bottom-0 right-0 w-4 h-4 bg-orange-500 hidden justify-center items-center rounded-br">
                            <svg class="w-2.5 h-2.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </label>
                </div>
            </div>
        </div>

        <!-- 4. RINCIAN TAGIHAN DINAMIS -->
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
                        <span>Diskon Voucher</span>
                        <span class="font-bold">- Rp 50.000</span>
                    </div>
                    
                    <div class="flex justify-between items-center text-gray-600">
                        <span>Biaya Layanan & Jasa</span>
                        <div class="flex items-center gap-1">
                            <span class="font-medium text-gray-800">Rp <?php echo e(number_format($biayaLayanan ?? 0, 0, ',', '.')); ?></span>
                        </div>
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

            <!-- Dekorasi Bawah Ala Potongan Nota -->
            <div class="h-1 w-full bg-[radial-gradient(circle_at_center,_#f3f4f6_6px,_transparent_0)] bg-[length:12px_12px] bg-repeat-x"></div>
        </div>

    </div>

    <!-- 5. BAR LENGKET PALING BAWAH -->
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
                
                <!-- Form Eksekusi Pesanan (Tersembunyi tapi tombolnya yang terlihat) -->
                <form id="form-buat-pesanan" action="<?php echo e(route('checkout.process')); ?>" method="POST" class="flex">
                    <?php echo csrf_field(); ?>
                    <!-- Data Barang -->
                    <?php $__currentLoopData = $checkoutItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <input type="hidden" name="cart_ids[]" value="<?php echo e($item->id); ?>">
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <!-- Data yang dikirim ke server -->
                    <input type="hidden" name="alamat_id" value="<?php echo e(isset($alamatUtama) ? $alamatUtama->id : ''); ?>">
                    <input type="hidden" name="pengiriman" id="input-final-pengiriman" value="15000">
                    <input type="hidden" name="pembayaran" id="input-final-pembayaran" value="transfer">
                    <input type="hidden" name="proteksi" id="input-final-proteksi" value="0">
                    <input type="hidden" name="voucher" id="input-final-voucher" value="">
                    <input type="hidden" name="pesan" id="input-final-pesan" value="">

                    <button type="button" onclick="prosesPesanan()" class="bg-orange-500 hover:bg-orange-600 text-white font-bold text-sm md:text-lg px-8 md:px-12 flex-shrink-0 transition flex flex-col justify-center items-center shadow-lg shadow-orange-200">
                        <span>Buat Pesanan</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

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
        const inputVoucher = document.getElementById('input-voucher');
        const pesanVoucher = document.getElementById('pesan-voucher');
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

        function updateRadioUI() {
            allRadios.forEach(radio => {
                const label = radio.closest('label');
                if (!label) return;

                const box = label.querySelector('.opsi-box');
                const centang = label.querySelector('.opsi-centang');

                if (box && centang) {
                    if (radio.checked) {
                        box.className = "opsi-box px-4 py-2 border-2 border-orange-500 text-orange-500 rounded transition bg-orange-50/50";
                        centang.className = "opsi-centang absolute bottom-0 right-0 w-4 h-4 bg-orange-500 flex justify-center items-center rounded-br";
                    } else {
                        box.className = "opsi-box px-4 py-2 border border-gray-300 text-gray-700 hover:border-orange-500 hover:text-orange-500 rounded transition";
                        centang.className = "opsi-centang absolute bottom-0 right-0 w-4 h-4 bg-orange-500 hidden justify-center items-center rounded-br";
                    }
                }
            });
        }

        function hitungTotal() {
            const grandTotal = subtotalProduk + biayaOngkir + biayaLayanan + biayaProteksi - diskonVoucher;
            
            displayOngkir.innerText = formatRp(biayaOngkir);
            displayGrandTotal.innerText = formatRp(grandTotal);
            bottomGrandTotal.innerText = formatRp(grandTotal);
        }

        // Listener Radio Button (Ongkir & Pembayaran)
        allRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                updateRadioUI();
                if (this.name === 'shipping') {
                    biayaOngkir = parseInt(this.value);
                    inputFinalPengiriman.value = this.value;
                    hitungTotal();
                } else if (this.name === 'payment') {
                    inputFinalPembayaran.value = this.value;
                }
            });
        });

        // Listener Proteksi
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

        // Listener Voucher
        if (btnVoucher) {
            btnVoucher.addEventListener('click', function(e) {
                e.preventDefault(); // Jangan submit form
                const kode = inputVoucher.value.toUpperCase();
                
                if (kode === 'DISKON50') {
                    diskonVoucher = 50000;
                    inputFinalVoucher.value = kode;
                    rowVoucher.classList.remove('hidden');
                    pesanVoucher.classList.remove('hidden', 'text-red-600');
                    pesanVoucher.classList.add('text-green-600');
                    pesanVoucher.innerText = "Voucher berhasil digunakan! Anda mendapat potongan Rp 50.000";
                    inputVoucher.disabled = true;
                    this.disabled = true;
                    this.innerText = 'Diterapkan';
                    this.classList.replace('bg-gray-800', 'bg-gray-400');
                } else if (kode === '') {
                    alert('Masukkan kode voucher terlebih dahulu.');
                } else {
                    diskonVoucher = 0;
                    inputFinalVoucher.value = "";
                    rowVoucher.classList.add('hidden');
                    pesanVoucher.classList.remove('hidden', 'text-green-600');
                    pesanVoucher.classList.add('text-red-600');
                    pesanVoucher.innerText = "Kode voucher tidak valid atau sudah kedaluwarsa.";
                }
                hitungTotal();
            });
        }

        // Listener Catatan Pesan
        if(inputPesan) {
            inputPesan.addEventListener('input', function() {
                inputFinalPesan.value = this.value;
            });
        }

        updateRadioUI();
        hitungTotal();
    });

    // FUNGSI SUBMIT FORM
    function prosesPesanan() {
        const alamatId = document.querySelector('input[name="alamat_id"]').value;
        if(!alamatId) {
            alert('Mohon tambahkan alamat pengiriman terlebih dahulu!');
            return;
        }
        document.getElementById('form-buat-pesanan').submit();
    }

    // MODAL LOGIC
    function openModalPilihAlamat() {
        const modal = document.getElementById('modalPilihAlamat');
        if(modal) {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        } else {
            alert('Fitur ganti alamat sedang dalam pengembangan.');
        }
    }

    function closeModalPilihAlamat() {
        const modal = document.getElementById('modalPilihAlamat');
        if(modal) {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    }

    function pilihAlamatIni(alamatId) {
        const url = new URL(window.location.href);
        url.searchParams.set('alamat_id', alamatId);
        window.location.href = url.href;
    }
    </script>

    <!-- MODAL PILIH ALAMAT (Akan tampil jika ada data $semuaAlamat yang dikirim dari controller) -->
    <?php if(isset($semuaAlamat) && count($semuaAlamat) > 0): ?>
    <div id="modalPilihAlamat" class="fixed inset-0 z-[100] hidden overflow-y-auto">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity" onclick="closeModalPilihAlamat()"></div>
        
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative w-full max-w-2xl bg-white rounded-2xl shadow-2xl overflow-hidden">
                <!-- Header Modal -->
                <div class="flex items-center justify-between p-5 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="text-lg font-bold text-gray-800">Pilih Alamat Pengiriman</h3>
                    <button onclick="closeModalPilihAlamat()" class="text-gray-400 hover:text-red-500 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <!-- Daftar Alamat -->
                <div class="p-4 max-h-[60vh] overflow-y-auto space-y-3 bg-gray-50/30">
                    <?php $__currentLoopData = $semuaAlamat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="relative border-2 rounded-xl p-4 cursor-pointer transition-all <?php echo e(isset($alamatUtama) && $item->id == $alamatUtama->id ? 'border-orange-500 bg-orange-50/30 shadow-sm' : 'border-transparent bg-white hover:border-gray-200 shadow-sm'); ?>" 
                         onclick="pilihAlamatIni('<?php echo e($item->id); ?>')">
                        
                        <?php if(isset($alamatUtama) && $item->id == $alamatUtama->id): ?>
                            <div class="absolute top-4 right-4 text-orange-500">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            </div>
                        <?php endif; ?>

                        <p class="font-bold text-gray-800"><?php echo e($item->user->name ?? 'Pengguna'); ?> <span class="text-gray-400 font-normal">| <?php echo e($item->user->phone_number ?? '-'); ?></span></p>
                        <p class="text-sm text-gray-600 mt-2 leading-relaxed">
                            <span class="font-semibold text-gray-800 bg-gray-100 px-2 py-0.5 rounded text-xs mr-1"><?php echo e($item->label); ?></span> 
                            <?php echo e($item->alamat_detail); ?>, RT.<?php echo e($item->rt); ?>/RW.<?php echo e($item->rw); ?>, <?php echo e($item->desa); ?>, <?php echo e($item->kecamatan); ?>, <?php echo e($item->kabupaten); ?>, <?php echo e($item->provinsi); ?>

                        </p>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Footer Modal -->
                <div class="p-4 border-t border-gray-100 bg-white flex justify-center">
                    <!-- Asumsi rute alamat.index ada -->
                    <a href="<?php echo e(route('alamat.index') ?? '/profile'); ?>" class="text-orange-500 font-bold text-sm hover:underline flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Alamat Baru
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\projek pak fajar\market-handphone\resources\views/user/checkout.blade.php ENDPATH**/ ?>