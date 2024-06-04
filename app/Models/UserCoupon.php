<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class UserCoupon extends Model
{
    use HasFactory;

    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }

    public function couponSale(): \Illuminate\Database\Eloquent\Relations\HasOneThrough
    {
        return $this->hasOneThrough(Sale::class, Coupon::class, 'id', 'id', 'coupon_id', 'sale_id');

    }
    protected $fillable = [
        'user_id',
        'coupon_id',
        'is_active'
    ];
}
