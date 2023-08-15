<?php

namespace App\Models;

use App\Models\domains\Payments\PaymentEntity;
use App\Enums\Payments\PaymentsSettlementState;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends BaseModel
{
    use HasFactory;

    protected $appends = [
        'settlementStateLabel',
    ];

    protected $fillable = [
        'order_id',
        'settlement_state',
        'payment_date',
    ];

    public function getSettlementStateLabelAttribute($value)
    {
        return $this->enumLabel($this->settlement_state, "App\Enums\Payments\PaymentsSettlementState");
    }

    public static function create(PaymentEntity $paymentEntity) {
        $entity = (new Payment())->fill([
            'order_id' => $paymentEntity->getOrderId(),
            'settlement_state' => $paymentEntity->getSettlementState(),
        ]);
        $entity->save();

        return $entity;
    }

    public function statusUpdate(PaymentsSettlementState $state) {
        $this->settlement_state = $state;
        $this->save();
    }
}
