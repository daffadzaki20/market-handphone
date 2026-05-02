@extends('layouts.app_admin')

@section('title', 'Dashboard Admin')

@section('content')

<div class="space-y-6">

    <section class="rounded-2xl bg-white border border-[var(--mh-border)] p-6 md:p-8 shadow-sm">
        <p class="text-sm text-[var(--mh-muted)]">Selamat datang kembali</p>
        <h2 class="text-2xl md:text-3xl font-extrabold mt-1 text-slate-900">{{ Auth::user()->name }}</h2>
        <p class="text-slate-600 mt-2">Pantau performa produk, stok, dan aktivitas toko dari satu halaman.</p>
    </section>

    <section class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
        <article class="bg-white border border-[var(--mh-border)] rounded-xl p-5 shadow-sm">
            <p class="text-sm text-slate-500">Total Produk</p>
            <p class="text-3xl font-extrabold text-[var(--mh-primary)] mt-2">{{ $totalProducts }}</p>
        </article>

        <article class="bg-white border border-[var(--mh-border)] rounded-xl p-5 shadow-sm">
            <p class="text-sm text-slate-500">Total Brand</p>
            <p class="text-3xl font-extrabold text-[var(--mh-primary)] mt-2">{{ $totalBrands }}</p>
        </article>

        <article class="bg-white border border-[var(--mh-border)] rounded-xl p-5 shadow-sm">
            <p class="text-sm text-slate-500">Total User</p>
            <p class="text-3xl font-extrabold text-[var(--mh-primary)] mt-2">{{ $totalUsers }}</p>
        </article>

        <article class="bg-white border border-[var(--mh-border)] rounded-xl p-5 shadow-sm">
            <p class="text-sm text-slate-500">Nilai Inventori</p>
            <p class="text-2xl font-extrabold text-[var(--mh-primary)] mt-2">Rp {{ number_format($totalInventoryValue, 0, ',', '.') }}</p>
        </article>
    </section>

    <section class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <article class="bg-white border border-[var(--mh-border)] rounded-xl p-5 shadow-sm">
            <p class="text-sm text-slate-500">Kategori Handphone</p>
            <p class="text-3xl font-bold text-[var(--mh-primary)] mt-2">{{ $handphoneCount }}</p>
        </article>

        <article class="bg-white border border-[var(--mh-border)] rounded-xl p-5 shadow-sm">
            <p class="text-sm text-slate-500">Kategori Aksesoris</p>
            <p class="text-3xl font-bold text-[var(--mh-primary)] mt-2">{{ $accessoriesCount }}</p>
        </article>

        <article class="bg-white border border-[var(--mh-border)] rounded-xl p-5 shadow-sm">
            <p class="text-sm text-slate-500">Status Stok</p>
            <p class="text-3xl font-bold text-red-500 mt-2">{{ $lowStockProducts->count() }}</p>
            <p class="text-xs text-slate-500 mt-1">Produk stok menipis (<= 5)</p>
        </article>
    </section>

    <section class="grid grid-cols-1 xl:grid-cols-2 gap-6">
        <article class="bg-white border border-[var(--mh-border)] rounded-xl p-5 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-slate-900">Stok Menipis</h3>
                <span class="text-xs px-2 py-1 rounded-full bg-red-50 text-red-600">Perlu restock</span>
            </div>

            @if($lowStockProducts->isEmpty())
                <p class="text-sm text-slate-500">Semua stok produk aman.</p>
            @else
                <div class="space-y-3">
                    @foreach($lowStockProducts as $product)
                        <div class="border border-[var(--mh-border)] rounded-lg p-3 flex items-center justify-between bg-[var(--mh-surface)]">
                            <div>
                                <p class="font-semibold text-slate-800">{{ $product->name }}</p>
                                <p class="text-xs text-slate-500">{{ $product->brand?->name ?? 'Tanpa brand' }}</p>
                            </div>
                            <span class="text-sm font-bold text-red-500">{{ $product->stock }} pcs</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </article>

        <article class="bg-white border border-[var(--mh-border)] rounded-xl p-5 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-slate-900">Aksi Cepat</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <a href="/admin/handphones" class="rounded-lg border border-[var(--mh-border)] p-4 hover:bg-[var(--mh-surface-hover)] transition">
                    <p class="font-semibold text-slate-800">Kelola Handphone</p>
                    <p class="text-xs text-slate-500 mt-1">Lihat produk kategori HP</p>
                </a>

                <a href="/admin/aksesoris" class="rounded-lg border border-[var(--mh-border)] p-4 hover:bg-[var(--mh-surface-hover)] transition">
                    <p class="font-semibold text-slate-800">Kelola Aksesoris</p>
                    <p class="text-xs text-slate-500 mt-1">Lihat produk kategori aksesoris</p>
                </a>

                <a href="/admin/users" class="rounded-lg border border-[var(--mh-border)] p-4 hover:bg-[var(--mh-surface-hover)] transition">
                    <p class="font-semibold text-slate-800">Kelola Data User</p>
                    <p class="text-xs text-slate-500 mt-1">Atur akun dan role user</p>
                </a>

                <a href="/logout" class="rounded-lg border border-[var(--mh-border)] p-4 hover:bg-[var(--mh-surface-hover)] transition">
                    <p class="font-semibold text-slate-800">Logout Admin</p>
                    <p class="text-xs text-slate-500 mt-1">Akhiri sesi admin saat ini</p>
                </a>
            </div>
        </article>
    </section>

    <section class="bg-white border border-[var(--mh-border)] rounded-xl p-5 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-slate-900">Produk Terbaru</h3>
            <a href="/products/handphone" class="text-sm text-[var(--mh-primary)] hover:text-[var(--mh-primary-600)]">Lihat katalog</a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="text-left border-b border-[var(--mh-border)] text-[var(--mh-muted)]">
                        <th class="py-3 pr-3">Nama</th>
                        <th class="py-3 pr-3">Brand</th>
                        <th class="py-3 pr-3">Kategori</th>
                        <th class="py-3 pr-3">Harga</th>
                        <th class="py-3 pr-3">Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($latestProducts as $product)
                        <tr class="border-b border-[var(--mh-border)] last:border-b-0">
                            <td class="py-3 pr-3 font-medium text-slate-800">{{ $product->name }}</td>
                            <td class="py-3 pr-3 text-slate-600">{{ $product->brand?->name ?? 'Tanpa brand' }}</td>
                            <td class="py-3 pr-3 text-slate-600">{{ ($product->brand?->type ?? '') == 'hp' ? 'Handphone' : 'Aksesoris' }}</td>
                            <td class="py-3 pr-3 text-slate-600">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="py-3 pr-3 {{ $product->stock <= 5 ? 'text-red-500 font-semibold' : 'text-slate-600' }}">{{ $product->stock }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-4 text-center text-slate-500">Belum ada produk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

</div>

@endsection