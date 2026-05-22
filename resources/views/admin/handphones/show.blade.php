@extends('layouts.app_admin')

@section('title', 'Detail Handphone')

@section('content')
<div class="space-y-6">
    <div>
        <a href="{{ route('admin.handphones.index') }}" class="text-sm text-[var(--mh-muted)] hover:text-[var(--mh-text)]">&larr; Kembali ke Data Handphone</a>
    </div>

    <section class="card p-6 rounded-xl">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div>
                @if($product->image)
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-96 object-cover rounded-xl border border-[var(--mh-border)]">
                @else
                    <div class="w-full h-96 rounded-xl border border-dashed border-[var(--mh-border)] bg-[var(--mh-surface)] flex items-center justify-center text-[var(--mh-muted)]">
                        Tidak ada gambar
                    </div>
                @endif
            </div>

            <div class="space-y-4">
                <div>
                    <p class="text-xs uppercase tracking-wider text-[var(--mh-muted)]">Detail Produk Handphone</p>
                    <h2 class="text-2xl font-bold text-[var(--mh-text)] mt-1">{{ $product->name }}</h2>
                    <p class="text-sm text-[var(--mh-muted)] mt-1">Brand: {{ $product->brand?->name ?? 'Tanpa brand' }}</p>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div class="rounded-lg border border-[var(--mh-border)] p-3">
                        <p class="text-xs text-[var(--mh-muted)]">Harga</p>
                        <p class="font-bold text-[var(--mh-text)] mt-1">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>

                    <div class="rounded-lg border border-[var(--mh-border)] p-3">
                        <p class="text-xs text-[var(--mh-muted)]">Stok</p>
                        <p class="font-bold mt-1 {{ $product->stock <= 5 ? 'text-red-500' : 'text-[var(--mh-text)]' }}">{{ $product->stock }} pcs</p>
                    </div>

                    <div class="rounded-lg border border-[var(--mh-border)] p-3">
                        <p class="text-xs text-[var(--mh-muted)]">RAM</p>
                        <p class="font-semibold text-[var(--mh-text)] mt-1">{{ $product->ram ?: '-' }}</p>
                    </div>

                    <div class="rounded-lg border border-[var(--mh-border)] p-3">
                        <p class="text-xs text-[var(--mh-muted)]">Storage</p>
                        <p class="font-semibold text-[var(--mh-text)] mt-1">{{ $product->storage ?: '-' }}</p>
                    </div>

                    <div class="rounded-lg border border-[var(--mh-border)] p-3 col-span-2">
                        <p class="text-xs text-[var(--mh-muted)]">Battery</p>
                        <p class="font-semibold text-[var(--mh-text)] mt-1">{{ $product->battery ?: '-' }}</p>
                    </div>
                </div>

                <div class="rounded-lg border border-[var(--mh-border)] p-3">
                    <p class="text-xs text-[var(--mh-muted)]">Deskripsi</p>
                    <p class="text-[var(--mh-text)] mt-2">{{ $product->description ?: '-' }}</p>
                </div>

                <div class="rounded-lg border border-[var(--mh-border)] p-3">
                    <p class="text-xs text-[var(--mh-muted)]">Metadata</p>
                    <p class="text-sm text-[var(--mh-text)] mt-1">Dibuat: {{ $product->created_at?->format('d M Y H:i') }}</p>
                    <p class="text-sm text-[var(--mh-text)]">Diupdate: {{ $product->updated_at?->format('d M Y H:i') }}</p>
                </div>

                <div class="flex items-center gap-2 pt-1">
                    <a href="{{ route('admin.handphones.edit', $product->id) }}" class="px-4 py-2 rounded-lg btn-primary hover:bg-[var(--mh-primary-600)] transition">Edit Produk</a>

                    <form action="{{ route('admin.handphones.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 rounded-lg border border-red-200 text-red-600 hover:bg-red-50 transition">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
