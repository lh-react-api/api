<?php

namespace App\Models\domains\Payments;

use App\Enums\Payments\PaymentsSettlementState;
use App\Models\domains\BaseDomain;

class PaymentEntity extends BaseDomain
{
    public function __construct(
        protected int $orderId,
        protected PaymentsSettlementState|string $settlementState, 
    ) {
    }

    public function getOrderId(): int
    {
        return $this->orderId;
    }

    public function getSettlementState(): PaymentsSettlementState
    {
        return $this->settlementState;
    }

}