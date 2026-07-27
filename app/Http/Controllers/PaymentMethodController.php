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
     * Menyimpan data Kartu Kredit / Debit & E-Wallet
     */
    public function storeCard(Request $request)
    {
        // Hapus spasi dulu, lalu replace ke request
        $request->merge([
            'nomor_kartu' => str_replace(' ', '', $request->nomor_kartu),
        ]);

        // 1. Aturan dasar yang berlaku untuk kedua tipe
        $rules = [
            'type'         => 'required|in:kartu,ewallet',
            'nama_pemilik' => 'required|string|max:255',
        ];

        // 2. Tambahkan aturan spesifik berdasarkan tipe inputan
        if ($request->type === 'kartu') {
            $rules['nomor_kartu']  = 'required|numeric|digits_between:13,19';
            $rules['masa_berlaku'] = 'required|string';
            $rules['cvv']          = 'required|numeric|digits_between:3,4';
        } else {
            // Untuk E-Wallet
            $rules['provider']     = 'required|string';
            $rules['nomor_kartu']  = 'required|numeric|digits_between:10,15';
            $rules['masa_berlaku'] = 'nullable';
            $rules['cvv']          = 'nullable';
        }

        // 3. Pesan error kustomisasi
        $messages = [
            'nomor_kartu.numeric'        => 'Nomor kartu/HP harus berupa angka.',
            'nomor_kartu.digits_between' => $request->type === 'kartu' 
                                            ? 'Nomor kartu harus terdiri dari 13-19 digit.' 
                                            : 'Nomor HP harus terdiri dari 10-15 digit.',
            'cvv.numeric'                => 'CVV harus berupa angka.',
            'cvv.digits_between'         => 'CVV harus 3-4 digit.',
            'provider.required'          => 'Provider E-Wallet wajib dipilih.'
        ];

        $request->validate($rules, $messages);

        // 4. Simpan ke database
        Auth::user()->paymentMethods()->create([
            'type'           => $request->type,
            'provider'       => $request->type === 'ewallet' ? $request->provider : 'visa',
            'account_name'   => strtoupper($request->nama_pemilik),
            'account_number' => $request->nomor_kartu,
            'masa_berlaku'   => $request->masa_berlaku,
            'cvv'            => $request->cvv,
        ]);

        $pesanSukses = $request->type === 'kartu' ? 'Kartu berhasil ditambahkan!' : 'E-Wallet berhasil ditautkan!';
        
        return back()->with('success', $pesanSukses);
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
            'nomor_kartu'  => $kartu->account_number,
            'masa_berlaku' => $kartu->masa_berlaku,
            'cvv'          => $kartu->cvv
        ]);
    }

    /**
     * Menghapus data kartu / E-Wallet
     */
    public function destroy($id)
    {
        $paymentMethod = Auth::user()->paymentMethods()->where('id', $id)->firstOrFail();
        $tipe = $paymentMethod->type;
        
        $paymentMethod->delete();

        $pesanSukses = $tipe === 'kartu' ? 'Kartu berhasil dihapus.' : 'Tautan E-Wallet berhasil diputus.';

        return back()->with('success', $pesanSukses);
    }
}