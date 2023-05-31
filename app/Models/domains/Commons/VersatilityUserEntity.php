<?php

namespace App\Models\domains\Commons;

use App\Models\domains\BaseDomain;

/**
 * 汎用ユーザークラス
 */
class VersatilityUserEntity extends BaseDomain
{
    public function __construct(
        protected string $name,
        protected string $nameKana,
        protected string $phoneNumber,
        protected string $email,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }
    public function getNameKana(): string
    {
        return $this->nameKana;
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