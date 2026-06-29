<?php $__env->startSection('content'); ?>
    <!-- WRAPPER UTAMA (Agar konten rapi di tengah dan tidak nabrak tepi layar) -->
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- HERO SECTION DENGAN ANIMASI GRADIENT -->
            <div class="relative overflow-hidden rounded-3xl mb-12 shadow-2xl group">
                <!-- Background Animasi -->
                <div class="absolute inset-0 bg-gradient-to-br from-blue-600 via-purple-600 to-blue-800 animate-gradient-xy"></div>
                
                <!-- Dekorasi Lingkaran -->
                <div class="absolute -top-24 -left-24 w-64 h-64 bg-white/10 rounded-full blur-3xl group-hover:bg-white/20 transition-all duration-700"></div>
                <div class="absolute -bottom-24 -right-24 w-80 h-80 bg-blue-400/20 rounded-full blur-3xl group-hover:scale-110 transition-all duration-700"></div>

                <!-- KONTEN HERO (Ditambahkan relative z-10 dan padding p-10 agar teks tidak nabrak tepi) -->
                <div class="relative z-10 p-10 md:p-16 lg:p-20 text-white">
                    <h1 class="text-4xl md:text-6xl font-black mb-6 tracking-tight leading-tight animate-fade-in-up flex flex-wrap items-center justify-start gap-4">
                        <span>Selamat Datang di</span>
                        <br class="hidden md:block">
                        <div class="flex items-center gap-4">
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-300 to-yellow-200">
                                MyPhoneStore
                            </span>
                            
                            <!-- ICON HP CUSTOM -->
                            <div class="relative inline-flex items-center justify-center group/phone hidden sm:flex">
                                <div class="absolute inset-0 bg-yellow-400/30 blur-xl rounded-full group-hover/phone:bg-orange-400/50 transition-colors"></div>
                                <svg class="relative w-10 h-16 md:w-12 md:h-20 drop-shadow-2xl transform -rotate-12 group-hover/phone:rotate-0 transition-transform duration-500" viewBox="0 0 24 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="1" y="1" width="22" height="38" rx="4" fill="#1f2937" stroke="#9ca3af" stroke-width="1.5"/>
                                    <rect x="2.5" y="2.5" width="19" height="35" rx="2.5" fill="url(#screenGradient)"/>
                                    <rect x="9" y="4" width="6" height="1.5" rx="0.75" fill="#111827"/>
                                    <rect x="10" y="35" width="4" height="0.8" rx="0.4" fill="#4b5563"/>
                                    <defs>
                                        <linearGradient id="screenGradient" x1="0" y1="0" x2="24" y2="40" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#fbbf24"/>
                                            <stop offset="1" stop-color="#ea580c"/>
                                        </linearGradient>
                                    </defs>
                                </svg>
                            </div>
                        </div>
                    </h1>
                    
                    <p class="text-blue-100 text-lg md:text-xl leading-relaxed max-w-2xl mb-8 animate-fade-in-up delay-100">
                        Marketplace terpercaya untuk kebutuhan smartphone dan aksesoris original dengan garansi terbaik di kelasnya.
                    </p>
                    
                    <div class="flex flex-wrap gap-4 animate-fade-in-up delay-200">
                        <a href="#katalog" class="bg-white text-blue-600 px-8 py-3 rounded-full font-bold shadow-lg hover:shadow-white/20 hover:scale-105 transition-all">Mulai Belanja</a>
                        <div class="bg-white/10 backdrop-blur-md px-6 py-3 rounded-full border border-white/20 text-sm font-medium">✨ 100% Original</div>
                    </div>
                </div>
            </div>

            <!-- QUICK ACTION / KATEGORI -->
            <div id="kategori" class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
                <!-- KATEGORI HP -->
                <a href="<?php echo e(route('handphone.index')); ?>" class="relative overflow-hidden bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-500 group">
                    <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
                        <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M17 1H7c-1.1 0-2 .9-2 2v18c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V3c0-1.1-.9-2-2-2zm0 18H7V5h10v14z"/></svg>
                    </div>
                    <div class="relative z-10">
                        <div class="text-5xl mb-6 inline-flex items-center justify-center w-20 h-20 bg-blue-50 rounded-2xl group-hover:bg-blue-600 group-hover:text-white transition-colors duration-500 shadow-inner">
                            📱
                        </div>
                        <h2 class="text-3xl font-extrabold mb-3 text-gray-800 group-hover:text-blue-600 transition-colors">Smartphone</h2>
                        <p class="text-gray-500 mb-6 leading-relaxed">iPhone, Samsung, Xiaomi, hingga Infinix dengan harga bersaing.</p>
                        <div class="flex items-center gap-2 text-blue-600 font-black text-sm tracking-widest uppercase">
                            Jelajahi <span class="group-hover:translate-x-3 transition-transform duration-300">→</span>
                        </div>
                    </div>
                </a>

                <!-- KATEGORI AKSESORIS -->
                <a href="<?php echo e(route('aksesoris.index')); ?>" class="relative overflow-hidden bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-500 group">
                    <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
                        <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3a9 9 0 0 0-9 9v7c0 1.1.9 2 2 2h4v-8H5v-1a7 7 0 0 1 14 0v1h-4v8h4c1.1 0 2-.9 2-2v-7a9 9 0 0 0-9-9z"/></svg>
                    </div>
                    <div class="relative z-10">
                        <div class="text-5xl mb-6 inline-flex items-center justify-center w-20 h-20 bg-orange-50 rounded-2xl group-hover:bg-orange-500 group-hover:text-white transition-colors duration-500 shadow-inner">
                            🎧
                        </div>
                        <h2 class="text-3xl font-extrabold mb-3 text-gray-800 group-hover:text-orange-600 transition-colors">Aksesoris</h2>
                        <p class="text-gray-500 mb-6 leading-relaxed">Casing, Charger, TWS, dan pelengkap gadget lainnya.</p>
                        <div class="flex items-center gap-2 text-orange-600 font-black text-sm tracking-widest uppercase">
                            Jelajahi <span class="group-hover:translate-x-3 transition-transform duration-300">→</span>
                        </div>
                    </div>
                </a>
            </div>

          

            <!-- SECTION: WHY CHOOSE US -->
            <div class="mb-16">
                <div class="text-center mb-10">
                    <h2 class="text-3xl font-black text-gray-800 tracking-tight">Kenapa Harus MyPhoneStore?</h2>
                    <p class="text-gray-500 mt-2">Kami memberikan standar baru dalam berbelanja gadget.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Kelebihan 1 -->
                    <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 group">
                        <div class="w-14 h-14 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-green-600 group-hover:text-white transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                        <h3 class="font-bold text-lg text-gray-800">Garansi Resmi</h3>
                        <p class="text-gray-500 text-sm mt-2 leading-relaxed">Semua unit dipastikan 100% original dengan dukungan garansi resmi distributor.</p>
                    </div>

                    <!-- Kelebihan 2 -->
                    <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 group">
                        <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <h3 class="font-bold text-lg text-gray-800">Fast Response</h3>
                        <p class="text-gray-500 text-sm mt-2 leading-relaxed">Admin profesional yang siap melayani konsultasi spesifikasi gadget impian Anda.</p>
                    </div>

                    <!-- Kelebihan 3 -->
                    <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 group">
                        <div class="w-14 h-14 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-orange-600 group-hover:text-white transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="font-bold text-lg text-gray-800">Cicilan 0%</h3>
                        <p class="text-gray-500 text-sm mt-2 leading-relaxed">Berbagai pilihan pembayaran mulai dari debit, kartu kredit, hingga paylater.</p>
                    </div>
                </div>
            </div>

            <!-- SECTION: STORE LOCATION -->
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden mb-12">
                <div class="flex flex-col md:flex-row">
                    <!-- Info Lokasi -->
                    <div class="md:w-1/3 p-8 md:p-10 bg-slate-900 text-white flex flex-col justify-center">
                        <span class="text-blue-400 font-bold text-xs uppercase tracking-widest mb-2">Lokasi Toko</span>
                        <h2 class="text-3xl font-black mb-4">Kunjungi Offline Store Kami</h2>
                        <div class="space-y-4 text-slate-400 text-sm">
                            <p class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                Jl. Teknologi No. 12, Kota Digital, Kalimantan Selatan.
                            </p>
                            <p class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Buka Setiap Hari: 09.00 - 21.00 WIB
                            </p>
                        </div>
                        <a href="https://maps.google.com" target="_blank" class="mt-8 inline-flex items-center gap-2 text-white font-bold text-sm bg-blue-600 px-6 py-3 rounded-xl hover:bg-blue-700 transition-colors w-fit">
                            Petunjuk Arah <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                    <!-- Peta -->
                    <div class="md:w-2/3 h-64 md:h-auto grayscale hover:grayscale-0 transition-all duration-700">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127504.42574883445!2d114.50912188448835!3d-3.321683935292419!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dee3f3f3f3f3f3f%3A0x3f3f3f3f3f3f3f3f!2sBanjarmasin!5e0!3m2!1sid!2sid!4v1620000000000!5m2!1sid!2sid" 
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>

        </div> <!-- Tutup Pembungkus Utama (max-w-7xl) -->
    </div> <!-- Tutup div py-8 -->

    

    <style>
        /* KEYFRAME ANIMATIONS */
        @keyframes gradient-xy {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        .animate-gradient-xy {
            background-size: 400% 400%;
            animation: gradient-xy 15s ease infinite;
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Wishlist Toggle Concept */
        #wishlist-toggle {
            transform: translateX(calc(100% - 60px));
            transition: transform 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        #wishlist-toggle:hover {
            transform: translateX(0);
        }
    </style>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XampUtama\htdocs\handphone\resources\views/user/dashboard.blade.php ENDPATH**/ ?>