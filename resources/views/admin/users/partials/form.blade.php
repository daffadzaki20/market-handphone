<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium text-[var(--mh-text)] mb-1">Nama</label>
        <input
            type="text"
            name="name"
            value="{{ old('name', $user?->name) }}"
            class="w-full border border-[var(--mh-border)] rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[var(--mh-primary)] focus:outline-none"
            required
        >
        @error('name')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-[var(--mh-text)] mb-1">Username</label>
        <input
            type="text"
            name="username"
            value="{{ old('username', $user?->username) }}"
            class="w-full border border-[var(--mh-border)] rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[var(--mh-primary)] focus:outline-none"
            required
        >
        @error('username')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-[var(--mh-text)] mb-1">Email</label>
        <input
            type="email"
            name="email"
            value="{{ old('email', $user?->email) }}"
            class="w-full border border-[var(--mh-border)] rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[var(--mh-primary)] focus:outline-none"
            required
        >
        @error('email')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-[var(--mh-text)] mb-1">Role</label>
        <select
            name="role"
            class="w-full border border-[var(--mh-border)] rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[var(--mh-primary)] focus:outline-none"
            required
        >
            <option value="user" {{ old('role', $user?->role ?? 'user') === 'user' ? 'selected' : '' }}>User</option>
            <option value="admin" {{ old('role', $user?->role) === 'admin' ? 'selected' : '' }}>Admin</option>
        </select>
        @error('role')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-[var(--mh-text)] mb-1">Password {{ $isEdit ? '(kosongkan jika tidak diubah)' : '' }}</label>
        <input
            type="password"
            name="password"
            class="w-full border border-[var(--mh-border)] rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[var(--mh-primary)] focus:outline-none"
            {{ $isEdit ? '' : 'required' }}
        >
        @error('password')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>
</div>
