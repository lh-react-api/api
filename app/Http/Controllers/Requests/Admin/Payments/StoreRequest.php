<?php

namespace App\Http\Controllers\Requests\Admin\Payments;

use App\Http\Controllers\Requests\BaseFormRequest;
use App\Enums\Payments\PaymentsSettlementState;
use Illuminate\Validation\Rule;
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
            'order_id' => ['required', Rule::exists('orders', 'id')],
            'credit_id' => ['required', Rule::exists('credits', 'id')],
            'settlement_state' => ['required', new Enum(PaymentsSettlementState::class)],
        ];
    }
}
