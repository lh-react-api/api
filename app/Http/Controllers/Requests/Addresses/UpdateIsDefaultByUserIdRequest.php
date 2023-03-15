<?php

namespace App\Http\Controllers\Requests\Addresses;

use App\Http\Controllers\Requests\BaseFormRequest;
use App\Models\User;
use Illuminate\Validation\Rule;


/**
 * Class MemberLoginRequest
 * @package App\Http\Controllers\Requests
 */
class UpdateIsDefaultByUserIdRequest extends BaseFormRequest
{
    const DEFAULT_NAME = 'ユーザ';
    const ROUTE_KEY = 'user_id';
    /**
     * @return bool
     */
    public function authorize()
    {
        $this->existsRecordById((new User), (int)$this->route(self::ROUTE_KEY));

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            'address_id' => ['required', Rule::exists('addresses', 'id')->where('user_id', (int)$this->user_id)]
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
