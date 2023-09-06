<?php

namespace App\Http\Controllers\Requests\Admin\Demands;

use App\Http\Controllers\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

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
            'last_name' => ['required'],
            'last_name_kana' => ['required'],
            'first_name' => ['required'],
            'first_name_kana' => ['required'],
            'post_number' => ['required'],
            'prefecture_name' => ['required'],
            'city' => ['required'],
            'block' => ['required'],
            'phone_number' => ['required'],
            'email' => ['required'],
        ];
    }
}
