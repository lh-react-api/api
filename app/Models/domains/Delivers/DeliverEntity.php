<?php

namespace App\Models\domains\Delivers;

use App\Models\domains\BaseDomain;
use App\Models\domains\Addresses\AddressContentEntity;
use App\Models\domains\Addresses\FullNameEntity;

class DeliverEntity extends BaseDomain
{
    public function __construct(
        protected int $orderId,
        protected int $deliverTimeId,
        protected FullNameEntity $fullNameEntity,
        protected AddressContentEntity $addressContentEntity,
        protected string $phoneNumber,
        protected string $email
    )
    {
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function getDeliverTimeId(): string
    {
        return $this->deliverTimeId;
    }

    public function getFullNameEntity(): FullNameEntity
    {
        return $this->fullNameEntity;
    }

    public function getAddressContentEntity(): AddressContentEntity
    {
        return $this->addressContentEntity;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

}