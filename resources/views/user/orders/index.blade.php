@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-10 bg-white shadow-lg rounded-xl p-6">
    <!-- Judul -->
    <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center gap-2">
        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"/>
        </svg>
        Pesanan Saya
    </h2>

    <!-- Tabel Pesanan -->
    @if($orders->isEmpty())
        <div class="py-16 flex flex-col items-center text-gray-500">
            <svg class="w-16 h-16 mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M9 14l2 2 4-4"/>
            </svg>
            <p class="text-lg font-medium">Belum ada pesanan</p>
            <p class="text-sm mt-1">Pesanan baru Anda akan otomatis muncul di sini.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full border-collapse rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-blue-50 text-blue-700">
                        <th class="p-3 text-left">ID</th>
                        <th class="p-3 text-left">Total</th>
                        <th class="p-3 text-left">Status</th>
                        <th class="p-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="p-3 font-semibold text-gray-700">#{{ $order->id }}</td>
                            <td class="p-3 text-gray-600">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                            <td class="p-3">
                                <span class="px-2 py-1 rounded-full text-xs font-medium
                                    {{ $order->status === 'diproses' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                    {{ $order->status === 'selesai' ? 'bg-green-100 text-green-700' : '' }}
                                    {{ $order->status === 'dikirim' ? 'bg-blue-100 text-blue-700' : '' }}
                                    {{ $order->status === 'dibatalkan' ? 'bg-red-100 text-red-700' : '' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="p-3">
                                <a href="{{ route('orders.show', $order->id) }}"
                                   class="text-blue-600 hover:text-blue-800 font-medium transition">
                                   Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
