<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f3f4f6; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: #ffffff; padding: 30px; border-radius: 10px; border-top: 5px solid #2563eb; }
        h2 { color: #1e3a8a; margin-top: 0; }
        .status { display: inline-block; padding: 8px 15px; background-color: #eff6ff; color: #2563eb; font-weight: bold; border-radius: 5px; text-transform: uppercase; margin: 15px 0; }
        .details { background-color: #f9fafb; padding: 15px; border-radius: 5px; margin-top: 20px; font-size: 14px; }
        .note { background-color: #fefce8; border-left: 4px solid #eab308; padding: 15px; margin-top: 20px; border-radius: 4px; }
        .note-title { color: #ca8a04; font-size: 14px; font-weight: bold; }
        .note-content { color: #422006; font-size: 14px; display: block; margin-top: 5px; font-style: italic; }
        .footer { margin-top: 30px; font-size: 12px; color: #6b7280; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Halo, {{ $order->user->name ?? 'Pelanggan Setia' }}!</h2>
        <p>Kami ingin memberitahukan bahwa ada pembaruan pada pesanan Anda dengan nomor <strong>#ORD-{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</strong>.</p>
        
        <p>Status pesanan Anda saat ini adalah:</p>
        <div class="status">{{ $order->status }}</div>

        @if($order->status == 'diproses')
            <p>Penjual sedang mengemas dan menyiapkan pesanan Anda.</p>
        @elseif($order->status == 'dikirim')
            <p>Pesanan Anda sedang dalam perjalanan menuju alamat tujuan. Silakan bersiap untuk menerimanya!</p>
        @elseif($order->status == 'selesai')
            <p>Pesanan telah selesai. Terima kasih telah berbelanja di toko kami!</p>
        @elseif($order->status == 'ditolak' || $order->status == 'dibatalkan')
            <p>Mohon maaf, pesanan Anda telah ditolak/dibatalkan. Silakan hubungi admin untuk informasi lebih lanjut atau cek pengembalian dana Anda.</p>
        @endif

        <!-- MENAMPILKAN CATATAN DARI ADMIN JIKA ADA -->
        @if($order->catatan_admin)
            <div class="note">
                <span class="note-title">Catatan dari Penjual:</span><br>
                <span class="note-content">"{{ $order->catatan_admin }}"</span>
            </div>
        @endif

        <div class="details">
            <strong>Rincian Singkat:</strong><br>
            Total Belanja: Rp {{ number_format($order->total, 0, ',', '.') }}<br>
            Tanggal Pesan: {{ $order->created_at->format('d M Y H:i') }}
        </div>

        <p style="margin-top: 25px;">Anda dapat melihat detail lengkap pesanan Anda melalui dashboard akun di website kami.</p>

        <div class="footer">
            &copy; {{ date('Y') }} {{ config('app.name', 'MyPhoneStore') }}. All rights reserved.
        </div>
    </div>
</body>
</html>