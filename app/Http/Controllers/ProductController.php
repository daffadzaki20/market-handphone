<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('brand');

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->get();

        return view('home', compact('products'));
    }

    public function show($id)
    {
        $product = Product::with('brand')->findOrFail($id);

        return view('detail', compact('product'));
    }
}