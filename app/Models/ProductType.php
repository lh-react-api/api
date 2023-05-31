<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductType extends BaseModel
{
    use HasFactory;

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
