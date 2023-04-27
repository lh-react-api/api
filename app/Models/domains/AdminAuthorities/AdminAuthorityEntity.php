<?php

namespace App\Models\domains\AdminAuthorities;

use App\Models\domains\BaseDomain;

class AdminAuthorityEntity extends BaseDomain
{
    public function __construct(
        protected int $userId,
        protected int $roleId,
        protected int $action,
    ) {
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getRoleId(): int
    {
        return $this->roleId;
    }

    public function getAction(): int
    {
        return $this->action;
    }
}