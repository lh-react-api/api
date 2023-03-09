<?php

namespace App\Enums\Notices;

use App\Enums\EnumInterface;
use App\Enums\EnumTrait;

enum NoticesDivision: string implements EnumInterface
{
    use EnumTrait;
    case IMPORTANT = 'important';
    case NOTICE = 'notice';

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