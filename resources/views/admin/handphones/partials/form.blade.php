<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-[var(--mh-text)] mb-1">Nama Produk</label>
        <input
            type="text"
            name="name"
            value="{{ old('name', $product?->name) }}"
            class="w-full border border-[var(--mh-border)] rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[var(--mh-primary)] focus:outline-none"
            required
        >
        @error('name')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-[var(--mh-text)] mb-1">Brand</label>
        <select
            name="brand_id"
            class="w-full border border-[var(--mh-border)] rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[var(--mh-primary)] focus:outline-none"
            required
        >
            <option value="">Pilih brand</option>
            @foreach($brands as $brand)
                <option value="{{ $brand->id }}" {{ (string) old('brand_id', $product?->brand_id) === (string) $brand->id ? 'selected' : '' }}>
                    {{ $brand->name }}
                </option>
            @endforeach
        </select>
        @error('brand_id')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-[var(--mh-text)] mb-1">Harga</label>
        <input
            type="number"
            name="price"
            value="{{ old('price', $product?->price) }}"
            class="w-full border border-[var(--mh-border)] rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[var(--mh-primary)] focus:outline-none"
            min="0"
            required
        >
        @error('price')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-[var(--mh-text)] mb-1">Stok</label>
        <input
            type="number"
            name="stock"
            value="{{ old('stock', $product?->stock) }}"
            class="w-full border border-[var(--mh-border)] rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[var(--mh-primary)] focus:outline-none"
            min="0"
            required
        >
        @error('stock')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-[var(--mh-text)] mb-1">RAM</label>
        <input
            type="text"
            name="ram"
            value="{{ old('ram', $product?->ram) }}"
            class="w-full border border-[var(--mh-border)] rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[var(--mh-primary)] focus:outline-none"
            placeholder="Contoh: 8 GB"
        >
        @error('ram')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-[var(--mh-text)] mb-1">Storage</label>
        <input
            type="text"
            name="storage"
            value="{{ old('storage', $product?->storage) }}"
            class="w-full border border-[var(--mh-border)] rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[var(--mh-primary)] focus:outline-none"
            placeholder="Contoh: 256 GB"
        >
        @error('storage')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-[var(--mh-text)] mb-1">Battery</label>
        <input
            type="text"
            name="battery"
            value="{{ old('battery', $product?->battery) }}"
            class="w-full border border-[var(--mh-border)] rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[var(--mh-primary)] focus:outline-none"
            placeholder="Contoh: 5000 mAh"
        >
        @error('battery')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-[var(--mh-text)] mb-1">Deskripsi</label>
        <textarea
            name="description"
            rows="4"
            class="w-full border border-[var(--mh-border)] rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[var(--mh-primary)] focus:outline-none"
            placeholder="Deskripsi handphone"
        >{{ old('description', $product?->description) }}</textarea>
        @error('description')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-[var(--mh-text)] mb-1">Gambar Produk</label>
        <input
            type="file"
            name="image"
            accept=".jpg,.jpeg,.png,.webp"
            class="w-full border border-[var(--mh-border)] rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[var(--mh-primary)] focus:outline-none"
        >
        <p class="text-xs text-[var(--mh-muted)] mt-1">Maksimal 2MB. Format: jpg, jpeg, png, webp.</p>
        @error('image')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror

        @if($product?->image)
                <div class="mt-3">
                <p class="text-xs text-[var(--mh-muted)] mb-2">Gambar saat ini:</p>
                <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}" class="w-24 h-24 object-cover rounded-lg border border-[var(--mh-border)]">
            </div>
        @endif
    </div>
</div>
