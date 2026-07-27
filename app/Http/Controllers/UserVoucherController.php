<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use App\Models\UserVoucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserVoucherController extends Controller
{
    // Menampilkan daftar voucher yang sudah diklaim user
    public function index()
    {
        $myVouchers = UserVoucher::with('voucher')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('user.profile.voucher', compact('myVouchers'));
    }

    // Memproses klaim voucher
    public function claim(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $code = strtoupper(trim($request->code));
        
        // Gunakan database transaction untuk keamanan stok dan klaim serentak
        try {
            return DB::transaction(function () use ($code) {
                // Lock row voucher untuk mencegah bentrok stok (race condition)
                $voucher = Voucher::where('code', $code)->lockForUpdate()->first();

                if (!$voucher) {
                    return back()->with('error', 'Kode voucher tidak ditemukan.');
                }

                if ($voucher->stock <= 0) {
                    return back()->with('error', 'Mohon maaf, kuota voucher ini telah habis.');
                }

                // Cek apakah voucher sudah kedaluwarsa
                if ($voucher->expired_at && now()->gt($voucher->expired_at)) {
                    return back()->with('error', 'Maaf, voucher ini sudah kedaluwarsa dan tidak dapat diklaim lagi.');
                }

                // Cek apakah user sudah pernah mengklaim voucher ini (Jatah 1 kali per user)
                $alreadyClaimed = UserVoucher::where('user_id', Auth::id())
                    ->where('voucher_id', $voucher->id)
                    ->exists();

                if ($alreadyClaimed) {
                    return back()->with('error', 'Anda sudah pernah mengklaim voucher ini.');
                }

                // Buat data klaim user
                UserVoucher::create([
                    'user_id' => Auth::id(),
                    'voucher_id' => $voucher->id,
                    'used_at' => null, // Ditambahkan untuk memastikan status awalnya belum terpakai
                ]);

                // Kurangi stok voucher secara aman
                $voucher->decrement('stock');

                return back()->with('success', 'Berhasil mengklaim voucher! Silakan cek di menu Voucher Saya.');
            });
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memproses klaim voucher. Silakan coba lagi.');
        }
    }
}