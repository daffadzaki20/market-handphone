<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlamatController extends Controller
{
    public function index() {
        // Menggunakan eager loading 'with' agar data profil user sinkron secara realtime
        $alamats = Alamat::with('user')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('user.profile.alamat', compact('alamats'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'nama' => 'required',
            'phone_number' => 'required',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'rt' => 'nullable',
            'rw' => 'nullable',
            'kode_pos' => 'required',
            'alamat_detail' => 'required',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'label' => 'nullable',
        ]);

        $data['user_id'] = Auth::id();
        
        $isFirst = Alamat::where('user_id', Auth::id())->count() === 0;
        $data['is_utama'] = $isFirst;

        // Jika koordinat tidak diisi (mis. user menolak geolocation), set ke 0.0 agar sesuai skema DB
        if (empty($data['latitude']) || empty($data['longitude'])) {
            $data['latitude'] = 0.0;
            $data['longitude'] = 0.0;
        }

        Alamat::create($data);

        return redirect()->back()->with('success', 'Alamat baru berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nama' => 'required',
            'phone_number' => 'required',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'rt' => 'nullable',
            'rw' => 'nullable',
            'kode_pos' => 'required',
            'alamat_detail' => 'required',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'label' => 'nullable',
        ]);

        $alamat = Alamat::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        if (empty($data['latitude']) || empty($data['longitude'])) {
            $data['latitude'] = 0.0;
            $data['longitude'] = 0.0;
        }

        $alamat->update($data);

        return redirect()->route('alamat.index')->with('success', 'Alamat berhasil diperbarui!');
    }

    public function destroy($id)
    { 
        $alamat = Alamat::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $alamat->delete();

        return redirect()->back()->with('success', 'Alamat berhasil dihapus dari daftar.');
    }
}