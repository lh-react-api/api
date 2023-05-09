<?php

namespace App\Models;

use App\Models\domains\ProductReviews\ProductReviewEntity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductReview extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
        'title',
        'status',
        'text',
        'evaluation',
    ];

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

}
