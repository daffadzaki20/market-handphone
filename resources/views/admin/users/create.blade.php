@extends('layouts.app_admin')

@section('title', 'Tambah User')

@section('content')
<div class="max-w-3xl mx-auto">
    <section class="card p-6 rounded-xl">
        <div class="mb-6">
            <h2 class="text-xl font-bold text-[var(--mh-text)]">Tambah User</h2>
            <p class="text-sm text-[var(--mh-muted)] mt-1">Buat akun user baru dari panel admin.</p>
        </div>

        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-5">
            @csrf

            @include('admin.users.partials.form', [
                'user' => null,
                'isEdit' => false,
            ])

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="px-4 py-2 rounded-lg btn-primary hover:bg-[var(--mh-primary-600)] transition">Simpan</button>
                <a href="{{ route('admin.users.index') }}" class="px-4 py-2 rounded-lg border border-[var(--mh-border)] text-[var(--mh-muted)] hover:bg-[var(--mh-surface-hover)] transition">Batal</a>
            </div>
        </form>
    </section>
</div>
@endsection
