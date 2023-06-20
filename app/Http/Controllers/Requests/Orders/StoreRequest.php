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
            'stripe_card_id' => ['required', 'regex:/^card_.*$/'],
            'deliver_info'  => ['required'],
            'demand_info' =>  ['required'],
        ];
    }
}
