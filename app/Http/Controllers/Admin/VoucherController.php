<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use App\Models\User;
use App\Mail\VoucherNotificationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class VoucherController extends Controller
{
    // Menampilkan daftar voucher
    public function index()
    {
        $vouchers = Voucher::latest()->paginate(10);
        return view('admin.vouchers.index', compact('vouchers'));
    }

    // Menampilkan form tambah voucher
    public function create()
    {
        return view('admin.vouchers.create');
    }

    // Menyimpan voucher baru ke database & kirim email ke semua user
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:vouchers,code|string|max:50',
            'type' => 'required|in:fixed,percent',
            'value' => 'required|numeric|min:0',
            'min_spend' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'expired_at' => 'nullable|date',
        ]);

        $voucher = Voucher::create([
            'code' => strtoupper($request->code),
            'type' => $request->type,
            'value' => $request->value,
            'min_spend' => $request->min_spend ?? 0,
            'stock' => $request->stock,
            'expired_at' => $request->expired_at,
        ]);

        // Kirim email pemberitahuan voucher baru ke semua user
        $users = User::all();
        foreach ($users as $user) {
            if (!empty($user->email)) {
                try {
                    Mail::to($user->email)->send(new VoucherNotificationMail($voucher, false));
                } catch (\Exception $e) {
                    // Mencegah error pengiriman email menghentikan proses admin
                }
            }
        }

        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher berhasil ditambahkan dan email notifikasi telah dikirim ke semua user.');
    }

    // Menampilkan form edit voucher
    public function edit($id)
    {
        $voucher = Voucher::findOrFail($id);
        return view('admin.vouchers.edit', compact('voucher'));
    }

    // Memperbarui data voucher & kirim email pembaruan ke semua user
    public function update(Request $request, $id)
    {
        $voucher = Voucher::findOrFail($id);

        $request->validate([
            'code' => 'required|string|max:50|unique:vouchers,code,' . $voucher->id,
            'type' => 'required|in:fixed,percent',
            'value' => 'required|numeric|min:0',
            'min_spend' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'expired_at' => 'nullable|date',
        ]);

        $voucher->update([
            'code' => strtoupper($request->code),
            'type' => $request->type,
            'value' => $request->value,
            'min_spend' => $request->min_spend ?? 0,
            'stock' => $request->stock,
            'expired_at' => $request->expired_at,
        ]);

        // Kirim email pembaruan voucher ke semua user
        $users = User::all();
        foreach ($users as $user) {
            if (!empty($user->email)) {
                try {
                    Mail::to($user->email)->send(new VoucherNotificationMail($voucher, true));
                } catch (\Exception $e) {
                    // Mencegah error pengiriman email menghentikan proses admin
                }
            }
        }

        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher berhasil diperbarui dan email notifikasi telah dikirim ke semua user.');
    }

    // Menghapus voucher
    public function destroy($id)
    {
        $voucher = Voucher::findOrFail($id);
        $voucher->delete();

        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher berhasil dihapus.');
    }
}