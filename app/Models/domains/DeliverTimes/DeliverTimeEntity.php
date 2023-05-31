<?php

namespace App\Models\domains\DeliverTimes   ;

use App\Models\domains\BaseDomain;

class DeliverTimeEntity extends BaseDomain
{
    public function __construct(
        protected string $deliverTime,
        protected int $order,
        protected string $deadline,
    ) {
    }

    public function getDeliverTime(): string
    {
        return $this->deliverTime;
    }

    public function getOrder(): int
    {
        return $this->order;
    }

    public function getDeadline(): string
    {
        return $this->deadline;
    }
}