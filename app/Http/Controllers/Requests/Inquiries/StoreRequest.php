<?php

namespace App\Http\Controllers\Requests\Inquiries;

use App\Http\Controllers\Requests\BaseFormRequest;
use App\Models\User;
use Illuminate\Validation\Rule;

/**
 * Class MemberLoginRequest
 * @package App\Http\Controllers\Requests
 */
class StoreRequest extends BaseFormRequest
{
    const DEFAULT_NAME = 'お問い合わせ';

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
            'product_id' => ['inquiry_type_id', Rule::exists('inquiry_types', 'id')],
            'email' => ['required', 'max:255', 'email'],
            'text' => ['required'],
        ];
    }
}
