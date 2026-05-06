<?php $__env->startSection('content'); ?>

<!-- CSS & JS untuk Leaflet Maps -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<!-- Wrapper Utama -->
<div class="max-w-6xl mx-auto px-4 py-6 md:py-8 flex flex-col md:flex-row gap-4 md:gap-3">

    <!-- ========================================== -->
    <!-- SIDEBAR KIRI -->
    <!-- ========================================== -->
<div class="w-full md:w-48 flex-shrink-0">
        <!-- User Mini Profile -->
        <div class="flex items-center gap-3 mb-6 pb-6 border-b border-gray-200">
            <!-- Avatar Mini -->
            <?php if(Auth::user()->profile_photo): ?>
                <img src="<?php echo e(asset('storage/' . Auth::user()->profile_photo)); ?>" alt="Avatar" class="w-12 h-12 rounded-full object-cover border border-gray-200">
            <?php else: ?>
                <div class="w-12 h-12 bg-slate-500 text-white rounded-full flex items-center justify-center text-xl font-semibold">
                    <?php echo e(strtoupper(substr(Auth::user()->username, 0, 1))); ?>

                </div>
            <?php endif; ?>
            
            <div class="overflow-hidden">
                <div class="font-bold text-gray-800 truncate"><?php echo e(Auth::user()->username); ?></div>
                <a href="/profile" class="text-sm text-gray-500 flex items-center gap-1 mt-0.5 hover:text-orange-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    Ubah Profil
                </a>
            </div>
        </div>

        <!-- Menu Navigasi Sidebar -->
        <nav class="space-y-5 text-sm">
            <!-- Menu: Akun Saya -->
            <div>
                <div class="flex items-center gap-2 font-semibold text-gray-800 mb-2 cursor-pointer hover:text-orange-500 transition-colors">
                    <span class="text-blue-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </span>
                    Akun Saya
                </div>
                <div class="pl-7 space-y-3 mt-2">
                    <a href="/profile" class="block text-gray-600 hover:text-orange-500 transition-colors">Profil</a>
                    <a href="/profile/bank" class="block text-gray-600 hover:text-orange-500 transition-colors">Bank & Kartu</a>
                    <a href="/profile/alamat" class="block text-orange-500 font-medium">Alamat</a>
                    <a href="/profile/password" class="block text-gray-600 hover:text-orange-500 transition-colors">Ubah Password</a>
                </div>
            </div> <!-- Penutup grup Akun Saya -->

            <!-- Menu Lainnya -->
            <a href="/profile/pesanan" class="flex items-center gap-2 font-semibold text-gray-700 hover:text-orange-500 transition-colors">
                <span class="text-blue-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </span>
                Pesanan Saya
            </a>
            
           <a href="/profile/notifikasi" class="flex items-center gap-2 font-semibold text-gray-700 hover:text-orange-500 transition-colors">
            <span class="text-orange-500">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
            </span>
            Notifikasi
        </a>

           <a href="/profile/voucher" class="flex items-center gap-2 font-semibold text-gray-700 hover:text-orange-500 transition-colors">
                <span class="text-orange-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                </span>
                Voucher Saya
            </a>
        </nav>

        <!-- Garis Pembatas -->
            <div class="border-t border-gray-100 my-4"></div>

            <!-- Menu Logout di Sidebar -->
            <a href="/logout" class="flex items-center gap-2 font-semibold text-red-500 hover:bg-red-50 p-2 rounded-lg transition-colors">
                <span class="text-red-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                </span>
                Keluar
            </a>
    </div>

    <!-- ========================================== -->
    <!-- KONTEN UTAMA KANAN (ALAMAT) -->
    <!-- ========================================== -->
    <div class="flex-1 bg-white shadow-sm border border-gray-100 rounded-md p-6 md:p-8">
        
        <!-- 1. Notifikasi Sukses -->
        <?php if(session('success')): ?>
            <div id="notif-sukses" class="mb-4 bg-green-50 border border-green-200 text-green-600 px-4 py-3 rounded relative flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <span class="text-sm font-medium"><?php echo e(session('success')); ?></span>
            </div>
            <script>setTimeout(() => { document.getElementById('notif-sukses').style.display = 'none'; }, 4000);</script>
        <?php endif; ?>

        <!-- 2. Header (mb-4 agar jarak ke bawah lebih rapat / naik) -->
        <div class="border-b border-gray-200 pb-3 mb-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <h1 class="text-xl font-medium text-gray-800">Alamat Saya</h1>
            <button onclick="openModalAlamat()" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-sm text-sm font-medium transition-colors flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Alamat Baru
            </button>
        </div>

        <!-- 3. LOGIKA TAMPILAN: JIKA ADA ALAMAT vs JIKA KOSONG -->
        <?php if(isset($alamats) && $alamats->count() > 0): ?>
            
           <!-- TAMPIL JIKA ALAMAT ADA -->
<div class="space-y-3">
    <?php $__currentLoopData = $alamats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alamat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        
        <div class="relative border border-orange-200 rounded-lg p-4 hover:shadow-md bg-white transition-all group">
            
            <!-- 1. ICON DINAMIS (RUMAH/KANTOR) DI POJOK KANAN ATAS -->
            <div class="absolute top-4 right-4 text-gray-400 group-hover:text-orange-500 transition-colors">
                <?php if(isset($alamat->label)): ?>
                    <?php if($alamat->label == 'Rumah'): ?>
                        
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" title="Alamat Rumah">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                        </svg>
                    <?php elseif($alamat->label == 'Kantor'): ?>
                        
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" title="Alamat Kantor">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd" />
                        </svg>
                    <?php endif; ?>
                <?php endif; ?>
            </div>

            <!-- 2. HEADER ALAMAT (NAMA & NO HP) -->
            <div class="flex justify-between items-start mb-2 pr-10"> 
                <div class="flex items-center gap-2">
                    <span class="font-bold text-gray-800 text-base"><?php echo e($alamat->user->name); ?></span>
                    <span class="text-gray-300">|</span>
                    <span class="text-gray-600 text-sm"><?php echo e($alamat->user->phone_number); ?></span>
                </div>
                
                <?php if($alamat->is_utama): ?>
                    <span class="text-[10px] font-semibold bg-orange-100 text-orange-600 px-2.5 py-1 rounded-sm border border-orange-200">Utama</span>
                <?php endif; ?>
            </div>
            
            <!-- 3. DETAIL ALAMAT LENGKAP -->
            <p class="text-sm text-gray-600 leading-relaxed mb-3 pr-10">
                <span class="font-medium text-gray-800"><?php echo e($alamat->label ?? 'Alamat'); ?>:</span> 
                <?php echo e($alamat->alamat_detail); ?>, 
                <?php if($alamat->rt && $alamat->rw): ?> RT.<?php echo e($alamat->rt); ?>/RW.<?php echo e($alamat->rw); ?>, <?php endif; ?>
                <?php echo e($alamat->desa); ?>, <?php echo e($alamat->kecamatan); ?>, <?php echo e($alamat->kabupaten); ?>, <?php echo e($alamat->provinsi); ?>, <?php echo e($alamat->kode_pos); ?>

            </p>
            
            <!-- 4. AKSI (LIHAT PETA, UBAH, HAPUS) -->
            <div class="flex items-center justify-between mt-3 border-t border-gray-50 pt-3">
                <div class="flex items-center gap-4 text-sm font-medium">
                    <a href="https://www.google.com/maps?q=<?php echo e($alamat->latitude); ?>,<?php echo e($alamat->longitude); ?>" target="_blank" class="text-blue-500 hover:text-blue-600 hover:underline flex items-center gap-1.5 cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Lihat di Peta
                    </a>
                    <span class="text-gray-300">|</span>
                    <button onclick="editAlamat(<?php echo e(json_encode($alamat)); ?>)" 
                        class="text-orange-500 hover:text-orange-600 cursor-pointer">
                        Ubah
                    </button>
                </div>
                
                
                <form action="<?php echo e(route('alamat.destroy', $alamat->id)); ?>" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus alamat ini?');">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors p-1" title="Hapus Alamat">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
        <?php else: ?>

            <!-- TAMPIL JIKA ALAMAT KOSONG (Belum Ada Data) -->
            <div class="py-12 flex flex-col items-center justify-center text-gray-400">
                <svg class="w-16 h-16 mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <p class="text-base font-medium text-gray-500">Anda belum memiliki alamat yang tersimpan.</p>
                <p class="text-sm mt-1 text-center max-w-md text-gray-400">Tambahkan alamat pengiriman Anda untuk mempermudah proses checkout pesanan.</p>
            </div>

        <?php endif; ?>

    </div>

<!-- MODAL TAMBAH ALAMAT -->
<!-- pt-16 untuk mobile, md:pt-24 untuk desktop agar jaraknya pas (tidak terlalu low/high) -->
<div id="modal-alamat" class="fixed inset-0 z-[9999] hidden bg-black bg-opacity-60 flex items-start justify-center p-4 pt-16 md:pt-24 overflow-y-auto opacity-0 transition-opacity duration-300">
    
    <!-- Konten Modal -->
    <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl flex flex-col overflow-hidden transform scale-95 transition-transform duration-300 mb-10" id="modal-content">
        
        <!-- Header Modal -->
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50 flex-shrink-0">
            <h3 class="font-bold text-lg text-gray-800">Tambah Alamat Baru</h3>
            <button type="button" onclick="closeModalAlamat()" class="text-gray-400 hover:text-red-500 transition focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

       

        <!-- Body Modal (Bisa di-scroll) -->
        <div class="p-6 overflow-y-auto flex-1 custom-scrollbar">
        <form id="form-alamat" action="<?php echo e(route('alamat.store')); ?>" method="POST" class="space-y-6">
        <?php echo csrf_field(); ?>
        <div id="method-field"></div> 
        <input type="hidden" name="latitude" id="latitude">
        <input type="hidden" name="longitude" id="longitude">
                
               <!-- Bagian Kontak -->
<div>
    <h4 class="text-sm font-bold text-gray-800 mb-3 border-b pb-2">Kontak</h4>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Penerima</label>
            <input type="text" name="nama" 
                value="<?php echo e(Auth::user()->name); ?>" 
                class="w-full border border-gray-300 rounded px-3 py-2 text-sm bg-gray-50 text-gray-500 cursor-not-allowed" 
                readonly>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
            <!-- Pastikan value menggunakan phone_number sesuai kolom database Anda -->
            <input type="text" name="phone_number" 
                value="<?php echo e(Auth::user()->phone_number); ?>" 
                class="w-full border border-gray-300 rounded px-3 py-2 text-sm bg-gray-50 text-gray-500 cursor-not-allowed" 
                readonly>
        </div>
    </div>
    <p class="text-[10px] text-gray-400 mt-1 italic">*Data kontak diambil dari profil akun Anda.</p>
</div>
<!-- 2. Input Detail Alamat (Provinsi - Kode Pos) -->
                <div>
                    <h4 class="text-sm font-bold text-gray-800 mb-3 border-b pb-2">Alamat</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Provinsi</label>
                            <select id="provinsi" name="provinsi" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:ring-orange-500 focus:border-orange-500 bg-white" required>
                                <option value="" disabled selected>Pilih Provinsi...</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kabupaten/Kota</label>
                            <select id="kabupaten" name="kabupaten" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:ring-orange-500 focus:border-orange-500 bg-white" disabled required>
                                <option value="" disabled selected>Pilih Kabupaten/Kota...</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label>
                            <select id="kecamatan" name="kecamatan" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:ring-orange-500 focus:border-orange-500 bg-white" disabled required>
                                <option value="" disabled selected>Pilih Kecamatan...</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Desa/Kelurahan</label>
                            <select id="desa" name="desa" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:ring-orange-500 focus:border-orange-500 bg-white" disabled required>
                                <option value="" disabled selected>Pilih Desa/Kelurahan...</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">RT</label>
                            <select id="rt" name="rt" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:ring-orange-500 focus:border-orange-500 bg-white">
                                <option value="" disabled selected>Pilih RT</option>
                                <!-- Akan diisi otomatis oleh JS -->
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">RW</label>
                            <select id="rw" name="rw" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:ring-orange-500 focus:border-orange-500 bg-white">
                                <option value="" disabled selected>Pilih RW</option>
                                <!-- Akan diisi otomatis oleh JS -->
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kode Pos</label>
                            <!-- Teks bebas karena kodepos sering dihafal user -->
                           <input type="text" name="kode_pos" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:ring-orange-500 focus:border-orange-500" placeholder="Cth: 57464" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Jalan, Gedung, No. Rumah, Dukuh</label>
                        <textarea name="alamat_detail" rows="2" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:ring-orange-500 focus:border-orange-500" placeholder="Detail alamat untuk memudahkan kurir..." required></textarea>
                    </div>
                </div>

                <!-- 3. AREA PETA (MAP) -->
                <div>
                    <h4 class="text-sm font-bold text-gray-800 mb-3 border-b pb-2 flex justify-between items-center">
                        Titik Lokasi Peta
                        <button type="button" onclick="deteksiLokasi()" class="text-orange-500 hover:text-orange-600 text-[11px] font-bold flex items-center gap-1 bg-orange-50 hover:bg-orange-100 transition px-2 py-1 rounded border border-orange-200">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            Gunakan Lokasi Saat Ini
                        </button>
                    </h4>
                    
                    <div id="map-container" class="w-full h-[250px] bg-gray-200 rounded-lg border border-gray-300 z-10 relative overflow-hidden shadow-inner"></div>
                    <p class="text-[11px] text-gray-500 mt-1.5 italic flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Tarik dan geser pin biru agar kurir lebih akurat menemukan lokasi.
                    </p>
                </div>
<!-- Bagian Label dan Footer -->
<div class="mt-6 border-t border-gray-100 pt-5">
    <label class="block text-sm font-bold text-gray-700 mb-3">Tandai Sebagai:</label>
    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-5">
        <!-- Area Opsi Label (Kiri) -->
        <div class="flex items-center gap-3">
            <!-- Opsi Rumah -->
            <label class="cursor-pointer group">
                <input type="radio" name="label" value="Rumah" class="hidden peer" checked>
                <div class="flex items-center gap-2 px-4 py-2 border border-gray-200 rounded-md peer-checked:border-orange-500 peer-checked:bg-orange-50 peer-checked:text-orange-600 transition-all hover:border-orange-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span class="text-sm font-medium">Rumah</span>
                </div>
            </label>

            <!-- Opsi Kantor -->
            <label class="cursor-pointer group">
                <input type="radio" name="label" value="Kantor" class="hidden peer">
                <div class="flex items-center gap-2 px-4 py-2 border border-gray-200 rounded-md peer-checked:border-orange-500 peer-checked:bg-orange-50 peer-checked:text-orange-600 transition-all hover:border-orange-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    <span class="text-sm font-medium">Kantor</span>
                </div>
            </label>
        </div>

        <!-- Area Tombol Aksi (Kanan) -->
        <div class="flex items-center gap-3">
            <button type="button" onclick="closeModalAlamat()" class="px-6 py-2 text-sm font-bold text-gray-600 hover:bg-gray-100 rounded-md transition border border-gray-300">
                Batal
            </button>
            <button type="submit" class="px-6 py-2 text-sm font-bold text-white bg-orange-500 hover:bg-orange-600 rounded-md shadow-sm transition">
                Simpan Alamat
            </button>
        </div>
    </div>
</div>
            </form>
        </div>
    </div>
</div>

<script>
    // ==========================================
    // 1. FUNGSI BUKA/TUTUP MODAL & PETA LEAFLET
    // ==========================================
    let map;
    let marker;
    const modal = document.getElementById('modal-alamat');
    const modalContent = document.getElementById('modal-content');

    function openModalAlamat() {
        if(!modal || !modalContent) return;
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modalContent.classList.remove('scale-95');
        }, 10);
        setTimeout(() => { initMap(); }, 300);
    }

    function closeModalAlamat() {
        if(!modal || !modalContent) return;
        modal.classList.add('opacity-0');
        modalContent.classList.add('scale-95');
        setTimeout(() => { modal.classList.add('hidden'); }, 300);
    }

    function initMap() {
        const mapContainer = document.getElementById('map-container');
        if (!mapContainer) return;

        if (map) {
            map.invalidateSize();
            return;
        }
        
        const defaultLokasi = [-6.200000, 106.816666]; 
        map = L.map('map-container', { maxZoom: 20 }).setView(defaultLokasi, 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 20,
            maxNativeZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        marker = L.marker(defaultLokasi, { draggable: true, autoPan: true }).addTo(map);

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                const akuratLokasi = [lat, lng];

                map.setView(akuratLokasi, 18);
                marker.setLatLng(akuratLokasi);
                
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;
            }, null, { enableHighAccuracy: true });
        }

        marker.on('dragend', function (event) {
            const position = marker.getLatLng();
            document.getElementById('latitude').value = position.lat;
            document.getElementById('longitude').value = position.lng;
        });
    }

    function deteksiLokasi(event) {
        if (navigator.geolocation) {
            const btn = event ? event.currentTarget : null;
            let originalText = "";
            if(btn) {
                originalText = btn.innerHTML;
                btn.innerHTML = `<span class="animate-pulse text-gray-500">Mencari lokasi...</span>`;
            }

            navigator.geolocation.getCurrentPosition(
                function(position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    const lokasiBaru = [lat, lng];

                    if(map && marker) {
                        map.setView(lokasiBaru, 17);
                        marker.setLatLng(lokasiBaru);
                    }

                    const latInput = document.getElementById('latitude');
                    const lngInput = document.getElementById('longitude');
                    if(latInput) latInput.value = lat;
                    if(lngInput) lngInput.value = lng;
                    
                    if(btn) btn.innerHTML = originalText;
                },
                function(error) {
                    alert('Gagal mendeteksi lokasi. Pastikan izin GPS diaktifkan.');
                    if(btn) btn.innerHTML = originalText;
                },
                { enableHighAccuracy: true }
            );
        } else {
            alert("Browser Anda tidak mendukung deteksi lokasi.");
        }
    }

    // ==========================================
    // 2. API WILAYAH & KODE POS INDONESIA (Urut A-Z)
    // ==========================================
    document.addEventListener('DOMContentLoaded', function() {
        const apiWilayah = 'https://ibnux.github.io/data-indonesia';
        
        const elmProvinsi = document.getElementById('provinsi');
        const elmKabupaten = document.getElementById('kabupaten');
        const elmKecamatan = document.getElementById('kecamatan');
        const elmDesa = document.getElementById('desa');
        const elmRT = document.getElementById('rt');
        const elmRW = document.getElementById('rw');
        const inputKodePos = document.getElementById('kodepos_input') || document.querySelector('input[name="kode_pos"]');

        if(elmRT && elmRW) {
            for(let i = 1; i <= 50; i++) {
                let nomor = i.toString().padStart(3, '0'); 
                elmRT.innerHTML += `<option value="${nomor}">${nomor}</option>`;
                elmRW.innerHTML += `<option value="${nomor}">${nomor}</option>`;
            }
        }

        // B. Tarik Data Provinsi
        if(elmProvinsi) {
            fetch(`${apiWilayah}/provinsi.json`)
                .then(response => response.json())
                .then(provinces => {
                    // URUTKAN A-Z
                    provinces.sort((a, b) => a.nama.localeCompare(b.nama));
                    
                    provinces.forEach(prov => {
                        elmProvinsi.innerHTML += `<option value="${prov.nama}" data-id="${prov.id}">${prov.nama}</option>`;
                    });
                }).catch(error => console.error('Error:', error));
        }

        // C. Tarik Data Kabupaten
        if(elmProvinsi && elmKabupaten) {
            elmProvinsi.addEventListener('change', function() {
                const idProvinsi = this.options[this.selectedIndex].getAttribute('data-id');
                if(!idProvinsi) return;
                
                elmKabupaten.innerHTML = '<option value="" disabled selected>Loading...</option>';
                if(elmKecamatan) { elmKecamatan.innerHTML = '<option value="" disabled selected>Pilih Kecamatan...</option>'; elmKecamatan.disabled = true; }
                if(elmDesa) { elmDesa.innerHTML = '<option value="" disabled selected>Pilih Desa/Kelurahan...</option>'; elmDesa.disabled = true; }
                elmKabupaten.disabled = true;
                if(inputKodePos) inputKodePos.value = '';

                fetch(`${apiWilayah}/kabupaten/${idProvinsi}.json`)
                    .then(response => response.json())
                    .then(regencies => {
                        // URUTKAN A-Z
                        regencies.sort((a, b) => a.nama.localeCompare(b.nama));
                        
                        elmKabupaten.innerHTML = '<option value="" disabled selected>Pilih Kabupaten/Kota...</option>';
                        regencies.forEach(kab => {
                            elmKabupaten.innerHTML += `<option value="${kab.nama}" data-id="${kab.id}">${kab.nama}</option>`;
                        });
                        elmKabupaten.disabled = false; 
                    });
            });
        }

        // D. Tarik Data Kecamatan
        if(elmKabupaten && elmKecamatan) {
            elmKabupaten.addEventListener('change', function() {
                const idKabupaten = this.options[this.selectedIndex].getAttribute('data-id');
                if(!idKabupaten) return;
                
                elmKecamatan.innerHTML = '<option value="" disabled selected>Loading...</option>';
                if(elmDesa) { elmDesa.innerHTML = '<option value="" disabled selected>Pilih Desa/Kelurahan...</option>'; elmDesa.disabled = true; }
                elmKecamatan.disabled = true;
                if(inputKodePos) inputKodePos.value = '';

                fetch(`${apiWilayah}/kecamatan/${idKabupaten}.json`)
                    .then(response => response.json())
                    .then(districts => {
                        // URUTKAN A-Z
                        districts.sort((a, b) => a.nama.localeCompare(b.nama));
                        
                        elmKecamatan.innerHTML = '<option value="" disabled selected>Pilih Kecamatan...</option>';
                        districts.forEach(kec => {
                            elmKecamatan.innerHTML += `<option value="${kec.nama}" data-id="${kec.id}">${kec.nama}</option>`;
                        });
                        elmKecamatan.disabled = false;
                    });
            });
        }

        // E. Tarik Data Desa
        if(elmKecamatan && elmDesa) {
            elmKecamatan.addEventListener('change', function() {
                const idKecamatan = this.options[this.selectedIndex].getAttribute('data-id');
                if(!idKecamatan) return;
                
                elmDesa.innerHTML = '<option value="" disabled selected>Loading...</option>';
                elmDesa.disabled = true;
                if(inputKodePos) inputKodePos.value = '';

                fetch(`${apiWilayah}/kelurahan/${idKecamatan}.json`)
                    .then(response => response.json())
                    .then(villages => {
                        // URUTKAN A-Z
                        villages.sort((a, b) => a.nama.localeCompare(b.nama));
                        
                        elmDesa.innerHTML = '<option value="" disabled selected>Pilih Desa/Kelurahan...</option>';
                        villages.forEach(desa => {
                            elmDesa.innerHTML += `<option value="${desa.nama}" data-id="${desa.id}">${desa.nama}</option>`;
                        });
                        elmDesa.disabled = false;
                    });
            });
        }

        // F. AUTODETEKSI KODE POS
        if (elmDesa && inputKodePos && elmKecamatan) {
            elmDesa.addEventListener('change', function() {
                const namaDesa = this.value.replace(/kelurahan|desa/gi, '').trim();
                const namaKecamatan = elmKecamatan.options[elmKecamatan.selectedIndex].text.replace(/kecamatan/gi, '').trim();
                
                inputKodePos.value = 'Mencari...';

                fetch(`https://kodepos.vercel.app/search?q=${encodeURIComponent(namaDesa)}`)
                    .then(response => response.json())
                    .then(res => {
                        if (res.code === 200 && res.data && res.data.length > 0) {
                            const cocok = res.data.find(d => 
                                d.subdistrict.toLowerCase().includes(namaKecamatan.toLowerCase())
                            );
                            
                            if (cocok) {
                                inputKodePos.value = cocok.postalcode;
                            } else {
                                inputKodePos.value = res.data[0].postalcode; 
                            }
                        } else {
                            inputKodePos.value = '';
                            inputKodePos.placeholder = 'Tidak ketemu, isi manual';
                        }
                    })
                    .catch(err => {
                        console.error('Gagal fetch kode pos:', err);
                        inputKodePos.value = '';
                        inputKodePos.placeholder = 'Isi manual...';
                    });
            });
        }
    });

    function editAlamat(data) {
    // 1. Ubah Judul & Action Form
    const modalTitle = document.querySelector('#modal-content h3');
    if (modalTitle) modalTitle.innerText = 'Ubah Alamat';
    
    const form = document.getElementById('form-alamat');
    form.action = `/profile/alamat/${data.id}`; 
    document.getElementById('method-field').innerHTML = '<input type="hidden" name="_method" value="PUT">';

    // 2. Isi Data Kontak & Alamat Detail
    document.getElementsByName('nama')[0].value = data.nama;
    document.getElementsByName('phone_number')[0].value = data.phone_number;
    document.getElementsByName('alamat_detail')[0].value = data.alamat_detail;
    document.getElementsByName('kode_pos')[0].value = data.kode_pos;
    
    // 3. Menangani Dropdown Wilayah (Sangat Penting)
    // Karena dropdown diisi via API, kita perlu menyuntikkan data lama secara manual
    // agar muncul saat modal dibuka.
    const setDropdown = (id, value) => {
        const el = document.getElementById(id);
        if (el) {
            el.innerHTML = `<option value="${value}" selected>${value}</option>`;
            el.disabled = false;
        }
    };

    setDropdown('provinsi', data.provinsi);
    setDropdown('kabupaten', data.kabupaten);
    setDropdown('kecamatan', data.kecamatan);
    setDropdown('desa', data.desa);
    
    // RT & RW (Jika ada)
    if (data.rt) document.getElementById('rt').value = data.rt;
    if (data.rw) document.getElementById('rw').value = data.rw;

    // 4. Isi Koordinat & Update Map
    document.getElementById('latitude').value = data.latitude;
    document.getElementById('longitude').value = data.longitude;
    
    const lokasi = [parseFloat(data.latitude), parseFloat(data.longitude)];
    if (map && marker) {
        setTimeout(() => {
            map.invalidateSize();
            map.setView(lokasi, 18);
            marker.setLatLng(lokasi);
        }, 400); // Tunggu modal terbuka sempurna
    }

    // 5. Buka Modal
    openModalAlamat(true);
}

// Tambahkan parameter isEdit untuk membedakan aksi
function openModalAlamat(isEdit = false) {
    const modal = document.getElementById('modal-alamat');
    const modalContent = document.getElementById('modal-content');
    const form = document.getElementById('form-alamat');

    if (modal.classList.contains('hidden')) {
        // Jika bukan mode Edit, reset form ke mode "Tambah"
        if (!isEdit) {
            document.querySelector('#modal-content h3').innerText = 'Tambah Alamat Baru';
            form.action = "<?php echo e(route('alamat.store')); ?>";
            document.getElementById('method-field').innerHTML = '';
            form.reset();
            
            // Kembalikan dropdown wilayah ke kondisi awal
            ['kabupaten', 'kecamatan', 'desa'].forEach(id => {
                document.getElementById(id).disabled = true;
                document.getElementById(id).innerHTML = `<option value="" disabled selected>Pilih...</option>`;
            });
        }
        
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modalContent.classList.remove('scale-95');
        }, 10);
        
        // Inisialisasi map jika belum ada
        setTimeout(() => { 
            if (typeof initMap === 'function') initMap(); 
        }, 300);
    }
}
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XampUtama\htdocs\handphone\resources\views/profile/alamat.blade.php ENDPATH**/ ?>