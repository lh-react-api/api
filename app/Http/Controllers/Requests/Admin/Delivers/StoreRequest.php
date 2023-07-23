<?php

namespace App\Http\Controllers\Requests\Admin\Delivers;

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
            'deliver_time_id' => ['required', Rule::exists('deliver_times', 'id')],
            'last_name' => ['required', 'max:128'],
            'last_name_kana' => ['required', 'kana', 'max:128'],
            'first_name' => ['required', 'max:128'],
            'first_name_kana' => ['required', 'kana', 'max:128'],
            'post_number' => ['required', 'string_num', 'max:7'],
            'prefecture_name' => ['required', 'max:8'],
            'city' => ['required', 'max:24'],
            'block' => ['required', 'max:32'],
            'building' => ['required', 'max:128'],
            'phone_number' => ['required', 'max:32'],
        ];
    }
}
