<?php

namespace App\Models\domains\Stripe;

use App\Models\domains\BaseDomain;

class SubscriptionMailEntity extends BaseDomain
{
    public function __construct(
        public string       $product,
        public string       $amount = '',
        public string       $date = '',
        public string       $brand = '',
        public string       $last4 = '',
    ){}

    public function getProduct(): string
    {
        return $this->product;
    }

    public function getAmount(): string
    {
        return $this->amount;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function getLast4(): string
    {
        return $this->last4;
    }
}