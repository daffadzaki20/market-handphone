<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

/**
 * @property int $id
 * @property int $user_id
 * @property string $type
 * @property string $provider
 * @property string $account_name
 * @property string $account_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $masa_berlaku
 * @property string|null $cvv
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereAccountName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereAccountNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereCvv($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereMasaBerlaku($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereUserId($value)
 * @mixin \Eloquent
 */
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