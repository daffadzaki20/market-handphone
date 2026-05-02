<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Tambahkan import ini

class Alamat extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi (Mass Assignable).
     */
    protected $fillable = [
        'user_id',
        'nama',
        'phone_number',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'desa',
        'rt',
        'rw',
        'kode_pos',
        'alamat_detail',
        'latitude',
        'longitude',
        'label', // Pastikan 'label' ditambahkan jika digunakan di database
        'is_utama'
    ];

    /**
     * Relasi ke model User.
     * Mengambil data profil user (nama & telepon) secara sinkron.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}