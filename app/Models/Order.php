<?php

namespace App\Models;

use App\Models\domains\Orders\OrderEntity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends BaseModel
{
    use HasFactory;

    protected $appends = [
        'progressLabel',
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

}
