@extends('layouts.app_admin')

@section('title', 'Edit Aksesoris')

@section('content')
<div class="max-w-4xl mx-auto">
    <section class="card p-6 rounded-xl">
        <div class="mb-6">
            <h2 class="text-xl font-bold text-[var(--mh-text)]">Edit Aksesoris</h2>
            <p class="text-sm text-[var(--mh-muted)] mt-1">Perbarui data produk aksesoris yang dipilih.</p>
        </div>

        <form action="/admin/aksesoris/{{ $product->id }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            @include('admin.aksesoris.partials.form', [
                'product' => $product,
                'brands' => $brands,
            ])

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="px-4 py-2 rounded-lg btn-primary hover:bg-[var(--mh-primary-600)] transition">Update</button>
                <a href="/admin/aksesoris" class="px-4 py-2 rounded-lg border border-[var(--mh-border)] text-[var(--mh-muted)] hover:bg-[var(--mh-surface-hover)] transition">Batal</a>
            </div>
        </form>
    </section>
</div>
@endsection
