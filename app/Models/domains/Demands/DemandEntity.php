<?php

namespace App\Models\domains\Demands;

use App\Models\domains\BaseDomain;
use App\Models\domains\Addresses\AddressContentEntity;
use App\Models\domains\Commons\VersatilityUserEntity;

class DemandEntity extends BaseDomain
{
    public function __construct(
        protected int $orderId,
        protected VersatilityUserEntity $versatilityUserEntity,
        protected AddressContentEntity $addressContentEntity,
    )
    {
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function getVersatilityUserEntity(): VersatilityUserEntity
    {
        return $this->versatilityUserEntity;
    }

    public function getAddressContentEntity(): AddressContentEntity
    {
        return $this->addressContentEntity;
    }
}