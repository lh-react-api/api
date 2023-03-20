<?php

namespace App\Enums\Notices;

use App\Enums\EnumInterface;
use App\Enums\EnumTrait;

enum NoticesDivision: string implements EnumInterface
{
    use EnumTrait;
    case IMPORTANT = 'IMPORTANT';
    case NOTICE = 'NOTICE';

    /**
     * @return string
     */
    public function description(): string
    {
        return match($this) {
            self::IMPORTANT => '重要',
            self::NOTICE => 'お知らせ',
        };
    }
}