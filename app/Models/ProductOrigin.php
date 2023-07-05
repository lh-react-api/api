<?php

namespace App\Models;

use App\Enums\Products\ProductsStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
            'products.productType',
            'products.productRank',
            'priceMinProduct',
            'priceMaxProduct',
            'maker',
            'genre',
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

    public function activeProducts(): HasMany
    {
        return $this->hasMany(Product::class)
            ->where('products.status', '=', ProductsStatus::IN_STOCK);
    }

    public function priceMinProduct(): HasOne
    {
        return $this->hasOne(Product::class)->ofMany('price', 'min');
    }
    public function priceMaxProduct(): HasOne
    {
        return $this->hasOne(Product::class)->ofMany('price', 'max');
    }

    public function maker(): BelongsTo
    {
        return $this->belongsTo(Maker::class);
    }

    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }

    public static function findForShow(int $id){
        return self::with([
            'activeProducts' => function ($query) { return $query->orderBy('price', 'asc');},
//            'priceMinProduct',
//            'priceMaxProduct',
//            'maker',
//            'genre',
        ])->find($id);
    }
}
