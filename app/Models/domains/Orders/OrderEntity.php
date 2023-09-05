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
        protected int $creditId,
        protected OrdersProgress|string $progress,
        protected string|null $sentTrackingNumber,
        protected string|null $returnTrackingNumber,
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

    public function getCreditId(): int
    {
        return $this->creditId;
    }

    public function getProgress(): OrdersProgress|string
    {
        return $this->progress;
    }

    public function getSentTrackingNumber(): string|null
    {
        return $this->sentTrackingNumber;
    }

    public function getReturnTrackingNumber(): string|null
    {
        return $this->returnTrackingNumber;
    }

    public function getSettlementState(): OrdersSettlementState|string
    {
        return $this->settlementState;
    }

    public function getSubscriptionId(): string
    {
        return $this->subscriptionId;
    }

}