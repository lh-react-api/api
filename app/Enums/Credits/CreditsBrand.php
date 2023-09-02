<?php

namespace App\Enums\Credits;

use App\Enums\EnumInterface;
use App\Enums\EnumTrait;

/**
 * 引用元
 * https://stripe.com/docs/api/errors#errors-payment_method-card
 */
enum CreditsBrand: string implements EnumInterface
{
    use EnumTrait;
    case AMEX = 'amex';
    case DINERS = 'diners';
    case DISCOVER = 'discover';
    case EFTPOS_AU = 'eftpos_au';
    case JCB = 'jcb';
    case MASTERCARD = 'mastercard';
    case UNIONPAY = 'unionpay';
    case VISA = 'visa';
    case UNKNOWN = 'unknown';
    /**
     * @return string
     */
    public function description(): string
    {
        return match($this) {
            self::AMEX => 'AmericanExpress',
            self::DINERS => 'DinersClub',
            self::DISCOVER => 'Discover',
            self::EFTPOS_AU => 'EFTPOS(Australia)',
            self::JCB => 'JCB',
            self::MASTERCARD => 'Mastercard',
            self::UNIONPAY => 'UnionPay',
            self::VISA => 'Visa',
            self::UNKNOWN => 'Unknown',
        };
    }
}