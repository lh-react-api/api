<?php

namespace App\Models\domains\ProductReviews;

use App\Models\domains\BaseDomain;

class ProductReviewEntity extends BaseDomain
{
    public function __construct(
        protected int $productId,
        protected int $userId,
        protected string $title,
        protected string $text,
        protected int $evaluation,
    ) {
    }
    public function getProductId(): int
    {
        return $this->productId;
    }
    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getText(): string
    {
        return $this->text;
    }
    public function getEvaluation(): string
    {
        return $this->evaluation;
    }
}