<?php

namespace App\Http\Controllers\Requests\My\Credit;

use App\Http\Controllers\Requests\BaseFormRequest;

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
            'token' => ['required'],
        ];
    }
}
