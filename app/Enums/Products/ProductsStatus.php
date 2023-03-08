<?php

namespace App\Enums\Products;

use App\Enums\EnumInterface;
use App\Enums\EnumTrait;

enum ProductsStatus: string implements EnumInterface
{
    use EnumTrait;
    case STOCK = 'stock';
    case RENT = 'rent';
    case JUNK = 'junk';
    /**
     * @return string
     */
    public function description(): string
    {
        return match($this) {
            self::STOCK => '在庫あり',
            self::RENT => 'レンタル中',
            self::JUNK => '破損',
        };
    }
}