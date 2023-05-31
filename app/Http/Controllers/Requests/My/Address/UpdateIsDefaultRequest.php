<?php

namespace App\Http\Controllers\Requests\My\Address;

use App\Http\Controllers\Requests\BaseFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


/**
 * Class MemberLoginRequest
 * @package App\Http\Controllers\Requests
 */
class UpdateIsDefaultRequest extends BaseFormRequest
{
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
            'address_id' => ['required', Rule::exists('addresses', 'id')->where('user_id', Auth::id())]
        ];
    }

    public function attributes()
    {
        return [];
    }
}
