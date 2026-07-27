@extends('layouts.app')

@section('content')
<div class="min-h-[60vh] flex items-center justify-center px-4 py-12">
    <div class="bg-white p-8 md:p-12 rounded-3xl shadow-sm border border-gray-100 text-center max-w-lg w-full relative overflow-hidden">
        
        <!-- Hiasan Background -->
        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-orange-400 to-orange-500"></div>

        <!-- Ikon Sukses Animasi -->
        <div class="w-24 h-24 bg-green-100 text-green-500 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner">
            <svg class="w-12 h-12 animate-[bounce_1s_ease-in-out_infinite]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        
        <h1 class="text-2xl md:text-3xl font-black text-gray-800 mb-3">Pembayaran Berhasil!</h1>
        <p class="text-gray-500 text-sm md:text-base leading-relaxed mb-10">
            Hore! Pesanan Anda telah berhasil dibuat dan pembayaran telah diterima. Mohon pantau selalu perjalanan paket Anda melalui menu pesanan.
        </p>
        
        <!-- Tombol Aksi -->
        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ route('profile.orders') }}" class="w-full sm:w-1/2 bg-orange-500 hover:bg-orange-600 text-white font-bold py-3.5 px-6 rounded-xl transition shadow-lg shadow-orange-200 flex items-center justify-center gap-2">
                Ok
            </a>
            <a href="{{ url('/') }}" class="w-full sm:w-1/2 bg-white hover:bg-gray-50 text-gray-700 border border-gray-200 font-bold py-3.5 px-6 rounded-xl transition shadow-sm flex items-center justify-center gap-2">
                Lanjut Belanja
            </a>
        </div>

    </div>
</div>
@endsection