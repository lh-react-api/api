<?php

namespace App\Http\Controllers\Requests\My\User;

use App\Http\Controllers\Requests\BaseFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


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
            'old_password' => ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->getAuthPassword())){
                    $fail("パスワードが正しくありません。");
                }
            }],
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
