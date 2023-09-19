<?php

namespace App\Models\domains\Payments;

use App\Enums\Payments\PaymentsSettlementState;
use App\Models\domains\BaseDomain;

class PaymentEntity extends BaseDomain
{
    public function __construct(
        protected int $orderId,
        protected int $creditId,
        protected PaymentsSettlementState|string $settlementState, 
    ) {
    }

    public function getOrderId(): int
    {
        return $this->orderId;
    }

    public function getCreditId(): int
    {
        return $this->creditId;
    }

    public function getSettlementState(): PaymentsSettlementState|string
    {
        return $this->settlementState;
    }

}