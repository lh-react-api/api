<?php

namespace App\Http\Controllers\Requests\Admin\Delivers;

use App\Http\Controllers\Requests\BaseFormRequest;
use App\Models\Deliver;
use Illuminate\Validation\Rule;

/**
 * Class MemberLoginRequest
 * @package App\Http\Controllers\Requests
 */
class UpdateRequest extends BaseFormRequest
{
    const ROUTE_KEY = 'deliver_id';
    /**
     * @return bool
     */
    public function authorize()
    {
        $this->existsRecordById((new Deliver), (int)$this->route(self::ROUTE_KEY));

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            'order_id' => ['required', Rule::exists('orders', 'id')],
            'deliver_time_id' => ['required', Rule::exists('deliver_times', 'id')],
            'name' => ['required', 'max:128'],
            'name_kana' => ['required', 'kana', 'max:128'],
            'post_number' => ['required', 'string_num', 'max:7'],
            'prefecture_name' => ['required', 'max:8'],
            'city' => ['required', 'max:24'],
            'block' => ['required', 'max:32'],
            'building' => ['required', 'max:128'],
            'email' => ['required', 'max:255', 'email'],
            'phone_number' => ['required', 'max:32ß'],
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
