<?php

namespace App\Models\domains\Addresses;

use App\Models\domains\BaseDomain;

class AddressContentEntity extends BaseDomain
{
    public function __construct(
        protected string      $postNumber,
        protected string      $prefectureName,
        protected string      $city,
        protected string      $block,
        protected string|null $building,
    )
    {
    }

    public function getPostNumber(): string
    {
        return $this->postNumber;
    }

    public function getPrefectureName(): string
    {
        return $this->prefectureName;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getBlock(): string
    {
        return $this->block;
    }

        public function getBuilding(): string|null
    {
        return $this->building ?? null;
    }
}