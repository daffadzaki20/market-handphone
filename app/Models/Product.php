<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Brand;

/**
 * @property int $id
 * @property int $brand_id
 * @property string $name
 * @property int $price
 * @property int $stock
 * @property string|null $image
 * @property string|null $description
 * @property string|null $ram
 * @property string|null $storage
 * @property string|null $battery
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Brand $brand
 * @property-read string|null $image_url
 * @property-read mixed $type
 * @method static \Database\Factories\ProductFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereBattery($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereRam($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereStorage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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