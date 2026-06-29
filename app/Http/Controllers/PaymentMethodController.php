<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{
    /**
     * Menampilkan halaman Bank & Kartu
     */
    public function index()
    {
        $kartu = Auth::user()->paymentMethods()->where('type', 'kartu')->get();
        return view('user.profile.bank', compact('kartu')); 
    }

    /**
     * Menyimpan data Kartu Kredit / Debit
     */
    public function storeCard(Request $request)
{
    // Hapus spasi dulu, lalu replace ke request
    $request->merge([
        'nomor_kartu' => str_replace(' ', '', $request->nomor_kartu),
    ]);

    $request->validate([
        'nomor_kartu' => 'required|numeric|digits_between:13,19',
        'nama_pemilik' => 'required|string|max:255',
        'masa_berlaku' => 'required|string',
        'cvv' => 'required|numeric|digits_between:3,4',
    ], [
        'nomor_kartu.numeric' => 'Nomor kartu harus berupa angka.',
        'nomor_kartu.digits_between' => 'Nomor kartu harus terdiri dari 13-19 digit.',
        'cvv.numeric' => 'CVV harus berupa angka.',
        'cvv.digits_between' => 'CVV harus 3-4 digit.',
    ]);

    // Simpan ke database
Auth::user()->paymentMethods()->create([
    'type'           => 'kartu',
    'provider'       => 'visa',
    'account_name'   => strtoupper($request->nama_pemilik),
    'account_number' => $request->nomor_kartu,
    'masa_berlaku'   => $request->masa_berlaku,
    'cvv'            => $request->cvv,
]);

    return back()->with('success', 'Kartu berhasil ditambahkan!');
}

    /**
     * Fungsi untuk verifikasi password dan ambil detail kartu
     */
    public function getCardDetails(Request $request, $id)
    {
        // 1. Validasi password user yang sedang login
        $request->validate([
            'password' => 'required|current_password',
        ]);

        // 2. Ambil data kartu
        $kartu = Auth::user()->paymentMethods()->where('id', $id)->firstOrFail();

        // 3. Kembalikan data lengkap
        return response()->json([
            'nomor_kartu'  => $kartu->account_number, // Sesuaikan dengan logika penyimpananmu
            'masa_berlaku' => $kartu->masa_berlaku,
            'cvv'          => $kartu->cvv
        ]);
    }

    /**
     * Menghapus data kartu
     */
    public function destroy($id)
    {
        $kartu = Auth::user()->paymentMethods()->where('id', $id)->firstOrFail();
        $kartu->delete();

        return back()->with('success', 'Kartu berhasil dihapus.');
    }
}