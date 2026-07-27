<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Tambahkan import ini

/**
 * @property int $id
 * @property int $user_id
 * @property string $nama
 * @property string $phone_number
 * @property string $provinsi
 * @property string $kabupaten
 * @property string $kecamatan
 * @property string $desa
 * @property string|null $rt
 * @property string|null $rw
 * @property string $kode_pos
 * @property string $alamat_detail
 * @property numeric $latitude
 * @property numeric $longitude
 * @property string|null $label
 * @property int $is_utama
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Alamat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Alamat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Alamat query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Alamat whereAlamatDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Alamat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Alamat whereDesa($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Alamat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Alamat whereIsUtama($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Alamat whereKabupaten($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Alamat whereKecamatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Alamat whereKodePos($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Alamat whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Alamat whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Alamat whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Alamat whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Alamat wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Alamat whereProvinsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Alamat whereRt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Alamat whereRw($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Alamat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Alamat whereUserId($value)
 * @mixin \Eloquent
 */
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