<?php

namespace App\Enums\Products;

use App\Enums\EnumInterface;
use App\Enums\EnumTrait;

enum ProductsStatus: string implements EnumInterface
{
    use EnumTrait;
    case IN_STOCK = 'in_stock';
    case ON_LEASE = 'on_lease';
    case BLOKEN = 'bloken';
    /**
     * @return string
     */
    public function description(): string
    {
        return match($this) {
            self::IN_STOCK => '在庫あり',
            self::ON_LEASE => 'レンタル中',
            self::BLOKEN => '破損',
        };
    }
}