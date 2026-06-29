@extends('layouts.app_admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="space-y-8 animate-in fade-in duration-500">

    <!-- HERO SECTION -->
    <section class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-700 p-8 shadow-lg">

        <!-- Glow Background -->
        <div class="absolute top-0 left-0 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-72 h-72 bg-cyan-300/10 rounded-full blur-3xl"></div>

        <div class="relative z-10">
            <p class="text-blue-200 font-medium tracking-wide uppercase text-xs">
                Ringkasan Sistem
            </p>

            <h2 class="text-3xl md:text-4xl font-black mt-2 text-white italic">
                Halo, {{ Auth::user()->name }}! 👋
            </h2>

            <p class="text-blue-100 mt-2 max-w-2xl">
                Pantau performa produk, stok, dan aktivitas toko Anda secara real-time dari satu dashboard terpusat.
            </p>
        </div>

        <!-- Decorative Circle -->
        <div class="absolute top-0 right-0 -mt-4 -mr-4 h-40 w-40 bg-white/10 rounded-full blur-3xl"></div>
    </section>

    <!-- STATS -->
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @php
            $stats = [
                ['label' => 'Total Produk', 'value' => $totalProducts, 'icon' => '📦'],
                ['label' => 'Total Brand', 'value' => $totalBrands, 'icon' => '🏷️'],
                ['label' => 'Total User', 'value' => $totalUsers, 'icon' => '👥'],
                ['label' => 'Nilai Inventori', 'value' => 'Rp ' . number_format($totalInventoryValue, 0, ',', '.'), 'icon' => '💰'],
            ];
        @endphp

        @foreach($stats as $stat)
        <article class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow group">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-slate-500">
                    {{ $stat['label'] }}
                </p>

                <span class="text-2xl group-hover:scale-110 transition-transform">
                    {{ $stat['icon'] }}
                </span>
            </div>

            <p class="text-2xl font-bold text-slate-900 mt-3">
                {{ $stat['value'] }}
            </p>
        </article>
        @endforeach
    </section>

    <!-- MAIN CONTENT -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- LEFT SIDE -->
        <div class="lg:col-span-1 space-y-6">

            <!-- CATEGORY -->
            <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm">

                <h3 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-4">
                    Sebaran Kategori
                </h3>

                <div class="space-y-4">

                    <div class="flex items-center justify-between p-3 bg-slate-50 rounded-xl">
                        <span class="text-sm text-slate-700 font-medium">
                            📱 Handphone
                        </span>

                        <span class="px-3 py-1 bg-white rounded-lg shadow-sm text-indigo-600 font-bold">
                            {{ $handphoneCount }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-slate-50 rounded-xl">
                        <span class="text-sm text-slate-700 font-medium">
                            🎧 Aksesoris
                        </span>

                        <span class="px-3 py-1 bg-white rounded-lg shadow-sm text-indigo-600 font-bold">
                            {{ $accessoriesCount }}
                        </span>
                    </div>

                </div>

                <!-- STOCK -->
                <div class="mt-6 pt-6 border-t border-dashed border-slate-200">

                    <p class="text-sm text-slate-500 mb-2">
                        Status Stok
                    </p>

                    <div class="flex items-end justify-between">
                        <h4 class="text-4xl font-black text-red-500">
                            {{ $lowStockProducts->count() }}
                        </h4>

                        <span class="text-xs text-red-400 mb-1 font-medium">
                            Produk Kritis
                        </span>
                    </div>

                    <div class="w-full bg-slate-100 h-2 rounded-full mt-3 overflow-hidden">
                        <div
                            class="bg-red-500 h-full"
                            style="width: {{ ($lowStockProducts->count() / max($totalProducts, 1)) * 100 }}%">
                        </div>
                    </div>

                </div>
            </div>

            <!-- QUICK ACTION -->
            <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm">

                <h3 class="text-sm font-bold text-slate-900 mb-4">
                    Aksi Cepat
                </h3>

                <div class="grid grid-cols-1 gap-3">

                    <a href="{{ route('admin.handphones.index') }}"
                       class="flex items-center gap-3 p-3 rounded-xl border border-slate-50 hover:bg-indigo-50 hover:border-indigo-100 transition group">

                        <div class="w-10 h-10 rounded-lg bg-indigo-100 flex items-center justify-center group-hover:bg-indigo-600 group-hover:text-white transition">
                            📱
                        </div>

                        <div>
                            <p class="text-sm font-bold text-slate-800">
                                Kelola HP
                            </p>

                            <p class="text-[10px] text-slate-500 italic">
                                Atur katalog smartphone
                            </p>
                        </div>
                    </a>

                    <a href="{{ route('admin.aksesoris.index') }}"
                       class="flex items-center gap-3 p-3 rounded-xl border border-slate-50 hover:bg-emerald-50 hover:border-emerald-100 transition group">

                        <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition">
                            🔌
                        </div>

                        <div>
                            <p class="text-sm font-bold text-slate-800">
                                Kelola Aksesoris
                            </p>

                            <p class="text-[10px] text-slate-500 italic">
                                Atur perlengkapan
                            </p>
                        </div>
                    </a>

                </div>
            </div>
        </div>

        <!-- RIGHT SIDE -->
        <div class="lg:col-span-2">

            <article class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden h-full">

                <!-- HEADER -->
                <div class="p-6 border-b border-slate-50 flex items-center justify-between bg-white">

                    <div>
                        <h3 class="text-lg font-bold text-slate-900">
                            📦 Produk Terbaru
                        </h3>

                        <p class="text-xs text-slate-500">
                            Update inventori terakhir
                        </p>
                    </div>

                    <a href="{{ route('handphone.index') }}"
                       class="inline-flex items-center gap-2 text-xs font-bold text-indigo-600 hover:bg-indigo-50 px-4 py-2 rounded-lg transition">

                        Lihat Semua
                        <span class="text-lg">→</span>
                    </a>
                </div>

                <!-- TABLE -->
                <div class="overflow-x-auto">

                    <table class="min-w-full">

                        <thead>
                            <tr class="bg-slate-50/50 text-left text-[10px] uppercase tracking-widest text-slate-400">
                                <th class="px-6 py-4 font-semibold">Produk</th>
                                <th class="px-6 py-4 font-semibold">Kategori</th>
                                <th class="px-6 py-4 font-semibold">Harga</th>
                                <th class="px-6 py-4 font-semibold text-center">Stok</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-50">

                            @forelse($latestProducts as $product)

                            <tr class="hover:bg-slate-50/80 transition-colors">

                                <td class="px-6 py-4">
                                    <p class="font-bold text-slate-800 leading-none">
                                        {{ $product->name }}
                                    </p>

                                    <p class="text-[10px] text-slate-400 mt-1 uppercase tracking-tighter">
                                        {{ $product->brand?->name ?? 'No Brand' }}
                                    </p>
                                </td>

                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 rounded-md text-[10px] font-bold uppercase
                                        {{ ($product->brand?->type ?? '') == 'hp'
                                            ? 'bg-blue-50 text-blue-600'
                                            : 'bg-purple-50 text-purple-600' }}">

                                        {{ ($product->brand?->type ?? '') == 'hp'
                                            ? 'Handphone'
                                            : 'Aksesoris' }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 font-medium text-slate-700">
                                    Rp{{ number_format($product->price, 0, ',', '.') }}
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full font-bold text-xs
                                        {{ $product->stock <= 5
                                            ? 'bg-red-50 text-red-600 ring-2 ring-red-100'
                                            : 'bg-slate-50 text-slate-600' }}">

                                        {{ $product->stock }}
                                    </span>
                                </td>

                            </tr>

                            @empty

                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">

                                    <div class="flex flex-col items-center justify-center opacity-40">

                                        <span class="text-4xl mb-2">
                                            📁
                                        </span>

                                        <p class="text-sm font-medium text-slate-500">
                                            Belum ada data produk tersedia.
                                        </p>

                                    </div>

                                </td>
                            </tr>

                            @endforelse

                        </tbody>

                    </table>
                </div>
            </article>
        </div>
    </div>
</div>
@endsection
