<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Voucher Baru</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f6f9fc; padding: 20px; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
        <div style="background: #f97316; color: #ffffff; padding: 20px; text-align: center;">
            <h2 style="margin: 0; font-size: 22px;">{{ $isUpdate ? 'Pembaruan Voucher Belanja!' : 'Voucher Belanja Baru Tersedia!' }}</h2>
        </div>
        <div style="padding: 30px;">
            <p style="font-size: 16px;">Halo,</p>
            <p style="font-size: 15px; line-height: 1.5;">
                {{ $isUpdate ? 'Admin telah memperbarui informasi voucher belanja di MyPhoneStore:' : 'Kami memiliki voucher belanja baru khusus untuk Anda di MyPhoneStore:' }}
            </p>
            
            <div style="background: #fff7ed; border: 2px dashed #f97316; border-radius: 8px; padding: 15px; text-align: center; margin: 20px 0;">
                <span style="font-size: 24px; font-weight: bold; color: #f97316; letter-spacing: 2px;">{{ $voucher->code }}</span>
                <p style="margin: 5px 0 0; font-size: 14px; color: #4b5563;">
                    @if($voucher->type == 'percent')
                        Diskon {{ $voucher->value }}%
                    @else
                        Potongan Rp {{ number_format($voucher->value, 0, ',', '.') }}
                    @endif
                    (Min. Belanja Rp {{ number_format($voucher->min_spend, 0, ',', '.') }})
                </p>
            </div>

            <p style="font-size: 14px; color: #6b7280; text-align: center;">
                Segera klaim kode voucher tersebut melalui menu <b>Voucher Saya</b> di akun Anda sebelum kuota habis!
            </p>

            <div style="text-align: center; margin-top: 30px;">
                <a href="{{ route('profile.voucher') }}" style="background: #f97316; color: #ffffff; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 14px;">Klaim Voucher Sekarang</a>
            </div>
        </div>
        <div style="background: #f3f4f6; padding: 15px; text-align: center; font-size: 12px; color: #9ca3af;">
            &copy; {{ date('Y') }} MyPhoneStore. Hak cipta dilindungi.
        </div>
    </div>
</body>
</html>