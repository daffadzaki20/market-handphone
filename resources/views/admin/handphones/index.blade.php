@extends('layouts.app_admin')

@section('title', 'Data Handphone Admin')

@section('content')
<div class="space-y-6">
    <section class="card p-5 rounded-xl">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-xl font-bold text-[var(--mh-text)]">Data Handphone</h2>
                <p class="text-sm text-[var(--mh-muted)] mt-1">Kelola produk handphone untuk katalog marketplace.</p>
            </div>
            <a href="/admin/handphones/create" class="inline-flex items-center justify-center px-4 py-2 rounded-lg btn-primary hover:bg-[var(--mh-primary-600)] transition">
                + Tambah Handphone
            </a>
        </div>

        @if(session('success'))
            <div class="mt-4 rounded-lg bg-green-50 border border-green-200 text-green-700 px-4 py-3 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <form method="GET" action="/admin/handphones" class="mt-5 grid grid-cols-1 md:grid-cols-3 gap-3">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nama handphone..."
                class="w-full border border-[var(--mh-border)] rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[var(--mh-primary)] focus:outline-none"
            >

            <select
                name="brand_id"
                class="w-full border border-[var(--mh-border)] rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[var(--mh-primary)] focus:outline-none"
            >
                <option value="">Semua brand</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}" {{ (string) request('brand_id') === (string) $brand->id ? 'selected' : '' }}>
                        {{ $brand->name }}
                    </option>
                @endforeach
            </select>

            <button class="w-full md:w-auto inline-flex items-center justify-center px-4 py-2 rounded-lg border border-[var(--mh-border)] text-[var(--mh-muted)] hover:bg-[var(--mh-surface-hover)] transition">
                Filter
            </button>
        </form>
    </section>

    <section class="card p-5 rounded-xl">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="text-left border-b border-[var(--mh-border)] text-[var(--mh-muted)]">
                        <th class="py-3 pr-3">Nama</th>
                        <th class="py-3 pr-3">Brand</th>
                        <th class="py-3 pr-3">Harga</th>
                        <th class="py-3 pr-3">Stok</th>
                        <th class="py-3 pr-3">RAM / Storage</th>
                        <th class="py-3 pr-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr class="border-b border-[var(--mh-border)] last:border-b-0">
                            <td class="py-3 pr-3 font-medium text-[var(--mh-text)]">{{ $product->name }}</td>
                            <td class="py-3 pr-3 text-[var(--mh-muted)]">{{ $product->brand?->name ?? '-' }}</td>
                            <td class="py-3 pr-3 text-[var(--mh-muted)]">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="py-3 pr-3 {{ $product->stock <= 5 ? 'text-red-500 font-semibold' : 'text-[var(--mh-muted)]' }}">{{ $product->stock }}</td>
                            <td class="py-3 pr-3 text-[var(--mh-muted)]">{{ $product->ram ?: '-' }} / {{ $product->storage ?: '-' }}</td>
                            <td class="py-3 pr-3">
                                <div class="flex items-center gap-2">
                                    <a href="/admin/handphones/{{ $product->id }}" class="px-3 py-1.5 rounded-md border border-[var(--mh-primary-600)] text-[var(--mh-primary)] hover:bg-[var(--mh-surface-hover)]">Detail</a>

                                    <a href="/admin/handphones/{{ $product->id }}/edit" class="px-3 py-1.5 rounded-md border border-[var(--mh-border)] text-[var(--mh-muted)] hover:bg-[var(--mh-surface-hover)]">Edit</a>

                                    <form action="/admin/handphones/{{ $product->id }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1.5 rounded-md border border-red-200 text-red-600 hover:bg-red-50">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-[var(--mh-muted)]">Belum ada data handphone.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </section>
</div>
@endsection
