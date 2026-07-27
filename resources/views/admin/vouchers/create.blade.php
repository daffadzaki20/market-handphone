@extends('layouts.app_admin')

@section('title', 'Tambah Voucher')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <h2 class="text-xl font-bold text-gray-800">Form Tambah Voucher</h2>
        <a href="{{ route('admin.vouchers.index') }}" class="text-sm font-bold text-blue-600 hover:underline">← Kembali</a>
    </div>

    <form action="{{ route('admin.vouchers.store') }}" method="POST" class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-1">Kode Voucher</label>
            <input type="text" name="code" value="{{ old('code') }}" placeholder="Contoh: HEMAT50" required class="w-full border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none uppercase">
            @error('code') 
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p> 
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-1">Tipe Diskon</label>
                <select name="type" class="w-full border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="fixed">Nominal Tetap (Rupiah)</option>
                    <option value="percent">Persentase (%)</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-1">Nilai Diskon</label>
                <input type="number" name="value" value="{{ old('value') }}" placeholder="Contoh: 10000 atau 10" required class="w-full border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-1">Minimum Belanja (Opsional)</label>
                <input type="number" name="min_spend" value="{{ old('min_spend', 0) }}" class="w-full border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-1">Stok Kuota Voucher</label>
                <input type="number" name="stock" value="{{ old('stock', 100) }}" required class="w-full border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-1">Tanggal Kedaluwarsa (Opsional)</label>
            <input type="date" name="expired_at" value="{{ old('expired_at') }}" class="w-full border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <div class="pt-4 flex justify-end gap-3">
            <a href="{{ route('admin.vouchers.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 text-sm font-bold hover:bg-slate-50 transition">Batal</a>
            <button type="submit" class="px-5 py-2.5 rounded-xl bg-blue-600 text-white text-sm font-bold hover:bg-blue-700 transition shadow-sm">Simpan Voucher</button>
        </div>
    </form>
</div>
@endsection