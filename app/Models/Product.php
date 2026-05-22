<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Brand;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'name',
        'price',
        'stock',
        'image',
        'description',
        'ram',
        'storage',
        'battery'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // Accessor: derive product type from its Brand
    public function getTypeAttribute()
    {
        return $this->brand?->type ?? null;
    }

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }

        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }

        if (Storage::disk('public')->exists($this->image)) {
            return asset('storage/' . $this->image);
        }

        if (file_exists(public_path($this->image))) {
            return asset($this->image);
        }

        if (Str::startsWith($this->image, 'products/')) {
            $basename = basename($this->image);
            if (file_exists(public_path('images/products/' . $basename))) {
                return asset('images/products/' . $basename);
            }
        }

        if (file_exists(public_path('images/products/' . $this->image))) {
            return asset('images/products/' . $this->image);
        }

        if (file_exists(public_path('images/products/default.jpg'))) {
            return asset('images/products/default.jpg');
        }

        return asset('images/products/iphone15.jpg');
    }
}