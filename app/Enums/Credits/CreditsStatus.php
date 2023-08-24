<?php

namespace App\Enums\Credits;

use App\Enums\EnumInterface;
use App\Enums\EnumTrait;

enum CreditsStatus: string implements EnumInterface
{
    use EnumTrait;
    case ENABLE = 'ENABLE';
    case DISABLE = 'DISABLE';
    /**
     * @return string
     */
    public function description(): string
    {
        return match($this) {
            self::ENABLE => '有効',
            self::DISABLE => '無効',
        };
    }
}