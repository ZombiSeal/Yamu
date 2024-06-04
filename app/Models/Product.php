<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'img_path',
        'price',
        'weight',
        'is_active',
        'sale_id',
        'category_id',
        'product_attribute_id'
    ];
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function attribute(): BelongsTo
    {
        return $this->belongsTo(ProductAttribute::class, 'product_attribute_id');
    }

    public function labels(): BelongsToMany
    {
        return $this->belongsToMany(Label::class, 'product_labels', 'product_id', 'label_id');
    }

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }
}
