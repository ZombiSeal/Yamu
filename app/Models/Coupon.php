<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'sale_id'
    ];
    public function quiz(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Quiz::class);
    }

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }

}
