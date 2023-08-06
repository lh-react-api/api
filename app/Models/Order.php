<?php

namespace App\Models;

use App\Enums\Orders\OrdersProgress;
use App\Models\domains\Orders\OrderEntity;
use App\Enums\Orders\OrdersSettlementState;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends BaseModel
{
    use HasFactory;

    protected $appends = [
        'progressLabel',
        'settlementStateLabel',
    ];

    protected $fillable = [
        'product_id',
        'user_id',
        'progress',
        'sent_tracking_number',
        'return_tracking_number',
        'settlement_state',
        'subscription_id',
    ];

    public function getProgressLabelAttribute($value)
    {
        return $this->enumLabel($this->progress, "App\Enums\Orders\OrdersProgress");

    }

    public function getSettlementStateLabelAttribute($value)
    {
        return $this->enumLabel($this->settlement_state, "App\Enums\Orders\OrdersSettlementState");
    }

    public static function create(OrderEntity $orderEntity) {
        $entity = (new Order())->fill([
            'product_id' => $orderEntity->getProductId(),
            'user_id' => $orderEntity->getUserId(),
            'progress' => $orderEntity->getProgress(),
            'sent_tracking_number' => $orderEntity->getSentTrackingNumber(),
            'return_tracking_number' => $orderEntity->getReturnTrackingNumber(),
            'settlement_state' => $orderEntity->getSettlementState(),
            'subscription_id' => $orderEntity->getSubscriptionId(),
        ]);
        $entity->save();

        return $entity;
    }

    public static function searchForSubscriptionId(string $subscriptionId): Order {
        return Order::query()->where('subscription_id', '=', $subscriptionId)->first();
    }

    public function updateSettlementState(OrdersSettlementState $state) {
        $entity = $this->fill([
            'settlement_state' => $state,
        ]);
        $entity->save();
        return $entity;
    }

    public function updateProgress(OrdersProgress $progress) {
        $entity = $this->fill([
            'progress' => $progress,
        ]);
        $entity->save();
        return $entity;
    }


}
