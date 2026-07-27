<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $voucher_id
 * @property int $is_used
 * @property string|null $used_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Voucher $voucher
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVoucher newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVoucher newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVoucher query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVoucher whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVoucher whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVoucher whereIsUsed($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVoucher whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVoucher whereUsedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVoucher whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVoucher whereVoucherId($value)
 * @mixin \Eloquent
 */
class UserVoucher extends Model
{
    protected $guarded = ['id'];

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }
}
