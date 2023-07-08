<?php

namespace App\Models\domains\Stripe;

use App\Models\domains\BaseDomain;

class MaskCardEntity extends BaseDomain
{
    public function __construct(
        public string       $cardId,
        public string       $brand,
        public string|null  $cvcCheck,
        public int          $expMonth,
        public int          $expYear,
        public string       $last4,
    ){}

    public function getCardId(): string
    {
        return $this->cardId;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function getCVCCheck(): string
    {
        return $this->cvcCheck;
    }

    public function getExpMonth(): int
    {
        return $this->expMonth;
    }

    public function getExpYeay(): int
    {
        return $this->expYear;
    }

    public function getLast4(): string
    {
        return $this->last4;
    }
}