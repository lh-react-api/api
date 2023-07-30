<?php

namespace App\Enums\Payments;

use App\Enums\EnumInterface;
use App\Enums\EnumTrait;

enum PaymentsSettlementState: string implements EnumInterface
{
    use EnumTrait;
    case PROCESSING = 'PROCESSING';
    case SUCCESS = 'SUCCESS';
    case FAILED = 'FAILED';
    /**
     * @return string
     */
    public function description(): string
    {
        return match($this) {
            self::PROCESSING => '処理中',
            self::SUCCESS => '成功',
            self::FAILED => '失敗',
        };
    }
}