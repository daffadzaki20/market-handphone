<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::with('product.brand')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('user.wishlist.index', compact('wishlists'));
    }

    public function toggle(Request $request, $productId)
    {
        if (!Auth::check()) {
            return response()->json(['status' => 'unauthorized'], 401);
        }

        $wishlist = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        if ($wishlist) {
            $wishlist->delete();
            $status = 'removed';
        } else {
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $productId
            ]);
            $status = 'added';
        }

        $wishlistCount = Wishlist::where('user_id', Auth::id())->count();

        // Get 3 latest for floating widget update
        $latestWishlists = Wishlist::with('product')
            ->where('user_id', Auth::id())
            ->latest()
            ->take(3)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'product_name' => $item->product->name,
                    'product_price' => number_format($item->product->price, 0, ',', '.'),
                    'product_url' => route('product.show', $item->product_id),
                    'product_image' => $item->product->image_url ?? asset('images/products/default.jpg')
                ];
            });

        return response()->json([
            'status' => $status,
            'count' => $wishlistCount,
            'latest' => $latestWishlists
        ]);
    }
}
