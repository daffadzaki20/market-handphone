@extends('layouts.app_admin') @section('content')
<div class="p-6 max-w-7xl mx-auto">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-black text-gray-800 tracking-tight">Kelola Pesanan</h1>
            <p class="text-sm text-gray-500 mt-1">Pantau status transaksi, perbarui pengiriman, dan cetak laporan.</p>
        </div>
        
        <a href="{{ route('admin.laporan.pdf') }}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2.5 px-5 rounded-xl shadow-lg shadow-red-100 inline-flex items-center gap-2 transition-all hover:scale-105 text-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            Unduh Laporan PDF
        </a>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b border-gray-100 font-bold tracking-wider">
                    <tr>
                        <th class="px-6 py-4">ID Pesanan</th>
                        <th class="px-6 py-4">Pelanggan</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Total</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($orders as $order)
                    <tr class="hover:bg-gray-50/80 transition-colors">
                        <td class="px-6 py-4 font-bold text-gray-800">#ORD-{{ $order->id }}</td>
                        <td class="px-6 py-4">
                            <div class="font-semibold text-gray-700">{{ $order->user->name ?? 'User Dihapus' }}</div>
                            <div class="text-xs text-gray-400">{{ $order->user->email ?? '' }}</div>
                        </td>
                        <td class="px-6 py-4 text-gray-600">{{ $order->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4 font-semibold text-gray-800">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            @if($order->status == 'pending' || $order->status == 'unpaid')
                                <span class="bg-yellow-50 text-yellow-600 px-3 py-1 rounded-full text-xs font-bold border border-yellow-100">Menunggu Pembayaran</span>
                            @elseif($order->status == 'processing')
                                <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-full text-xs font-bold border border-blue-100">Diproses</span>
                            @elseif($order->status == 'completed' || $order->status == 'success')
                                <span class="bg-green-50 text-green-600 px-3 py-1 rounded-full text-xs font-bold border border-green-100">Selesai</span>
                            @else
                                <span class="bg-gray-50 text-gray-600 px-3 py-1 rounded-full text-xs font-bold border border-gray-100">{{ ucfirst($order->status) }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="text-blue-600 hover:text-blue-800 font-bold text-xs bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-lg transition-colors">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-400 italic">Belum ada pesanan masuk dari pelanggan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($orders->hasPages())
        <div class="p-4 bg-gray-50 border-t border-gray-100">
            {{ $orders->links() }}
        </div>
        @endif
    </div>
</div>
@endsection