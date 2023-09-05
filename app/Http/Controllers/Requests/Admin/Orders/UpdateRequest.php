<?php

namespace App\Http\Controllers\Requests\Admin\Orders;

use App\Http\Controllers\Requests\BaseFormRequest;
use App\Models\Order;
use Illuminate\Validation\Rule;
use App\Enums\Orders\OrdersProgress;
use App\Enums\Orders\OrdersSettlementState;
use Illuminate\Validation\Rules\Enum;

/**
 * Class MemberLoginRequest
 * @package App\Http\Controllers\Requests
 */
class UpdateRequest extends BaseFormRequest
{
    const ROUTE_KEY = 'order_id';
    /**
     * @return bool
     */
    public function authorize()
    {
        $this->existsRecordById((new Order), (int)$this->route(self::ROUTE_KEY));

        return true;
    }

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
