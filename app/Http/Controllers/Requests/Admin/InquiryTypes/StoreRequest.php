<?php

namespace App\Http\Controllers\Requests\Admin\InquiryTypes;

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
            'text' => ['required', 'max:128'],
        ];
    }
}
