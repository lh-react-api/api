<?php

namespace App\Models;

use App\Models\domains\ProductReviews\ProductReviewEntity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class ProductReview extends BaseModel
{
    use HasFactory;

    protected $searches = [
        'product_id' => 'eq',
        'user_id' => 'eq',
    ];

    protected $fillable = [
        'product_id',
        'user_id',
        'title',
        'status',
        'text',
        'evaluation',
    ];

    public function scopeSearchIndex(Builder $query, Request $request): Builder
    {
        $query->searchByDefined($request);
        return $query;
    }

    public static function findForShow(int $id){
        return self::find($id);
    }

    public static function create(ProductReviewEntity $productReview): ProductReview
    {
        $entity = (new ProductReview)->fill([
            'product_id' => $productReview->getProductId(),
            'user_id' => $productReview->getUserId(),
            'title' => $productReview->getTitle(),
            'text' => $productReview->getText(),
            'evaluation' => $productReview->getEvaluation()
        ]);

        $entity->save();

        return $entity;
    }

    public function put(ProductReviewEntity $productReview): ProductReview
    {

        $entity = $this->fill([
            'product_id' => $productReview->getProductId(),
            'user_id' => $productReview->getUserId(),
            'title' => $productReview->getTitle(),
            'text' => $productReview->getText(),
            'evaluation' => $productReview->getEvaluation()
        ]);

        $entity->save();

        return $entity;
    }
}
