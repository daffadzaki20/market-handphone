<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile dashboard.
     */
    public function edit(Request $request): View
    {
        return view('user.profile.index', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $data = $request->validated();

        if ($request->filled(['dob_year', 'dob_month', 'dob_day'])) {
            $month = str_pad($request->dob_month, 2, '0', STR_PAD_LEFT);
            $day = str_pad($request->dob_day, 2, '0', STR_PAD_LEFT);
            $data['date_of_birth'] = $request->dob_year . '-' . $month . '-' . $day;
        }

        $user->fill($data);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

      return redirect()->route('profile.edit');
    }

    public function uploadPhoto(Request $request): RedirectResponse
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = $request->user();

        if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
            Storage::disk('public')->delete($user->profile_photo);
        }

        $path = $request->file('profile_photo')->store('profile_photos', 'public');
        $user->profile_photo = $path;
        $user->save();

        return back()->with('success', 'Foto profil berhasil diunggah!');
    }

    public function passwordForm(): View
    {
        return view('user.profile.password');
    }

   public function orders(Request $request)
    {
        $statusTab = $request->query('status'); 

        $user = Auth::user();

        // Hitung jumlah pesanan untuk masing-masing tab
        $countSemua     = $user->orders()->count();
        $countBelum     = $user->orders()->where('status', 'belum_bayar')->count();
        $countDikemas   = $user->orders()->where('status', 'diproses')->count();
        $countDikirim   = $user->orders()->where('status', 'dikirim')->count();
        $countSelesai   = $user->orders()->where('status', 'selesai')->count();
        $countBatal     = $user->orders()->where('status', 'dibatalkan')->count();

        // Query data pesanan sesuai tab yang aktif
        $query = $user->orders()->with('items.product')->latest();

        if ($statusTab) {
            if ($statusTab === 'dikemas') {
                $query->where('status', 'diproses');
            } else {
                $query->where('status', $statusTab);
            }
        }

        $orders = $query->get();

        return view('user.profile.pesanan', compact(
            'orders', 
            'countSemua', 
            'countBelum', 
            'countDikemas', 
            'countDikirim', 
            'countSelesai', 
            'countBatal'
        ));
    }

    public function notifications()
    {
        $user = Auth::user();

        // 1. Ambil pesanan user untuk dijadikan notifikasi status pesanan
        $orders = $user->orders()->with('items.product')->latest()->take(5)->get();

        // 2. Ambil voucher terbaru dari database
        $vouchers = \App\Models\Voucher::latest()->take(5)->get();

        // UBAH 'notifications' MENJADI 'notifikasi' DI SINI 👇
        return view('user.profile.notifikasi', compact('orders', 'vouchers'));
    }
    
    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password Anda berhasil diperbarui!');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}