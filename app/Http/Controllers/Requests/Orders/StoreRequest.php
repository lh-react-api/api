<?php

namespace App\Http\Controllers\Requests\Orders;

use App\Http\Controllers\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

/**
 * Class MemberLoginRequest
 * @package App\Http\Controllers\Requests
 */
class StoreRequest extends BaseFormRequest
{

    public function authorize()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            'product_id' => ['required', Rule::exists('products', 'id')],
            'credit_id' => ['required', Rule::exists('credits', 'id')],
            'deliver_address_id'  => ['required', Rule::exists('addresses', 'id')],
            'deliver_time_id'  => ['required', Rule::exists('deliver_times', 'id')],
            'demand_address_id'  => ['required', Rule::exists('addresses', 'id')],
        ];
    }
}
