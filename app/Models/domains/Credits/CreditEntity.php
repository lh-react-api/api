<?php

namespace App\Models\domains\Credits;

use App\Models\domains\BaseDomain;
use App\Enums\Credits\CreditsStatus;

class CreditEntity extends BaseDomain
{
    public function __construct(
        protected int $userId,
        protected string $paymentsSource,
        protected CreditsStatus|string $status,
    ) {
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getPaymentSource(): string
    {
        return $this->paymentsSource;
    }

    public function getStatus(): CreditsStatus
    {
        return $this->status;
    }

}