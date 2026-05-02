@extends('layouts.app_admin')

@section('title', 'Tambah Aksesoris')

@section('content')
<div class="max-w-4xl mx-auto">
    <section class="card p-6 rounded-xl">
        <div class="mb-6">
            <h2 class="text-xl font-bold text-[var(--mh-text)]">Tambah Aksesoris</h2>
            <p class="text-sm text-[var(--mh-muted)] mt-1">Isi form berikut untuk menambahkan produk aksesoris baru.</p>
        </div>

        <form action="/admin/aksesoris" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            @include('admin.aksesoris.partials.form', [
                'product' => null,
                'brands' => $brands,
            ])

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="px-4 py-2 rounded-lg btn-primary hover:bg-[var(--mh-primary-600)] transition">Simpan</button>
                <a href="/admin/aksesoris" class="px-4 py-2 rounded-lg border border-[var(--mh-border)] text-[var(--mh-muted)] hover:bg-[var(--mh-surface-hover)] transition">Batal</a>
            </div>
        </form>
    </section>
</div>
@endsection
