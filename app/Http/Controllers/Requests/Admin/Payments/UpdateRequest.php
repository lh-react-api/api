<?php

namespace App\Http\Controllers\Requests\Admin\Payments;

use App\Http\Controllers\Requests\BaseFormRequest;
use App\Enums\Payments\PaymentsSettlementState;
use App\Models\Payment;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

/**
 * Class MemberLoginRequest
 * @package App\Http\Controllers\Requests
 */
class UpdateRequest extends BaseFormRequest
{
    const ROUTE_KEY = 'payment_id';
    /**
     * @return bool
     */
    public function authorize()
    {
        $this->existsRecordById((new Payment), (int)$this->route(self::ROUTE_KEY));

        return true;
    }

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

    public function attributes()
    {
        return [];
    }

    public function validationData()
    {
        return array_merge($this->request->all(), [
            self::ROUTE_KEY => (int)$this->route(self::ROUTE_KEY),
        ]);
    }
}
