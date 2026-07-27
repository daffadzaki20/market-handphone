@extends('layouts.app_admin')

@section('title', 'Kelola Voucher')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-gray-800">Daftar Voucher Toko</h2>
            <p class="text-sm text-gray-500 mt-1">Kelola diskon dan kode promo untuk pelanggan.</p>
        </div>
        <a href="{{ route('admin.vouchers.create') }}" class="inline-flex items-center justify-center px-4 py-2 rounded-xl bg-blue-600 text-white font-bold hover:bg-blue-700 transition shadow-sm">
            + Tambah Voucher
        </a>
    </div>

    @if(session('success'))
        <div class="rounded-xl bg-green-50 border border-green-200 text-green-700 px-4 py-3 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 text-left text-slate-400 font-semibold uppercase text-xs">
                        <th class="p-4">Kode Voucher</th>
                        <th class="p-4">Tipe & Diskon</th>
                        <th class="p-4">Min. Belanja</th>
                        <th class="p-4">Stok</th>
                        <th class="p-4">Expired</th>
                        <th class="p-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($vouchers as $voucher)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="p-4 font-bold text-slate-800 tracking-wider">{{ $voucher->code }}</td>
                            <td class="p-4">
                                <span class="px-2.5 py-1 rounded-lg text-xs font-bold {{ $voucher->type == 'percent' ? 'bg-purple-50 text-purple-600' : 'bg-blue-50 text-blue-600' }}">
                                    {{ $voucher->type == 'percent' ? $voucher->value . '%' : 'Rp ' . number_format($voucher->value, 0, ',', '.') }}
                                </span>
                            </td>
                            <td class="p-4 text-slate-600">Rp {{ number_format($voucher->min_spend, 0, ',', '.') }}</td>
                            <td class="p-4 font-semibold text-slate-700">{{ $voucher->stock }}</td>
                            <td class="p-4 text-slate-500">{{ $voucher->expired_at ? date('d M Y', strtotime($voucher->expired_at)) : 'Selamanya' }}</td>
                            <td class="p-4">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.vouchers.edit', $voucher->id) }}" class="px-3 py-1.5 rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-100 font-medium">Edit</a>
                                    <form action="{{ route('admin.vouchers.destroy', $voucher->id) }}" method="POST" onsubmit="return confirm('Hapus voucher ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1.5 rounded-lg border border-red-200 text-red-600 hover:bg-red-50 font-medium">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-slate-400">Belum ada voucher tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-slate-100">
            {{ $vouchers->links() }}
        </div>
    </div>
</div>
@endsection