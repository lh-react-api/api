<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\Request;

class ProductOrigin extends BaseModel
{
    use HasFactory;


    protected $searches = [
        'name' => 'like',
        'genre_id' => 'in',
        'maker_id' => 'in',
    ];

    public function scopeSearchIndex(Builder $query, Request $request): Builder
    {
        $query->with([
            'products',
//            'priceMinProduct',
//            'priceMaxProduct'
        ]);
        $query->searchByDefined($request);
        $this->_whereHasEq($query, $request, 'products.name', 'products');
        $query->orderBy('created_at', 'desc');

        return $query;
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function priceMinProduct(): HasOne
    {

        return $this->hasOne(Product::class)->ofMany('price', 'min');
    }
    public function priceMaxProduct(): HasOne
    {
        return $this->hasOne(Product::class)->ofMany('price', 'max');
    }
}
