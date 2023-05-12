<?php

namespace App\Models;

use App\Models\domains\ProductRanks\ProductRankEntity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductRank extends BaseModel
{
    use HasFactory;

    protected $searches = [
        // equalが動かないから一旦likeで実装
        'rank' => 'like',
        'information' => 'like',
    ];

    protected $fillable = [
        'rank',
        'information',
        'discount_rate',
        'priority',
    ];

    public function scopeSearchIndex(Builder $query, Request $request): Builder
    {
        $query->searchByDefined($request);
        
        return $query;
    }

    public static function findForShow(int $id){
        return self::find($id);
    }

    public static function create(ProductRankEntity $productRank) {

        $entity = (new ProductRank())->fill([
            'rank' => $productRank->getRank(),
            'information' => $productRank->getInfomation(),
            'discount_rate' => $productRank->getDiscountRate(),
            'priority' => $productRank->getPriority(),
        ]);

        $entity->save();

        return $entity;
    }

    public function put(ProductRankEntity $productRank) {

        $entity = $this->fill([
            'rank' => $productRank->getRank(),
            'information' => $productRank->getInfomation(),
            'discount_rate' => $productRank->getDiscountRate(),
            'priority' => $productRank->getPriority(),
        ]);

        $entity->save();

        return $entity;
    }
}
