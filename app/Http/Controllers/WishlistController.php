<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class WishlistController extends Controller
{
    /**
     * Toggle produk masuk/keluar wishlist (dipanggil via AJAX)
     */
    public function toggle($productId): JsonResponse
    {
        $userId = auth()->id();
        $existing = Wishlist::where('user_id', $userId)
                             ->where('product_id', $productId)
                             ->first();

        if ($existing) {
            $existing->delete();
            $status = 'removed';
        } else {
            Wishlist::create([
                'user_id' => $userId,
                'product_id' => $productId,
            ]);
            $status = 'added';
        }

        // PENTING: Hitung jumlah total wishlist user saat ini
        $totalWishlist = Wishlist::where('user_id', $userId)->count();

        // Kirimkan status beserta jumlah terbarunya ke Javascript
        return response()->json([
            'status' => $status,
            'count' => $totalWishlist
        ]);
    }

    /**
     * Tampilkan halaman wishlist milik user
     */
    public function index(): View
    {
        $wishlists = Wishlist::with('product.brand')
                              ->where('user_id', auth()->id())
                              ->latest()
                              ->paginate(12);

        return view('wishlist.index', compact('wishlists'));
    }

    /**
     * Hapus produk dari wishlist (dipanggil dari halaman wishlist)
     */
    public function destroy($productId): RedirectResponse
    {
        Wishlist::where('user_id', auth()->id())
                ->where('product_id', $productId)
                ->delete();

        return back()->with('success', 'Produk dihapus dari wishlist');
    }
}