<?php

namespace App\Http\Controllers\Requests\Admin\Inquiries;

use App\Enums\Inquiries\InquiriesStatus;
use App\Http\Controllers\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

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
            'inquiry_type_id' => ['required', Rule::exists('inquiry_types', 'id')],
            'email' => ['required', 'max:256'],
            'text' => ['required'],
            'status' => ['required', 'max:128', new Enum(InquiriesStatus::class)],
        ];
    }
}
