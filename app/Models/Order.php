<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int|null $alamat_id
 * @property numeric $total
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OrderItem> $items
 * @property-read int|null $items_count
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Alamat|null $alamat
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereAlamatId($value)
 * @property string|null $catatan_admin
 * @property int $subtotal
 * @property int $ongkir
 * @property int $biaya_layanan
 * @property int $proteksi
 * @property int $diskon_voucher
 * @property string|null $metode_pengiriman
 * @property string|null $metode_pembayaran
 * @property string|null $pesan
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereBiayaLayanan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereCatatanAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereDiskonVoucher($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereMetodePembayaran($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereMetodePengiriman($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereOngkir($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order wherePesan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereProteksi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereSubtotal($value)
 * @mixin \Eloquent
 */
class Order extends Model
{
    // 1. TAMBAHKAN 'alamat_id' DI SINI
   protected $fillable = [
    'user_id', 'alamat_id', 'total', 'status', 'catatan_admin', 
    'subtotal', 'ongkir', 'biaya_layanan', 'proteksi', 
    'diskon_voucher', 'metode_pengiriman', 'metode_pembayaran', 'pesan'
];

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

    // 2. TAMBAHKAN RELASI KE ALAMAT DI SINI
    public function alamat()
    {
        return $this->belongsTo(Alamat::class, 'alamat_id');
    }
}