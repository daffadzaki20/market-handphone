<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function handphoneIndex()
    {
        // Pake query() biar enak chaining-nya
        $query = Product::with('brand')->whereHas('brand', function ($b) {
            $b->where('type', 'hp');
        });

    if ($search = request('search')) {
        // Bungkus OR di dalam fungsi biar gak ngerusak 'type = hp'
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%')
              ->orWhereHas('brand', function ($brandQuery) use ($search) {
                  $brandQuery->where('name', 'like', '%' . $search . '%');
              });
        });
    }

    // Filter brand: Gue saranin pake slug/nama biar URL-nya cakep (SEO friendly)
    if ($brandSlug = request('brand')) {
        $query->whereHas('brand', function ($q) use ($brandSlug) {
            $q->where('slug', $brandSlug);
        });
    }

    $products = $query->latest()->paginate(12)->withQueryString();
    $brands = Brand::where('type', 'hp')
        ->orderBy('name', 'asc')
        ->get();

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
        $brands = Brand::where('type', 'aksesoris')
            ->orderBy('name', 'asc')
            ->get();

        return view('user.products.aksesoris', compact('products', 'brands'));
    }

    public function show(int $id)
    {
        $product = Product::with('brand')->findOrFail($id);
        $brandType = $product->brand?->type ?? null;

        return view('user.products.detail', compact('product', 'brandType'));
    }

    private function ensureAdmin()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak. Hanya admin yang dapat mengakses halaman ini.');
        }
    }

    public function adminHandphoneIndex()
    {
        $this->ensureAdmin();

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
        $this->ensureAdmin();

        $brands = Brand::where('type', 'hp')->orderBy('name', 'asc')->get();
        return view('admin.handphones.create', compact('brands'));
    }

    public function adminHandphoneStore(Request $request)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'brand_id' => ['required', 'exists:brands,id'],
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'ram' => ['nullable', 'string', 'max:100'],
            'storage' => ['nullable', 'string', 'max:100'],
            'battery' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->store('products', 'public');
        }

        // Pastikan brand yang dipilih memang tipe 'hp'
        $brand = Brand::find($validated['brand_id']);
        if (!$brand || ($brand->type ?? '') !== 'hp') {
            return back()->withErrors(['brand_id' => 'Brand yang dipilih bukan kategori Handphone.'])->withInput();
        }

        Product::create([
            'brand_id' => $validated['brand_id'],
            'name' => $validated['name'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'image' => $imageName,
            'description' => $validated['description'] ?? null,
            'ram' => $validated['ram'] ?? null,
            'storage' => $validated['storage'] ?? null,
            'battery' => $validated['battery'] ?? null,
        ]);

        return redirect('/admin/handphones')->with('success', 'Produk handphone berhasil ditambahkan.');
    }

    public function adminHandphoneEdit(int $id)
    {
        $this->ensureAdmin();

        $product = Product::query()->whereHas('brand', function ($b) {
            $b->where('type', 'hp');
        })->findOrFail($id);
        $brands = Brand::where('type', 'hp')->orderBy('name', 'asc')->get();

        return view('admin.handphones.edit', compact('product', 'brands'));
    }

    public function adminHandphoneShow(int $id)
    {
        $this->ensureAdmin();

        $product = Product::with('brand')->whereHas('brand', function ($b) {
            $b->where('type', 'hp');
        })->findOrFail($id);

        return view('admin.handphones.show', compact('product'));
    }

    public function adminHandphoneUpdate(Request $request, int $id)
    {
        $this->ensureAdmin();

        $product = Product::query()->whereHas('brand', function ($b) {
            $b->where('type', 'hp');
        })->findOrFail($id);

        $validated = $request->validate([
            'brand_id' => ['required', 'exists:brands,id'],
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'ram' => ['nullable', 'string', 'max:100'],
            'storage' => ['nullable', 'string', 'max:100'],
            'battery' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $imageName = $product->image;
        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->store('products', 'public');
        }

        // Pastikan brand yang dipilih memang tipe 'hp'
        $brand = Brand::find($validated['brand_id']);
        if (!$brand || ($brand->type ?? '') !== 'hp') {
            return back()->withErrors(['brand_id' => 'Brand yang dipilih bukan kategori Handphone.'])->withInput();
        }

        $product->update([
            'brand_id' => $validated['brand_id'],
            'name' => $validated['name'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'image' => $imageName,
            'description' => $validated['description'] ?? null,
            'ram' => $validated['ram'] ?? null,
            'storage' => $validated['storage'] ?? null,
            'battery' => $validated['battery'] ?? null,
        ]);

        return redirect('/admin/handphones')->with('success', 'Produk handphone berhasil diupdate.');
    }

    public function adminHandphoneDestroy(int $id)
    {
        $this->ensureAdmin();

        Product::query()
            ->whereHas('brand', function ($b) {
                $b->where('type', 'hp');
            })
            ->where('id', '=', $id)
            ->firstOrFail()
            ->forceDelete();

        return redirect('/admin/handphones')->with('success', 'Produk handphone berhasil dihapus.');
    }

    public function adminAksesorisIndex()
    {
        $this->ensureAdmin();

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
        $this->ensureAdmin();

        $brands = Brand::where('type', 'aksesoris')->orderBy('name', 'asc')->get();
        return view('admin.aksesoris.create', compact('brands'));
    }

    public function adminAksesorisStore(Request $request)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'brand_id' => ['required', 'exists:brands,id'],
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->store('products', 'public');
        }

        // Pastikan brand yang dipilih memang tipe 'aksesoris'
        $brand = Brand::find($validated['brand_id']);
        if (!$brand || ($brand->type ?? '') !== 'aksesoris') {
            return back()->withErrors(['brand_id' => 'Brand yang dipilih bukan kategori Aksesoris.'])->withInput();
        }

        Product::create([
            'brand_id' => $validated['brand_id'],
            'name' => $validated['name'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'image' => $imageName,
            'description' => $validated['description'] ?? null,
            'ram' => null,
            'storage' => null,
            'battery' => null,
        ]);

        return redirect('/admin/aksesoris')->with('success', 'Produk aksesoris berhasil ditambahkan.');
    }

    public function adminAksesorisEdit(int $id)
    {
        $this->ensureAdmin();

        $product = Product::query()->whereHas('brand', function ($b) {
            $b->where('type', 'aksesoris');
        })->findOrFail($id);
        $brands = Brand::where('type', 'aksesoris')->orderBy('name', 'asc')->get();

        return view('admin.aksesoris.edit', compact('product', 'brands'));
    }

    public function adminAksesorisShow(int $id)
    {
        $this->ensureAdmin();

        $product = Product::with('brand')->whereHas('brand', function ($b) {
            $b->where('type', 'aksesoris');
        })->findOrFail($id);

        return view('admin.aksesoris.show', compact('product'));
    }

    public function adminAksesorisUpdate(Request $request, int $id)
    {
        $this->ensureAdmin();

        $product = Product::query()->whereHas('brand', function ($b) {
            $b->where('type', 'aksesoris');
        })->findOrFail($id);

        $validated = $request->validate([
            'brand_id' => ['required', 'exists:brands,id'],
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $imageName = $product->image;
        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->store('products', 'public');
        }

        // Pastikan brand yang dipilih memang tipe 'aksesoris'
        $brand = Brand::find($validated['brand_id']);
        if (!$brand || ($brand->type ?? '') !== 'aksesoris') {
            return back()->withErrors(['brand_id' => 'Brand yang dipilih bukan kategori Aksesoris.'])->withInput();
        }

        $product->update([
            'brand_id' => $validated['brand_id'],
            'name' => $validated['name'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'image' => $imageName,
            'description' => $validated['description'] ?? null,
            'ram' => null,
            'storage' => null,
            'battery' => null,
        ]);

        return redirect('/admin/aksesoris')->with('success', 'Produk aksesoris berhasil diupdate.');
    }

    public function adminAksesorisDestroy(int $id)
    {
        $this->ensureAdmin();

        Product::query()
            ->whereHas('brand', function ($b) {
                $b->where('type', 'aksesoris');
            })
            ->where('id', '=', $id)
            ->firstOrFail()
            ->forceDelete();

        return redirect('/admin/aksesoris')->with('success', 'Produk aksesoris berhasil dihapus.');
    }
}