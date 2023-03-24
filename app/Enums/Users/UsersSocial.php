<?php

namespace App\Enums\Users;

use App\Enums\EnumInterface;
use App\Enums\EnumTrait;

enum UsersSocial: string implements EnumInterface
{
    use EnumTrait;
    case GOOGLE = 'GOOGLE';
    case AMAZON = 'AMAZON';

    /**
     * @return string
     */
    public function description(): string
    {
        return match($this) {
            self::GOOGLE => 'Google',
            self::AMAZON => 'Amazon',
        };
    }
}