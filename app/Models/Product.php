<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Brand;

class Product extends Model
{
    protected $fillable = [
        'name',
        'brand_id',
        'price',
        'description',
        'image'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}