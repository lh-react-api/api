<?php

namespace App\Models\domains\Makers;

use App\Models\domains\BaseDomain;

class MakerEntity extends BaseDomain
{
    public function __construct(
        protected string $name,
        protected string|null $information,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getInfomation(): string|null
    {
        return $this->information;
    }
}