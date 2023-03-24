<?php

namespace App\Models\domains\Addresses;

use App\Models\domains\BaseDomain;

class FullNameEntity extends BaseDomain
{
    public function __construct(
        protected string $lastName,
        protected string $lastNameKana,
        protected string $firstName,
        protected string $firstNameKana,
    ) {
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }
    public function getLastNameKana(): string
    {
        return $this->lastNameKana;
    }
    public function getFirstName(): string
    {
        return $this->firstName;
    }
    public function getFirstNameKana(): string
    {
        return $this->firstNameKana;
    }
}