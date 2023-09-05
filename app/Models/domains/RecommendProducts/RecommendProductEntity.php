<?php

namespace App\Models\domains\RecommendProducts;

use App\Models\domains\BaseDomain;

class RecommendProductEntity extends BaseDomain
{
    public function __construct(
        protected int $productId,
    ) {
    }

    public function getProductId(): int
    {
        return $this->productId;
    }
}