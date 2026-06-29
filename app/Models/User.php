<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'profile_photo',
        'phone_number',
        'gender',
        'date_of_birth',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // ======================================================================
    // 🏛️ DAFTAR RELASI DATABASE
    // ======================================================================

    public function orders()
    {
        return $this->hasMany(\App\Models\Order::class);
    }

    // 🔥 Ini yang menyembuhkan error 500 saat tambah kartu tadi!
    public function paymentMethods()
    {
        return $this->hasMany(\App\Models\PaymentMethod::class);
    }

    // Relasi untuk manajemen alamat pengiriman
    public function alamats()
    {
        return $this->hasMany(\App\Models\Alamat::class);
    }

    // Relasi untuk fitur favorit / wishlist
    public function wishlists()
    {
        return $this->hasMany(\App\Models\Wishlist::class);
    }

    // Relasi ke keranjang belanja
    public function carts()
    {
        return $this->hasMany(\App\Models\Cart::class);
    }
}