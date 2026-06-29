@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6 md:py-8 flex flex-col md:flex-row gap-4 md:gap-3">

    <div class="w-full md:w-48 flex-shrink-0">
        <div class="flex items-center gap-3 mb-6 pb-6 border-b border-gray-200">
            @if(Auth::user()->profile_photo)
                <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Avatar" class="w-12 h-12 rounded-full object-cover border border-gray-200">
            @else
                <div class="w-12 h-12 bg-slate-500 text-white rounded-full flex items-center justify-center text-xl font-semibold">
                    {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                </div>
            @endif
            
            <div class="overflow-hidden">
                <div class="font-bold text-gray-800 truncate">{{ Auth::user()->username }}</div>
                <a href="{{ route('profile.edit') }}" class="text-sm text-gray-500 flex items-center gap-1 mt-0.5 hover:text-orange-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    Ubah Profil
                </a>
            </div>
        </div>

        <nav class="space-y-5 text-sm">
            <div>
                <div class="flex items-center gap-2 font-semibold text-gray-800 mb-2 cursor-pointer hover:text-orange-500 transition-colors">
                    <span class="text-blue-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </span>
                    Akun Saya
                </div>
                <div class="pl-7 space-y-3 mt-2">
                    <a href="{{ route('profile.edit') }}" class="block text-gray-600 hover:text-orange-500 transition-colors">Profil</a>
                    <a href="{{ route('profile.bank') }}" class="block text-orange-500 font-medium">Bank & Kartu</a>
                    <a href="{{ route('alamat.index') }}" class="block text-gray-600 hover:text-orange-500 transition-colors">Alamat</a>
                    <a href="{{ route('profile.password') }}" class="block text-gray-600 hover:text-orange-500 transition-colors">Ubah Password</a>
                </div>
            </div>

            <a href="{{ route('profile.orders') }}" class="flex items-center gap-2 font-semibold text-gray-700 hover:text-orange-500 transition-colors">
                <span class="text-blue-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </span>
                Pesanan Saya
            </a>
            
            <a href="{{ route('profile.notifications') }}" class="flex items-center gap-2 font-semibold text-gray-700 hover:text-orange-500 transition-colors">
                <span class="text-orange-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                </span>
                Notifikasi
            </a>

            <a href="{{ route('profile.voucher') }}" class="flex items-center gap-2 font-semibold text-gray-700 hover:text-orange-500 transition-colors">
                <span class="text-orange-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                </span>
                Voucher Saya
            </a>
        </nav>

        <div class="border-t border-gray-100 my-4"></div>

        <form method="POST" action="{{ route('logout') }}" class="flex items-center gap-2 font-semibold text-red-500 hover:bg-red-50 p-2 rounded-lg transition-colors">
            @csrf
            <button type="submit" class="flex items-center gap-2 w-full text-left">
                <span class="text-red-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                </span>
                Logout
            </button>
        </form>
    </div>

    <div class="flex-1 bg-white shadow-sm border border-gray-100 rounded-md p-6 md:p-8">
        
        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-lg">
                <div class="font-bold mb-1 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Gagal menyimpan kartu!
                </div>
                <ul class="list-disc list-inside text-sm ml-7">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-600 px-4 py-3 rounded-lg flex items-center gap-3">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="font-medium text-sm">{{ session('success') }}</span>
            </div>
        @endif

        <div class="border-b border-gray-200 pb-4 mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-xl font-medium text-gray-800">Kartu Kredit / Debit</h1>
            </div>
            <button onclick="toggleModal('modalTambahKartu')" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-sm text-sm font-medium transition-colors shadow-sm flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Kartu Baru
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-10">
            @forelse($kartu as $item)
                <div class="bg-gradient-to-r from-slate-800 to-slate-900 rounded-xl p-5 text-white shadow-lg relative overflow-hidden group hover:-translate-y-1 transition-transform">
                    <div class="absolute -right-4 -top-4 w-24 h-24 bg-white/5 rounded-full blur-xl"></div>
                    <div class="absolute -bottom-4 -left-4 w-20 h-20 bg-white/5 rounded-full blur-lg"></div>
                    
                    <div class="relative z-10">
                        <div class="flex justify-between items-start mb-6">
                            <svg class="w-10 h-8 text-yellow-400 opacity-80" viewBox="0 0 40 32" fill="currentColor">
                                <path d="M6 0h28c3.3 0 6 2.7 6 6v20c0 3.3-2.7 6-6 6H6c-3.3 0-6-2.7-6-6V6c0-3.3 2.7-6 6-6zm0 2h28c2.2 0 4 1.8 4 4v20c0 2.2-1.8 4-4 4H6c-2.2 0-4-1.8-4-4V6c0-2.2 1.8-4 4-4z"/>
                                <path d="M12 8h16v16H12zM0 14h10v4H0zm30 0h10v4H30z"/>
                            </svg>
                            <span class="font-bold italic text-slate-300">VISA</span>
                        </div>

                        {{-- Nomor Kartu: hanya tampilkan 4 digit terakhir --}}
                        <div class="font-mono text-lg tracking-[0.2em] mb-1 shadow-sm" id="card-number-{{ $item->id }}">
                            •••• •••• •••• {{ substr($item->account_number, -4) }}
                        </div>

                        {{-- CVV tersembunyi --}}
                        <div class="text-xs text-slate-400 mb-4">
                            CVV: <span id="cvv-{{ $item->id }}">•••</span>
                        </div>

                        <div class="flex justify-between items-end mt-2">
                            <div class="font-medium uppercase text-sm tracking-widest text-slate-300">{{ $item->account_name }}</div>
                            <div class="flex items-center gap-3">
                                {{-- Tombol Lihat Detail --}}
                                <button type="button" onclick="openRevealModal({{ $item->id }})" 
                                    class="text-xs text-slate-300 hover:text-white transition-colors flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Lihat Detail
                                </button>

                                {{-- Tombol Hapus --}}
                                <form action="{{ route('profile.bank.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kartu ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs text-red-400 hover:text-red-300 transition-colors">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 flex flex-col items-center justify-center text-gray-400 mb-10">
                    <svg class="w-16 h-16 mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    <p class="text-sm">Anda belum memiliki kartu kredit / debit yang tersimpan.</p>
                </div>
            @endforelse
        </div>

        <div class="border-b border-gray-200 pb-4 mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-xl font-medium text-gray-800">Rekening Bank Saya</h1>
            </div>
            <button class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-sm text-sm font-medium transition-colors shadow-sm flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Rekening Bank
            </button>
        </div>

        <div class="py-12 flex flex-col items-center justify-center text-gray-400 mb-10">
            <svg class="w-16 h-16 mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path></svg>
            <p class="text-sm">Anda belum memiliki rekening bank yang tersimpan.</p>
        </div>

        <div class="border-b border-gray-200 pb-4 mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-xl font-medium text-gray-800">Dompet Digital (E-Wallet)</h1>
            </div>
            <button class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-sm text-sm font-medium transition-colors shadow-sm flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tautkan E-Wallet
            </button>
        </div>

        <div class="py-12 flex flex-col items-center justify-center text-gray-400">
            <svg class="w-16 h-16 mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
            <p class="text-sm">Belum ada akun E-Wallet (Gopay, OVO, Dana, dll) yang tertaut.</p>
        </div>

    </div>
</div>

{{-- Modal Tambah Kartu --}}
<div id="modalTambahKartu" class="fixed inset-0 z-50 hidden overflow-y-auto bg-gray-900/60 backdrop-blur-sm" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="hidden sm:inline-block sm:h-screen sm:align-middle" aria-hidden="true">&#8203;</div>
        <div class="relative inline-block w-full px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-2xl shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:p-6 sm:px-8">
            <div class="flex justify-between items-center mb-5">
                <h3 class="text-xl font-bold text-gray-900" id="modal-title">Tambah Kartu Baru</h3>
                <button type="button" onclick="toggleModal('modalTambahKartu')" class="text-gray-400 hover:text-red-500 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <form action="{{ route('profile.card.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama di Kartu</label>
                    <input type="text" name="nama_pemilik" required placeholder="CONTOH: YANTO"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500 uppercase">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Kartu</label>
                    <input type="text" name="nomor_kartu" id="nomor_kartu" required
                           placeholder="0000 0000 0000 0000" maxlength="19" inputmode="numeric"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500 tracking-widest">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Masa Berlaku</label>
                        <input type="text" name="masa_berlaku" id="masa_berlaku" required placeholder="MM/YY" maxlength="5"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">CVV</label>
                        <input type="password" name="cvv" required placeholder="123" maxlength="4" inputmode="numeric"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500">
                    </div>
                </div>
                <div class="mt-6 flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <button type="button" onclick="toggleModal('modalTambahKartu')" class="px-5 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Batal</button>
                    <button type="submit" class="px-5 py-2 text-sm font-medium text-white bg-orange-500 rounded-lg hover:bg-orange-600">Simpan Kartu</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Verifikasi Password untuk Lihat Detail Kartu --}}
<div id="modalRevealCard" class="fixed inset-0 z-50 hidden overflow-y-auto bg-gray-900/60 backdrop-blur-sm">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-gray-900">Verifikasi Password</h3>
                <button onclick="closeRevealModal()" class="text-gray-400 hover:text-red-500 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <p class="text-sm text-gray-500 mb-4">Masukkan password akun Anda untuk melihat detail kartu. Detail akan tersembunyi kembali setelah 10 detik.</p>
            <div id="revealError" class="hidden mb-4 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-lg text-sm"></div>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" id="revealPassword" placeholder="Masukkan password Anda"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500"
                           onkeydown="if(event.key==='Enter') submitReveal()">
                </div>
                <div class="flex justify-end gap-3 pt-2">
                    <button onclick="closeRevealModal()" class="px-5 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Batal</button>
                    <button onclick="submitReveal()" id="revealBtn" class="px-5 py-2 text-sm text-white bg-orange-500 rounded-lg hover:bg-orange-600">Lihat Detail</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let currentCardId = null;

    function toggleModal(modalID) {
        document.getElementById(modalID).classList.toggle("hidden");
    }

    function openRevealModal(cardId) {
        currentCardId = cardId;
        document.getElementById('revealPassword').value = '';
        document.getElementById('revealError').classList.add('hidden');
        document.getElementById('modalRevealCard').classList.remove('hidden');
        setTimeout(() => document.getElementById('revealPassword').focus(), 100);
    }

    function closeRevealModal() {
        currentCardId = null;
        document.getElementById('modalRevealCard').classList.add('hidden');
    }

    async function submitReveal() {
        const password = document.getElementById('revealPassword').value;
        const errorEl = document.getElementById('revealError');
        const btn = document.getElementById('revealBtn');

        if (!password) {
            errorEl.textContent = 'Password tidak boleh kosong.';
            errorEl.classList.remove('hidden');
            return;
        }

        btn.textContent = 'Memverifikasi...';
        btn.disabled = true;

        try {
            const response = await fetch(`/profile/kartu/${currentCardId}/detail`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({ password }),
            });

            const data = await response.json();

            if (!response.ok) {
                errorEl.textContent = data.message || 'Password salah. Coba lagi.';
                errorEl.classList.remove('hidden');
                btn.textContent = 'Lihat Detail';
                btn.disabled = false;
                return;
            }

            // Tampilkan nomor kartu dengan format spasi tiap 4 digit
            const raw = data.nomor_kartu;
            const formatted = raw.match(/.{1,4}/g).join(' ');
            document.getElementById(`card-number-${currentCardId}`).textContent = formatted;
            document.getElementById(`cvv-${currentCardId}`).textContent = data.cvv;

            closeRevealModal();
            btn.textContent = 'Lihat Detail';
            btn.disabled = false;

            // Sembunyikan lagi setelah 10 detik
            setTimeout(() => {
                const last4 = raw.slice(-4);
                document.getElementById(`card-number-${currentCardId}`).textContent = `•••• •••• •••• ${last4}`;
                document.getElementById(`cvv-${currentCardId}`).textContent = '•••';
            }, 10000);

        } catch (err) {
            errorEl.textContent = 'Terjadi kesalahan. Coba lagi.';
            errorEl.classList.remove('hidden');
            btn.textContent = 'Lihat Detail';
            btn.disabled = false;
        }
    }

    // Format Nomor Kartu (spasi tiap 4 digit)
    const cardInput = document.getElementById('nomor_kartu');
    cardInput.addEventListener('input', (e) => {
        let value = e.target.value.replace(/\D/g, '');
        value = value.replace(/(.{4})/g, '$1 ').trim();
        e.target.value = value;
    });

    // Format Masa Berlaku (tambah / setelah MM)
    const expiryInput = document.getElementById('masa_berlaku');
    expiryInput.addEventListener('input', (e) => {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length > 2) {
            value = value.substring(0, 2) + '/' + value.substring(2, 4);
        }
        e.target.value = value;
    });

    // Hapus spasi dari nomor kartu sebelum submit
    document.querySelector('form[action*="kartu/store"]').addEventListener('submit', function() {
        cardInput.value = cardInput.value.replace(/\s/g, '');
    });
</script>
@endpush
@endsection