<?php

namespace App\Enums\Orders;

use App\Enums\EnumInterface;
use App\Enums\EnumTrait;

enum OrdersProgress: string implements EnumInterface
{
    use EnumTrait;
    case YET = 'YET';
    case SENT = 'SENT';
    case RENTALING = 'RENTALING';
    case STOP = 'STOP';
    case RETURN = 'RETURN';
    case RECEIPT = 'RECEIPT';
    case CLOSE = 'CLOSE';
    /**
     * @return string
     */
    public function description(): string
    {
        return match($this) {
            self::YET => '未処理',
            self::SENT => '発送済み',
            self::RENTALING => 'レンタル中',
            self::STOP => 'レンタル停止済み',
            self::RETURN => '返送済み',
            self::RECEIPT => '受け取り済み',
            self::CLOSE => '終了',
        };
    }
}