<?php

namespace App\Http\Controllers\Requests\My\User;

use App\Http\Controllers\Requests\BaseFormRequest;


/**
 * Class MemberLoginRequest
 * @package App\Http\Controllers\Requests
 */
class UpdatePasswordRequest extends BaseFormRequest
{
    const DEFAULT_NAME = 'ユーザ';
    const ROUTE_KEY = 'user_id';
    /**
     * @return bool
     */
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
            'password' => ['required', 'max:255'],
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