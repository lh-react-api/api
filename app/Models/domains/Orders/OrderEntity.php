<?php

namespace App\Models\domains\Orders;

use App\Enums\Orders\OrdersProgress;
use App\Enums\Orders\OrdersSettlementState;
use App\Models\domains\BaseDomain;

class OrderEntity extends BaseDomain
{
    public function __construct(
        protected int $productId,
        protected int $userId,
        protected OrdersProgress|string $progress, 
        protected string $sentTrackingNumber,
        protected string $returnTrackingNumber,
        protected OrdersSettlementState|string $settlementState, 
        protected string $subscriptionId,
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

    public function getProgress(): OrdersProgress
    {
        return $this->progress;
    }

    public function getSentTrackingNumber(): string
    {
        return $this->sentTrackingNumber;
    }

    public function getReturnTrackingNumber(): string
    {
        return $this->returnTrackingNumber;
    }

    public function getSettlementState(): OrdersSettlementState
    {
        return $this->settlementState;
    }

    public function getSubscriptionId(): string
    {
        return $this->subscriptionId;
    }

}