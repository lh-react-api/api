<?php

namespace App\Http\Controllers\Requests\My\User;

use App\Http\Controllers\Requests\BaseFormRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


/**
 * Class MemberLoginRequest
 * @package App\Http\Controllers\Requests
 */
class UpdateEmailRequest extends BaseFormRequest
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
            'password' => ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->getAuthPassword())){
                    $fail("パスワードが正しくありません。");
                }
            }],
            'email' => ['required', 'max:255', 'email', Rule::unique((new User)->getTable())->ignore((int)$this->route(self::ROUTE_KEY))],
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
