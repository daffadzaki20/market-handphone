@extends('layouts.app_admin')

@section('title', 'Edit User')

@section('content')
<div class="max-w-3xl mx-auto">
    <section class="card p-6 rounded-xl">
        <div class="mb-6">
            <h2 class="text-xl font-bold text-[var(--mh-text)]">Edit User</h2>
            <p class="text-sm text-[var(--mh-muted)] mt-1">Perbarui data akun user.</p>
        </div>

        <form action="/admin/users/{{ $user->id }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            @include('admin.users.partials.form', [
                'user' => $user,
                'isEdit' => true,
            ])

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="px-4 py-2 rounded-lg btn-primary hover:bg-[var(--mh-primary-600)] transition">Update</button>
                <a href="/admin/users" class="px-4 py-2 rounded-lg border border-[var(--mh-border)] text-[var(--mh-muted)] hover:bg-[var(--mh-surface-hover)] transition">Batal</a>
            </div>
        </form>
    </section>
</div>
@endsection
