<?php

namespace App\Models\domains\Roles;

use App\Models\domains\BaseDomain;

class RoleEntity extends BaseDomain
{
    public function __construct(
        protected string      $name,
    )
    {
    }

    public function getName(): string
    {
        return $this->name;
    }
}