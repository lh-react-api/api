<?php

namespace App\Http\Controllers\Requests\Admin\Demands;

use App\Http\Controllers\Requests\BaseFormRequest;
use App\Models\Demand;
use Illuminate\Validation\Rule;

/**
 * Class MemberLoginRequest
 * @package App\Http\Controllers\Requests
 */
class UpdateRequest extends BaseFormRequest
{
    const ROUTE_KEY = 'demand_id';
    /**
     * @return bool
     */
    public function authorize()
    {
        $this->existsRecordById((new Demand), (int)$this->route(self::ROUTE_KEY));

        return true;
    }

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
