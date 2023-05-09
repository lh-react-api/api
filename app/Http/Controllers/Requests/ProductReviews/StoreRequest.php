<?php

namespace App\Http\Controllers\Requests\ProductReviews;

use App\Http\Controllers\Requests\BaseFormRequest;
use App\Models\User;
use Illuminate\Validation\Rule;

/**
 * Class MemberLoginRequest
 * @package App\Http\Controllers\Requests
 */
class StoreRequest extends BaseFormRequest
{
    const DEFAULT_NAME = '商品評価';

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
            'product_id' => ['required', Rule::exists('products', 'id')],
            'user_id' => ['integer', Rule::exists('users', 'id')],
            'title' => ['required', 'max:128'],
            'text' => ['required'],
            'evaluation' => ['required', 'integer', 'min:1', 'max:5'],
        ];
    }
}
