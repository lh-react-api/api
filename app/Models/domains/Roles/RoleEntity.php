<?php

namespace App\Models\domains\Roles;

use App\Models\domains\BaseDomain;

class RoleEntity extends BaseDomain
{
    public function __construct(
        protected string      $name,
        protected string      $ja_name,
    )
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getJaName(): string
    {
        return $this->ja_name;
    }
}