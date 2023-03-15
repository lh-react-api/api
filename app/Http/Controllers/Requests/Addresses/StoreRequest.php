<?php

namespace App\Http\Controllers\Requests\Addresses;

use App\Http\Controllers\Requests\BaseFormRequest;
use App\Models\User;
use Illuminate\Validation\Rule;

/**
 * Class MemberLoginRequest
 * @package App\Http\Controllers\Requests
 */
class StoreRequest extends BaseFormRequest
{
    const DEFAULT_NAME = '住所';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
//            'name' => ['required', 'max:255'],
//            'email' => ['required', 'max:255', 'email', Rule::unique((new User)->getTable())],
//            'password' => ['required', 'max:255'],
        ];
    }

    public function attributes()
    {
        return [
            'name' => self::DEFAULT_NAME. "名",
        ];
    }
}
