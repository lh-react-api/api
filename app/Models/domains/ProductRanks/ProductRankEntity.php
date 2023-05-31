<?php

namespace App\Models\domains\ProductRanks;

use App\Models\domains\BaseDomain;

class ProductRankEntity extends BaseDomain
{
    public function __construct(
        protected string    $rank,
        protected string    $information,
        protected float     $discountRate,
        protected int       $priority,
    )
    {
    }

    public function getRank(): string
    {
        return $this->rank;
    }

    public function getInfomation(): string
    {
        return $this->information;
    }
    public function getDiscountRate(): float
    {
        return $this->discountRate;
    }
    public function getPriority(): int
    {
        return $this->priority;
    }
}