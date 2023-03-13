<?php

namespace App\Enums\Users;

use App\Enums\EnumInterface;
use App\Enums\EnumTrait;

enum UsersStatus: string implements EnumInterface
{
    use EnumTrait;
    case ACTIVE = 'ACTIVE';
    case WITHDRAWAL = 'WITHDRAWAL';

    /**
     * @return string
     */
    public function description(): string
    {
        return match($this) {
            self::ACTIVE => '会員',
            self::WITHDRAWAL => '退会',
        };
    }
}