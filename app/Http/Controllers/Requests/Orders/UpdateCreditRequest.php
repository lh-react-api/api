<?php

namespace App\Http\Controllers\Requests\Orders;

use App\Http\Controllers\Requests\BaseFormRequest;
use App\Models\Order;
use Illuminate\Validation\Rule;

/**
 * Class MemberLoginRequest
 * @package App\Http\Controllers\Requests
 */
class UpdateCreditRequest extends BaseFormRequest
{
    const ROUTE_KEY = 'order_id';

    public function authorize()
    {
        $this->existsRecordById((new Order()), (int)$this->route(self::ROUTE_KEY));
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            'credit_id' => ['required', Rule::exists('credits', 'id')],
        ];
    }
}
