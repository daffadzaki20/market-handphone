@extends('layouts.app')
@section('content')
    <div class="max-w-4xl mx-auto px-4 py-8 relative min-h-screen">
        <h1 class="text-3xl font-black mb-8 text-gray-800 flex items-center gap-3">
            🛒 Keranjang Belanja
        </h1>

        <!-- Alert Notifikasi -->
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 shadow-sm flex items-center gap-2 animate-fade-in-up">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6 shadow-sm flex items-center gap-2 animate-fade-in-up">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                {{ session('error') }}
            </div>
        @endif

        @if($cartItems->isEmpty())
            <!-- Tampilan Keranjang Kosong -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-12 text-center mt-10">
                <div class="bg-gray-50 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6 text-5xl shadow-inner">
                    🛒
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Keranjangmu masih kosong</h2>
                <p class="text-gray-500 mb-6">Yuk, temukan gadget impianmu sekarang!</p>
                <a href="{{ route('handphone.index') }}" class="inline-block bg-orange-500 hover:bg-orange-600 shadow-lg shadow-orange-200 text-white font-bold py-3 px-8 rounded-xl transition-transform hover:-translate-y-1">
                    Mulai Belanja
                </a>
            </div>
        @else
            <!-- Kontrol Pilih Semua & Hapus -->
            <div class="mb-4 flex justify-between items-center bg-white p-4 rounded-2xl shadow-sm border border-gray-100">
                <label class="flex items-center gap-3 cursor-pointer group">
                    <input type="checkbox" id="select-all" class="w-5 h-5 rounded border-gray-300 text-orange-500 focus:ring-orange-500 cursor-pointer">
                    <span class="text-sm font-bold text-gray-700 group-hover:text-orange-500 transition-colors">Pilih Semua</span>
                </label>
                <button id="delete-selected" class="text-sm font-bold text-red-500 hover:text-red-600 transition-colors hidden flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    Hapus Terpilih (<span id="selected-count">0</span>)
                </button>
            </div>

            <!-- Daftar Produk -->
            <div class="space-y-4 mb-8">
                @foreach($cartItems as $item)
                    <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 flex items-center gap-4 transition-all hover:border-orange-300 hover:shadow-md cart-item" 
                         data-id="{{ $item->id }}" 
                         data-price="{{ $item->product->price ?? 0 }}">
                        
                        <!-- Checkbox Barang -->
                        <input type="checkbox" class="item-checkbox w-5 h-5 rounded border-gray-300 text-orange-500 focus:ring-orange-500 z-10 cursor-pointer" name="selected_items[]" value="{{ $item->id }}">

                        <!-- LINK MENUJU DETAIL PRODUK -->
                        <a href="{{ $item->product ? route('product.show', $item->product->id) : '#' }}" class="flex flex-1 items-center gap-4 group">
                            <!-- Gambar Produk -->
                            <div class="w-20 h-20 bg-gray-50 rounded-xl border border-gray-100 flex items-center justify-center overflow-hidden flex-shrink-0 group-hover:opacity-80 transition-opacity">
                                <img src="{{ $item->product->image_url ?? asset('images/products/default.jpg') }}" class="w-full h-full object-contain p-1">
                            </div>

                            <!-- Detail Produk -->
                            <div class="flex-1 min-w-0">
                                <div class="text-xs font-bold text-blue-600 mb-0.5">{{ $item->product->brand->name ?? 'Unbranded' }}</div>
                                <h3 class="font-bold text-gray-800 text-sm md:text-base group-hover:text-orange-500 transition-colors truncate">
                                    {{ $item->product->name ?? 'Produk Tidak Tersedia' }}
                                </h3>
                                <p class="text-orange-500 font-black mt-1">
                                    Rp {{ number_format($item->product->price ?? 0, 0, ',', '.') }}
                                </p>
                            </div>
                        </a>

                        <!-- AKSI (Hapus & Quantity) -->
                        <div class="flex flex-col items-end gap-3 z-10">
                            <!-- Form Hapus Satuan -->
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-gray-400 hover:text-red-500 p-1 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                            
                            <!-- Kontrol Kuantitas -->
                            <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden bg-white shadow-sm">
                                <button onclick="updateQty({{ $item->id }}, -1)" class="w-8 h-8 flex items-center justify-center hover:bg-gray-100 text-gray-600 font-bold transition-colors">-</button>
                                <span id="qty-{{ $item->id }}" class="w-8 h-8 flex items-center justify-center bg-gray-50 text-sm font-bold border-x border-gray-200">{{ $item->quantity }}</span>
                                <button onclick="updateQty({{ $item->id }}, 1)" class="w-8 h-8 flex items-center justify-center hover:bg-gray-100 text-gray-600 font-bold transition-colors">+</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Spacer untuk Sticky Footer -->
            <div class="h-28"></div>

            <!-- Bagian Sticky Summary -->
            <div id="sticky-summary" class="fixed bottom-0 left-0 right-0 bg-white/90 backdrop-blur-md border-t border-gray-200 p-4 shadow-[0_-10px_20px_rgba(0,0,0,0.05)] z-50">
                <div class="max-w-4xl mx-auto flex items-center justify-between">
                    <div>
                        <p class="text-sm font-bold text-gray-500 mb-0.5">Total Belanja (<span id="total-items">0</span> produk)</p>
                        <p class="text-2xl font-black text-orange-500" id="grand-total">Rp 0</p>
                    </div>
                    <button type="button" 
                            id="btn-checkout"
                            disabled
                            class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-3.5 rounded-xl font-bold shadow-lg shadow-orange-200 transition-all disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-2">
                        Beli Sekarang
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </div>
            </div>
        @endif
    </div>

    <!-- FORM TERSEMBUNYI UNTUK BULK DELETE -->
    <form id="bulk-delete-form" action="{{ route('cart.bulk-delete') }}" method="POST" class="hidden">
        @csrf @method('DELETE')
        <div id="bulk-delete-inputs"></div>
    </form>

    <script>
        const checkboxes = document.querySelectorAll('.item-checkbox');
        const selectAll = document.getElementById('select-all');
        const grandTotalElement = document.getElementById('grand-total');
        const totalItemsElement = document.getElementById('total-items');
        const btnCheckout = document.getElementById('btn-checkout');
        const deleteSelectedBtn = document.getElementById('delete-selected');
        const selectedCountSpan = document.getElementById('selected-count');

        function calculateTotal() {
            let total = 0;
            let count = 0;
            let checkedCount = 0;
            
            checkboxes.forEach(cb => {
                if (cb.checked) {
                    const row = cb.closest('.cart-item');
                    const price = parseInt(row.dataset.price);
                    const qty = parseInt(document.getElementById(`qty-${cb.value}`).innerText);
                    total += price * qty;
                    count += qty;
                    checkedCount++;
                }
            });

            grandTotalElement.innerText = 'Rp ' + total.toLocaleString('id-ID');
            totalItemsElement.innerText = count;
            
            if (btnCheckout) {
                btnCheckout.disabled = count === 0;
            }
            
            if (deleteSelectedBtn) {
                deleteSelectedBtn.classList.toggle('hidden', checkedCount === 0);
                selectedCountSpan.innerText = checkedCount;
            }

            if(selectAll && checkboxes.length > 0) {
                selectAll.checked = (checkedCount === checkboxes.length);
            }
        }

        // Event Listener Checkbox
        checkboxes.forEach(cb => cb.addEventListener('change', calculateTotal));

        // Select All
        selectAll?.addEventListener('change', function() {
            checkboxes.forEach(cb => cb.checked = this.checked);
            calculateTotal();
        });

        // Update Quantity via AJAX
        function updateQty(itemId, change) {
            const qtySpan = document.getElementById(`qty-${itemId}`);
            const cartCountNavbar = document.getElementById('cart-count'); 
            let currentQty = parseInt(qtySpan.innerText);
            let newQty = currentQty + change;

            if (newQty < 1) return;

            // Visual Feedback sementara menunggu server
            qtySpan.innerText = newQty;
            calculateTotal();

            fetch(`{{ url('/cart/update') }}/${itemId}`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest' // 🔥 FIX PENTING
                },
                body: JSON.stringify({ quantity: newQty })
            })
            .then(response => response.json())
            .then(data => {
                // 🔥 FIX NAMA VARIABEL NAVBAR 🔥
                if(data.cart_count !== undefined && cartCountNavbar) {
                    cartCountNavbar.innerText = data.cart_count;
                }
            })
            .catch(error => {
                console.error('Error updating:', error);
                // Kembalikan ke angka semula jika error
                qtySpan.innerText = currentQty;
                calculateTotal();
            });
        }

        // Hapus Massal
        deleteSelectedBtn?.addEventListener('click', function() {
            if (confirm('Yakin ingin menghapus produk yang dipilih?')) {
                const container = document.getElementById('bulk-delete-inputs');
                container.innerHTML = '';
                checkboxes.forEach(cb => {
                    if (cb.checked) {
                        container.innerHTML += `<input type="hidden" name="ids[]" value="${cb.value}">`;
                    }
                });
                document.getElementById('bulk-delete-form').submit();
            }
        });

        // Hubungkan tombol Beli Sekarang (Checkout)
        btnCheckout?.addEventListener('click', function(e) {
            e.preventDefault(); 
            const selectedIds = Array.from(checkboxes)
                .filter(cb => cb.checked)
                .map(cb => cb.value);

            if (selectedIds.length === 0) return;

            const url = new URL('/checkout', window.location.origin);
            selectedIds.forEach(id => url.searchParams.append('cart_ids[]', id));
            window.location.href = url.href;
        });

        // Hitung total saat pertama kali di-load
        document.addEventListener('DOMContentLoaded', calculateTotal);
    </script>
@endsection