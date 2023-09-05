<?php

namespace App\Models;

use App\Models\domains\RecommendProducts\RecommendProductEntity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class RecommendProduct extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'product_id',
    ];

    protected $appends = [
        'product',
    ];

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getProductAttribute()
    {
        return Product::find($this->product_id);
    }

    public function scopeSearchIndex(Builder $query, Request $request): Builder
    {
        $query->orderBy('created_at', 'desc');
        return $query;
    }

    public static function findForShow(int $id){
        return self::find($id);
    }

    public static function create(RecommendProductEntity $recommendProduct): RecommendProduct
    {
        $entity = (new RecommendProduct)->fill([
            'product_id' => $recommendProduct->getProductId(),
        ]);

        $entity->save();

        return $entity;
    }

    public function put(RecommendProductEntity $recommendProduct): RecommendProduct
    {

        $entity = $this->fill([
            'product_id' => $recommendProduct->getProductId(),
        ]);

        $entity->save();

        return $entity;
    }

}
