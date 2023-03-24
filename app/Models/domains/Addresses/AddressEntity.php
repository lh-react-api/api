<?php

namespace App\Models\domains\Addresses;

use App\Models\domains\BaseDomain;

class AddressEntity extends BaseDomain
{
    public function __construct(
        protected int $userId,
        protected FullNameEntity $fullName,
        protected AddressContentEntity $addressContentEntity,
    ) {
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
    public function getFullName(): FullNameEntity
    {
        return $this->fullName;
    }
    public function getAddressContentEntity(): AddressContentEntity
    {
        return $this->addressContentEntity;
    }

}