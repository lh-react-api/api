<?php

namespace App\Http\Controllers\Requests\Admin\Addresses;

use App\Http\Controllers\Requests\BaseFormRequest;
use App\Models\Address;
use App\Enums\Addresses\NoticesDivision;
use Illuminate\Validation\Rules\Enum;

/**
 * Class MemberLoginRequest
 * @package App\Http\Controllers\Requests
 */
class UpdateRequest extends BaseFormRequest
{
    const ROUTE_KEY = 'address_id';
    /**
     * @return bool
     */
    public function authorize()
    {
        $this->existsRecordById((new Address), (int)$this->route(self::ROUTE_KEY));

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            'last_name' => ['required', 'max:128'],
            'last_name_kana' => ['required', 'kana', 'max:128'],
            'first_name' => ['required', 'max:128'],
            'first_name_kana' => ['required', 'kana', 'max:128'],
            'post_number' => ['required', 'string_num', 'max:7'],
            'prefecture_name' => ['required', 'max:8'],
            'city' => ['required', 'max:24'],
            'block' => ['required', 'max:32'],
            'building' => ['max:128'],
            'phone_number' => ['required', 'max:32'],
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
