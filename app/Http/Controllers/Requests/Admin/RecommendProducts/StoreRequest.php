<?php

namespace App\Http\Controllers\Requests\Admin\RecommendProducts;

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
            'product_id' => [
                'required',
                Rule::exists('products', 'id'),
                Rule::unique('recommend_products', 'product_id')
            ],
        ];
    }
}
