<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class BookTable extends Model
{
    use HasFactory;

    public function table(): BelongsTo
    {
        return $this->belongsTo(Table::class);
    }

    protected $fillable = [
        'table_id',
        'user_id',
        'date',
        'time',
        'name',
        'phone'
    ];
}
