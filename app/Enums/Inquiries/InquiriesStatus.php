<?php

namespace App\Enums\Inquiries;

use App\Enums\EnumInterface;
use App\Enums\EnumTrait;

enum InquiriesStatus: string implements EnumInterface
{
    use EnumTrait;
    case YET = 'YET';
    case DOING = 'DOING';
    case COMPLETED = 'COMPLETED';
    case UNNECESSARY = 'UNNECESSARY';
    /**
     * @return string
     */
    public function description(): string
    {
        return match($this) {
            self::YET => '未対応',
            self::DOING => '対応中',
            self::COMPLETED => '対応済み',
            self::UNNECESSARY => '対応不要',
        };
    }
}