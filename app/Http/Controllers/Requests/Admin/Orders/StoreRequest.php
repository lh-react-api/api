<?php

namespace App\Http\Controllers\Requests\Admin\Orders;

use App\Http\Controllers\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;
use App\Enums\Orders\OrdersProgress;
use App\Enums\Orders\OrdersSettlementState;
use Illuminate\Validation\Rules\Enum;

/**
 * Class MemberLoginRequest
 * @package App\Http\Controllers\Requests
 */
class StoreRequest extends BaseFormRequest
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            'product_id' => ['required', Rule::exists('products', 'id')],
            'user_id' => ['required', Rule::exists('users', 'id')],
            'credit_id' => ['required', Rule::exists('credits', 'id')],
            'progress' => ['required', new Enum(OrdersProgress::class)],
            'settlement_state' => ['required', new Enum(OrdersSettlementState::class)],
            'subscription_id' => ['required'],
        ];
    }
}
