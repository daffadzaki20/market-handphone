@extends('layouts.app_admin')

@section('title', 'Data User Admin')

@section('content')
<div class="space-y-6">
    <section class="card p-5 rounded-xl">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-xl font-bold text-[var(--mh-text)]">Data User</h2>
                <p class="text-sm text-[var(--mh-muted)] mt-1">Kelola akun user dari panel admin.</p>
            </div>
            <a href="{{ route('admin.users.create') }}" class="inline-flex items-center justify-center px-4 py-2 rounded-lg btn-primary hover:bg-[var(--mh-primary-600)] transition">
                + Tambah User
            </a>
        </div>

        @if(session('success'))
            <div class="mt-4 rounded-lg bg-blue-50 border border-blue-200 text-[var(--mh-primary-600)] px-4 py-3 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <form method="GET" action="{{ route('admin.users.index') }}" class="mt-5 grid grid-cols-1 md:grid-cols-3 gap-3">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nama, username, atau email..."
                class="w-full border border-[var(--mh-border)] rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[var(--mh-primary)] focus:outline-none"
            >

            <select
                name="role"
                class="w-full border border-[var(--mh-border)] rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[var(--mh-primary)] focus:outline-none"
            >
                <option value="">Semua role</option>
                <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ request('role') === 'user' ? 'selected' : '' }}>User</option>
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
                        <th class="py-3 pr-3">Username</th>
                        <th class="py-3 pr-3">Email</th>
                        <th class="py-3 pr-3">Role</th>
                        <th class="py-3 pr-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr class="border-b border-[var(--mh-border)] last:border-b-0">
                            <td class="py-3 pr-3 font-medium text-[var(--mh-text)]">{{ $user->name }}</td>
                            <td class="py-3 pr-3 text-[var(--mh-muted)]">{{ $user->username }}</td>
                            <td class="py-3 pr-3 text-[var(--mh-muted)]">{{ $user->email }}</td>
                            <td class="py-3 pr-3">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $user->role === 'admin' ? 'bg-[var(--mh-primary)] text-blue-500' : 'bg-[var(--mh-primary-soft)] text-[var(--mh-primary)]' }}">
                                    {{ strtoupper($user->role) }}
                                </span>
                            </td>
                            <td class="py-3 pr-3">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="px-3 py-1.5 rounded-md border border-[var(--mh-border)] text-[var(--mh-muted)] hover:bg-[var(--mh-surface-hover)]">Edit</a>

                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus user ini?')">
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
                            <td colspan="5" class="py-8 text-center text-[var(--mh-muted)]">Belum ada data user.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </section>
</div>
@endsection
