<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends BaseModel
{
    use HasFactory;

    protected $searches = [
        'name' => 'like',
    ];

    public function productType(): BelongsTo
    {
        return $this->belongsTo(ProductType::class);
    }

    public function productRank(): BelongsTo
    {
        return $this->belongsTo(ProductType::class);
    }

    public function order(): HasOne
    {
        return $this->hasOne(Order::class);
    }
}
