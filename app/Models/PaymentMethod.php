<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class PaymentMethod extends Model
{
    use HasFactory;

    // 1. Beri izin kolom mana saja yang boleh diisi (Mass Assignment)
   protected $fillable = [
    'type', 
    'provider', 
    'account_name', 
    'account_number',
    'masa_berlaku', // Tambahkan ini
    'cvv'           // Tambahkan ini
];

    // 2. Relasi balik ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}