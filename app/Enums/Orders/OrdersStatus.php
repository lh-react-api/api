<?php

namespace App\Enums\Orders;

use App\Enums\EnumInterface;
use App\Enums\EnumTrait;

enum OrdersStatus: string implements EnumInterface
{
    use EnumTrait;
    case YET = 'yet';
    case SENT = 'sent';
    case RENTALING = 'rentaling';
    case RETURN = 'return';
    case RECEIPT = 'receipt';
    case CLOSE = 'close';
    /**
     * @return string
     */
    public function description(): string
    {
        return match($this) {
            self::YET => '未処理',
            self::SENT => '発送済み',
            self::RENTALING => 'レンタル中',
            self::RETURN => '返送済み',
            self::RECEIPT => '受け取り済み',
            self::CLOSE => '終了',
        };
    }
}