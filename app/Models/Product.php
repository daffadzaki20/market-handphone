<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Brand;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'name',
        'type',
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
}