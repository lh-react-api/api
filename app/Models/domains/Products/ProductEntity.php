<?php

namespace App\Models\domains\Products;

use App\Models\domains\BaseDomain;
use App\Enums\Products\ProductsStatus;

class ProductEntity extends BaseDomain
{
    public function __construct(
        protected int               $userId,
        protected int               $productOriginId,
        protected int               $productTypeId,
        protected int               $productRankId,
        protected string            $name,
        protected int               $price,
        protected string            $stripePlanId,
        protected ProductsStatus    $status,
    )
    {
    }

    public function getUserId() {
        return $this->userId;
    }
    
    public function getProductOriginId() {
        return $this->productOriginId;
    }

    public function getProductTypeId() {
        return $this->productTypeId;
    }

    public function getProductRankId() {
        return $this->productRankId;
    }

    public function getName() {
        return $this->name;
    }

    public function getStripePlanId() {
        return $this->stripePlanId;
    }

    public function getPrice() {
        return $this->price;
    }
    
    public function getStatus() {
        return $this->status;
    }
}