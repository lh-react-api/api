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
            self::AMEX => 'amex',
            self::DINERS => 'diners',
            self::DISCOVER => 'discover',
            self::EFTPOS_AU => 'eftpos_au',
            self::JCB => 'jcb',
            self::MASTERCARD => 'mastercard',
            self::UNIONPAY => 'unionpay',
            self::VISA => 'visa',
            self::UNKNOWN => 'unknown',
        };
    }
}