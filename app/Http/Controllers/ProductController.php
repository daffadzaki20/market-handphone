<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function handphoneIndex()
    {
        $query = Product::with('brand')->whereHas('brand', function ($b) {
            $b->where('type', 'hp');
        });

        if ($search = request('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhereHas('brand', function ($brandQuery) use ($search) {
                      $brandQuery->where('name', 'like', '%' . $search . '%');
                  });
            });
        }

        if ($brandSlug = request('brand')) {
            $query->whereHas('brand', function ($q) use ($brandSlug) {
                $q->where('slug', $brandSlug);
            });
        }

        $products = $query->latest()->paginate(12)->withQueryString();
        $brands = Brand::where('type', 'hp')->orderBy('name', 'asc')->get();

        return view('user.products.handphone', compact('products', 'brands'));
    }

    public function aksesorisIndex()
    {
        $query = Product::with('brand')->whereHas('brand', function ($b) {
            $b->where('type', 'aksesoris');
        });

        if ($search = request('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhereHas('brand', function ($brandQuery) use ($search) {
                      $brandQuery->where('name', 'like', '%' . $search . '%');
                  });
            });
        }

        if ($brandSlug = request('brand')) {
            $query->whereHas('brand', function ($q) use ($brandSlug) {
                $q->where('slug', $brandSlug);
            });
        }

        $products = $query->latest()->paginate(12)->withQueryString();
        $brands = Brand::where('type', 'aksesoris')->orderBy('name', 'asc')->get();

        return view('user.products.aksesoris', compact('products', 'brands'));
    }

    public function show(int $id)
    {
        $product = Product::with('brand')->findOrFail($id);
        $brandType = $product->brand?->type ?? null;

        return view('user.products.detail', compact('product', 'brandType'));
    }

    // =========================================================================
    // HANDPHONES ADMIN
    // =========================================================================

    public function adminHandphoneIndex()
    {
        $query = Product::with('brand')->whereHas('brand', function ($b) {
            $b->where('type', 'hp');
        })->latest();

        if (request('search')) {
            $query->where('name', 'like', '%' . request('search') . '%');
        }

        if (request('brand_id')) {
            $query->where('brand_id', '=', request('brand_id'));
        }

        $products = $query->paginate(10)->withQueryString();
        $brands = Brand::query()->orderBy('name', 'asc')->get();

        return view('admin.handphones.index', compact('products', 'brands'));
    }

    public function adminHandphoneCreate()
    {
        $brands = Brand::where('type', 'hp')->orderBy('name', 'asc')->get();
        return view('admin.handphones.create', compact('brands'));
    }

    public function adminHandphoneStore(StoreProductRequest $request)
    {
        $validated = $request->validated();
        $brand = Brand::find($validated['brand_id']);
        
        if (!$brand || ($brand->type ?? '') !== 'hp') {
            return back()->withErrors(['brand_id' => 'Brand yang dipilih bukan kategori Handphone.'])->withInput();
        }

        Product::create([
            'brand_id' => $validated['brand_id'],
            'name' => $validated['name'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'image' => $this->handleImageUpload($request),
            'description' => $validated['description'] ?? null,
            'ram' => $validated['ram'] ?? null,
            'storage' => $validated['storage'] ?? null,
            'battery' => $validated['battery'] ?? null,
        ]);

        return redirect('/admin/handphones')->with('success', 'Produk handphone berhasil ditambahkan.');
    }

    public function adminHandphoneEdit(int $id)
    {
        $product = Product::query()->whereHas('brand', function ($b) {
            $b->where('type', 'hp');
        })->findOrFail($id);
        
        $brands = Brand::where('type', 'hp')->orderBy('name', 'asc')->get();

        return view('admin.handphones.edit', compact('product', 'brands'));
    }

    public function adminHandphoneShow(int $id)
    {
        $product = Product::with('brand')->whereHas('brand', function ($b) {
            $b->where('type', 'hp');
        })->findOrFail($id);

        return view('admin.handphones.show', compact('product'));
    }

    public function adminHandphoneUpdate(UpdateProductRequest $request, int $id)
    {
        $product = Product::query()->whereHas('brand', function ($b) {
            $b->where('type', 'hp');
        })->findOrFail($id);

        $validated = $request->validated();
        $brand = Brand::find($validated['brand_id']);

        if (!$brand || ($brand->type ?? '') !== 'hp') {
            return back()->withErrors(['brand_id' => 'Brand yang dipilih bukan kategori Handphone.'])->withInput();
        }

        $product->update([
            'brand_id' => $validated['brand_id'],
            'name' => $validated['name'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'image' => $this->handleImageUpload($request, $product->image),
            'description' => $validated['description'] ?? null,
            'ram' => $validated['ram'] ?? null,
            'storage' => $validated['storage'] ?? null,
            'battery' => $validated['battery'] ?? null,
        ]);

        return redirect('/admin/handphones')->with('success', 'Produk handphone berhasil diupdate.');
    }

    public function adminHandphoneDestroy(int $id)
    {
        Product::query()
            ->whereHas('brand', function ($b) {
                $b->where('type', 'hp');
            })
            ->where('id', '=', $id)
            ->firstOrFail()
            ->forceDelete();

        return redirect('/admin/handphones')->with('success', 'Produk handphone berhasil dihapus.');
    }

    // =========================================================================
    // AKSESORIS ADMIN
    // =========================================================================

    public function adminAksesorisIndex()
    {
        $query = Product::with('brand')->whereHas('brand', function ($b) {
            $b->where('type', 'aksesoris');
        })->latest();

        if (request('search')) {
            $query->where('name', 'like', '%' . request('search') . '%');
        }

        if (request('brand_id')) {
            $query->where('brand_id', '=', request('brand_id'));
        }

        $products = $query->paginate(10)->withQueryString();
        $brands = Brand::query()->orderBy('name', 'asc')->get();

        return view('admin.aksesoris.index', compact('products', 'brands'));
    }

    public function adminAksesorisCreate()
    {
        $brands = Brand::where('type', 'aksesoris')->orderBy('name', 'asc')->get();
        return view('admin.aksesoris.create', compact('brands'));
    }

    public function adminAksesorisStore(StoreProductRequest $request)
    {
        $validated = $request->validated();
        $brand = Brand::find($validated['brand_id']);

        if (!$brand || ($brand->type ?? '') !== 'aksesoris') {
            return back()->withErrors(['brand_id' => 'Brand yang dipilih bukan kategori Aksesoris.'])->withInput();
        }

        Product::create([
            'brand_id' => $validated['brand_id'],
            'name' => $validated['name'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'image' => $this->handleImageUpload($request),
            'description' => $validated['description'] ?? null,
            'ram' => null,
            'storage' => null,
            'battery' => null,
        ]);

        return redirect('/admin/aksesoris')->with('success', 'Produk aksesoris berhasil ditambahkan.');
    }

    public function adminAksesorisEdit(int $id)
    {
        $product = Product::query()->whereHas('brand', function ($b) {
            $b->where('type', 'aksesoris');
        })->findOrFail($id);
        
        $brands = Brand::where('type', 'aksesoris')->orderBy('name', 'asc')->get();

        return view('admin.aksesoris.edit', compact('product', 'brands'));
    }

    public function adminAksesorisShow(int $id)
    {
        $product = Product::with('brand')->whereHas('brand', function ($b) {
            $b->where('type', 'aksesoris');
        })->findOrFail($id);

        return view('admin.aksesoris.show', compact('product'));
    }

    public function adminAksesorisUpdate(UpdateProductRequest $request, int $id)
    {
        $product = Product::query()->whereHas('brand', function ($b) {
            $b->where('type', 'aksesoris');
        })->findOrFail($id);

        $validated = $request->validated();
        $brand = Brand::find($validated['brand_id']);

        if (!$brand || ($brand->type ?? '') !== 'aksesoris') {
            return back()->withErrors(['brand_id' => 'Brand yang dipilih bukan kategori Aksesoris.'])->withInput();
        }

        $product->update([
            'brand_id' => $validated['brand_id'],
            'name' => $validated['name'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'image' => $this->handleImageUpload($request, $product->image),
            'description' => $validated['description'] ?? null,
            'ram' => null,
            'storage' => null,
            'battery' => null,
        ]);

        return redirect('/admin/aksesoris')->with('success', 'Produk aksesoris berhasil diupdate.');
    }

    public function adminAksesorisDestroy(int $id)
    {
        Product::query()
            ->whereHas('brand', function ($b) {
                $b->where('type', 'aksesoris');
            })
            ->where('id', '=', $id)
            ->firstOrFail()
            ->forceDelete();

        return redirect('/admin/aksesoris')->with('success', 'Produk aksesoris berhasil dihapus.');
    }

    /**
     * Handle Image Upload helper method
     */
    private function handleImageUpload(Request $request, $existingImage = null)
    {
        if ($request->hasFile('image')) {
            return $request->file('image')->store('products', 'public');
        }
        return $existingImage;
    }
}