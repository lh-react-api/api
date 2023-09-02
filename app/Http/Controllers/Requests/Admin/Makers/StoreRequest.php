<?php

namespace App\Http\Controllers\Requests\Admin\Makers;

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
            'name' => ['required', 'max:255'],
            'information' => ['nullable'],
        ];
    }
}
