<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;
    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function delivery(): BelongsTo
    {
        return $this->belongsTo(Delivery::class);
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }

    public function couponSale(): \Illuminate\Database\Eloquent\Relations\HasOneThrough
    {
        return $this->hasOneThrough(Sale::class, Coupon::class, 'id', 'id', 'coupon_id', 'sale_id');
    }
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'info_orders', 'order_id', 'product_id');
    }

    public function additions(): BelongsToMany
    {
        return $this->belongsToMany(Addition::class);
    }

    protected $fillable = [
        'number',
        'name',
        'phone',
        'delivery_time',
        'date',
        'comment',
        'coupon_id',
        'user_id',
        'delivery_id',
        'payment_id',
        'status_id',
        'address_id'
    ];

}
