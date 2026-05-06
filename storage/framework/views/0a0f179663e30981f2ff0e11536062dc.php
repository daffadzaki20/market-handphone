<?php $__env->startSection('content'); ?>

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
                    <a href="#" class="text-sm text-gray-500 flex items-center gap-1 mt-0.5 hover:text-orange-500">
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
                    <a href="/profile" class="block text-orange-500 font-medium">Profil</a>
                    <a href="/profile/bank" class="block text-gray-600 hover:text-orange-500 transition-colors">Bank & Kartu</a>
                    <a href="/profile/alamat" class="block text-gray-600 hover:text-orange-500 transition-colors">Alamat</a>
                    <a href="/profile/password" class="block text-gray-600 hover:text-orange-500 transition-colors">Ubah Password</a>
                </div>
                </div>

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

            <form method="POST" action="<?php echo e(route('logout')); ?>" class="w-full">
                <?php echo csrf_field(); ?>
                <button type="submit" class="w-full flex items-center gap-2 font-semibold text-red-500 hover:bg-red-50 p-2 rounded-lg transition-all text-left group cursor-pointer border-none bg-transparent">
                    <span class="text-red-500">
                        <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                    </span>
                    Keluar
                </button>
            </form>
        </div>

        <!-- ========================================== -->
        <!-- KONTEN UTAMA KANAN -->
        <!-- ========================================== -->
        <div class="flex-1 bg-white shadow-sm border border-gray-100 rounded-md p-6 md:p-8">  
            <!-- Header -->
            <div class="border-b border-gray-200 pb-4 mb-8">
                <h1 class="text-xl font-medium text-gray-800">Profil Saya</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola dan lindungi akun Anda</p>
            </div>

            <div class="flex flex-col-reverse md:flex-row gap-8">
                
                <!-- FORM PROFIL (Kiri) -->
                <div class="flex-1 md:pr-12 md:border-r border-gray-200">
                    
                    <!-- Alert Pesan Sukses -->
                    <?php if(session('success')): ?>
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>

                    <!-- Blok Error -->
                    <?php if($errors->any()): ?>
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6">
                            <strong class="font-bold">Gagal Menyimpan!</strong>
                            <ul class="list-disc pl-5 mt-1 text-sm">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <!-- Form Update Profil -->
                    <form action="/profile/update" method="POST">
                        <?php echo csrf_field(); ?>
                        
                        <!-- Username (Read Only) -->
                        <div class="flex flex-col sm:flex-row sm:items-center mb-6">
                            <label class="sm:w-1/3 sm:text-right pr-5 text-sm text-gray-500 mb-2 sm:mb-0">Username</label>
                            <div class="sm:w-2/3 text-sm text-gray-800 font-medium">
                                <?php echo e(Auth::user()->username); ?>

                            </div>
                        </div>

                        <!-- Name -->
                        <div class="flex flex-col sm:flex-row sm:items-center mb-6">
                            <label class="sm:w-1/3 sm:text-right pr-5 text-sm text-gray-500 mb-2 sm:mb-0">Nama</label>
                            <div class="sm:w-2/3">
                                <input type="text" name="name" value="<?php echo e(Auth::user()->name); ?>" class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:border-orange-500 focus:ring-1 focus:ring-orange-500 outline-none transition-colors">
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="flex flex-col sm:flex-row sm:items-center mb-6">
                            <label class="sm:w-1/3 sm:text-right pr-5 text-sm text-gray-500 mb-2 sm:mb-0">Email</label>
                            <div class="sm:w-2/3 text-sm text-gray-800">
                                <input type="email" name="email" value="<?php echo e(Auth::user()->email); ?>" placeholder="Masukkan email" class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:border-orange-500 focus:ring-1 focus:ring-orange-500 outline-none transition-colors">
                            </div>
                        </div>

                        <!-- Phone Number -->
                        <div class="flex flex-col sm:flex-row sm:items-center mb-6">
                            <label class="sm:w-1/3 sm:text-right pr-5 text-sm text-gray-500 mb-2 sm:mb-0">Nomor Telepon</label>
                            <div class="sm:w-2/3 text-sm">
                                <input type="tel" name="phone_number" value="<?php echo e(Auth::user()->phone_number); ?>" placeholder="Contoh: 081234567890" minlength="10" maxlength="15" oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="w-full border border-gray-300 rounded-sm px-3 py-2 text-sm focus:border-orange-500 outline-none">
                            </div>
                        </div>

                        <!-- Gender -->
                        <div class="flex flex-col sm:flex-row sm:items-center mb-6">
                            <label class="sm:w-1/3 sm:text-right pr-5 text-sm text-gray-500 mb-2 sm:mb-0">Jenis Kelamin</label>
                            <div class="sm:w-2/3 flex gap-4 text-sm text-gray-700">
                                <label class="flex items-center gap-1 cursor-pointer"><input type="radio" name="gender" value="Laki-laki" <?php echo e(Auth::user()->gender == 'Laki-laki' ? 'checked' : ''); ?> class="text-orange-500 focus:ring-orange-500"> Laki-laki</label>
                                <label class="flex items-center gap-1 cursor-pointer"><input type="radio" name="gender" value="Perempuan" <?php echo e(Auth::user()->gender == 'Perempuan' ? 'checked' : ''); ?> class="text-orange-500 focus:ring-orange-500"> Perempuan</label>
                            </div>
                        </div>

                        <!-- Tanggal Lahir -->
                        <div class="flex flex-col sm:flex-row sm:items-center mb-8">
                            <label class="sm:w-1/3 sm:text-right pr-5 text-sm text-gray-500 mb-2 sm:mb-0">Tanggal Lahir</label>
                            <div class="sm:w-2/3 flex gap-2">
                                
                                <?php
                                    $dob = Auth::user()->date_of_birth ? explode('-', Auth::user()->date_of_birth) : [null, null, null];
                                    $savedYear = $dob[0];
                                    $savedMonth = $dob[1] ? (int)$dob[1] : null;
                                    $savedDay = $dob[2] ? (int)$dob[2] : null;
                                ?>

                                <!-- Pilih Hari -->
                                <select name="dob_day" class="border border-gray-300 rounded-sm px-2 py-2 text-sm text-gray-700 focus:border-orange-500 outline-none w-20">
                                    <option value="" disabled <?php echo e(!$savedDay ? 'selected' : ''); ?>>Hari</option>
                                    <?php for($i = 1; $i <= 31; $i++): ?>
                                        <option value="<?php echo e($i); ?>" <?php echo e($savedDay == $i ? 'selected' : ''); ?>><?php echo e($i); ?></option>
                                    <?php endfor; ?>
                                </select>

                                <!-- Pilih Bulan -->
                                <?php
                                    $bulan = [1=>'Januari', 2=>'Februari', 3=>'Maret', 4=>'April', 5=>'Mei', 6=>'Juni', 7=>'Juli', 8=>'Agustus', 9=>'September', 10=>'Oktober', 11=>'November', 12=>'Desember'];
                                ?>
                                <select name="dob_month" class="border border-gray-300 rounded-sm px-2 py-2 text-sm text-gray-700 focus:border-orange-500 outline-none w-32">
                                    <option value="" disabled <?php echo e(!$savedMonth ? 'selected' : ''); ?>>Bulan</option>
                                    <?php $__currentLoopData = $bulan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $angka => $nama): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($angka); ?>" <?php echo e($savedMonth == $angka ? 'selected' : ''); ?>><?php echo e($nama); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>

                                <!-- Pilih Tahun -->
                                <select name="dob_year" class="border border-gray-300 rounded-sm px-2 py-2 text-sm text-gray-700 focus:border-orange-500 outline-none w-24">
                                    <option value="" disabled <?php echo e(!$savedYear ? 'selected' : ''); ?>>Tahun</option>
                                    <?php for($i = date('Y'); $i >= 1950; $i--): ?>
                                        <option value="<?php echo e($i); ?>" <?php echo e($savedYear == $i ? 'selected' : ''); ?>><?php echo e($i); ?></option>
                                    <?php endfor; ?>
                                </select>

                            </div>
                        </div>
                        
                        <!-- Save Button -->
                        <div class="flex flex-col sm:flex-row sm:items-center">
                            <div class="sm:w-1/3 pr-5"></div>
                            <div class="sm:w-2/3">
                                <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-sm text-sm font-medium transition-colors shadow-sm">
                                    Simpan
                                </button>
                            </div>
                        </div>

                    </form>
                </div>

                <!-- FOTO PROFIL & UPLOAD (Kanan) -->
                <div class="w-full md:w-1/3 flex flex-col items-center pt-2">
                    
                    <form action="/profile/photo" method="POST" enctype="multipart/form-data" id="photoForm" class="flex flex-col items-center">
                        <?php echo csrf_field(); ?>
                        
                        <input type="file" name="profile_photo" id="profile_photo" class="hidden" accept=".jpeg,.png,.jpg" onchange="document.getElementById('photoForm').submit();">
                        
                        <!-- Avatar Display -->
                        <div class="w-28 h-28 mb-5 relative group">
                            <?php if(Auth::user()->profile_photo): ?>
                                <img src="<?php echo e(asset('storage/' . Auth::user()->profile_photo)); ?>" alt="Foto Profil" class="w-full h-full rounded-full object-cover border border-gray-200 shadow-sm">
                            <?php else: ?>
                                <div class="w-full h-full bg-slate-500 text-white rounded-full flex items-center justify-center text-5xl font-semibold border border-gray-200 shadow-sm">
                                    <?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Select Image Button -->
                        <label for="profile_photo" class="cursor-pointer bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 px-4 py-2 rounded-sm text-sm font-medium transition-colors">
                            Pilih Gambar
                        </label>
                        
                        <!-- Info Text -->
                        <div class="text-xs text-gray-400 mt-4 text-center leading-relaxed">
                            Ukuran file: maksimal 1 MB<br>
                            Ekstensi file: .JPEG, .PNG
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XampUtama\htdocs\handphone\resources\views/profile/index.blade.php ENDPATH**/ ?>