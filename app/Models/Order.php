<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'total', 'status'];

    // Relasi ke item pesanan
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Relasi ke user (pemilik pesanan)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
