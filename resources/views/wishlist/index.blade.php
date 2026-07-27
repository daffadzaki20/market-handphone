{{-- resources/views/wishlist/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <h1 class="text-3xl font-black text-gray-800 tracking-tight mb-6">💗 Wishlist Saya</h1>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse ($wishlists as $item)
            @php $product = $item->product; @endphp
            <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl border border-gray-100 transition-all duration-300 overflow-hidden group flex flex-col relative">

                <a href="{{ route('product.show', $product->id) }}" class="flex flex-col flex-grow">
                    <div class="h-48 bg-gray-50 flex items-center justify-center overflow-hidden relative">
                        @if($product->image)
                            <img src="{{ $product->image_url }}"
                                 alt="{{ $product->name }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @else
                            <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        @endif
                    </div>

                    <div class="p-4 flex flex-col flex-grow">
                        <div class="text-xs font-bold text-blue-600 uppercase tracking-wider mb-1">
                            {{ $product->brand->name ?? 'Tanpa Brand' }}
                        </div>
                        <h2 class="font-bold text-gray-800 text-base line-clamp-2 mb-2">{{ $product->name }}</h2>
                        <p class="text-gray-900 font-black text-lg mb-2 mt-auto">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>
                    </div>
                </a>

                <!-- HAPUS DARI WISHLIST -->
                <form action="{{ route('wishlist.destroy', $product->id) }}" method="POST" class="absolute top-2 right-2 z-10">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-white/90 hover:bg-white p-2 rounded-full shadow-md transition-transform hover:scale-110">
                        <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                        </svg>
                    </button>
                </form>
            </div>
        @empty
            <div class="col-span-full py-16 flex flex-col items-center justify-center text-gray-500 bg-white rounded-2xl border border-gray-200 border-dashed">
                <svg class="w-16 h-16 mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                <h3 class="text-lg font-bold text-gray-800">Wishlist Kosong</h3>
                <p class="mt-1">Yuk tambahkan produk favoritmu ke wishlist.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-10">
        {{ $wishlists->links() }}
    </div>
</div>
@endsection