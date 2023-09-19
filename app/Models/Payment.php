<?php

namespace App\Models;

use App\Models\domains\Payments\PaymentEntity;
use App\Enums\Payments\PaymentsSettlementState;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Payment extends BaseModel
{
    use HasFactory;

    protected $searches = [];

    protected $appends = [
        'settlementStateLabel',
    ];

    protected $fillable = [
        'order_id',
        'credit_id',
        'settlement_state',
    ];

    public function scopeSearchIndex(Builder $query, Request $request): Builder
    {
        $query->searchByDefined($request);
        return $query;
    }

    public function getSettlementStateLabelAttribute($value)
    {
        return $this->enumLabel($this->settlement_state, "App\Enums\Payments\PaymentsSettlementState");
    }

    public static function findForShow(int $id){
        return self::find($id);
    }

    public static function create(PaymentEntity $paymentEntity) {
        $entity = (new Payment())->fill([
            'order_id' => $paymentEntity->getOrderId(),
            'credit_id' => $paymentEntity->getCreditId(),
            'settlement_state' => $paymentEntity->getSettlementState(),
        ]);
        $entity->save();

        return $entity;
    }

    public function put(PaymentEntity $paymentEntity)
    {
        $entity = $this->fill([
            'order_id' => $paymentEntity->getOrderId(),
            'credit_id' => $paymentEntity->getCreditId(),
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
