<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    // RELASI: 1 brand punya banyak products
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}