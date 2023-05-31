<?php

namespace App\Models\domains\Credits;

use App\Models\domains\BaseDomain;

class CreditEntity extends BaseDomain
{
    public function __construct(
        protected int $userId,
        protected string $stripeCustomerId,
    ) {
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getStripeCustmerId(): string
    {
        return $this->stripeCustomerId;
    }

}