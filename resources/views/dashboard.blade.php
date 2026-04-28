@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<!-- HERO -->
<div class="bg-white rounded-xl shadow p-10 mb-8">

    <h1 class="text-4xl font-bold mb-4">
        Selamat Datang di MyPhoneStore 📱
    </h1>

    <p class="text-gray-600 text-lg leading-relaxed">
        Marketplace terpercaya untuk kebutuhan smartphone dan aksesoris.
        Temukan berbagai produk seperti HP, casing, charger, dan perlengkapan gadget lainnya
        dengan harga terbaik.
    </p>

</div>

<!-- QUICK ACTION -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">

    <!-- HP -->
    <a href="/products/handphone"
       class="bg-white p-8 rounded-xl shadow hover:shadow-lg transition group">

        <div class="text-4xl mb-3">📱</div>

        <h2 class="text-2xl font-bold mb-2 group-hover:text-blue-600">
            Lihat Handphone
        </h2>

        <p class="text-gray-600 text-sm mb-4">
            Jelajahi berbagai smartphone mulai dari iPhone, Samsung, Xiaomi, Oppo, Vivo hingga Infinix.
        </p>

        <span class="text-blue-500 font-semibold">
            Masuk ke kategori →
        </span>

    </a>

    <!-- AKSESORIS -->
    <a href="/products/aksesoris"
       class="bg-white p-8 rounded-xl shadow hover:shadow-lg transition group">

        <div class="text-4xl mb-3">🎧</div>

        <h2 class="text-2xl font-bold mb-2 group-hover:text-blue-600">
            Lihat Aksesoris
        </h2>

        <p class="text-gray-600 text-sm mb-4">
            Temukan casing, charger, headset, tempered glass, dan berbagai aksesoris lainnya.
        </p>

        <span class="text-blue-500 font-semibold">
            Masuk ke kategori →
        </span>

    </a>

</div>

<!-- INFO SECTION -->
<div class="bg-blue-50 rounded-xl p-8">

    <h2 class="text-xl font-bold mb-2">
        💡 Tentang MyPhoneStore
    </h2>

    <p class="text-gray-700 leading-relaxed">
        MyPhoneStore dibuat untuk memberikan pengalaman belanja yang mudah dan nyaman.
        Kamu bisa memilih kategori produk dengan cepat melalui menu atau tombol di atas,
        lalu melihat detail produk sesuai kebutuhan.
    </p>

</div>

@endsection