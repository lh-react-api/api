<?php

namespace App\Http\Controllers\Requests\Admin\ProductReviews;

use App\Http\Controllers\Requests\BaseFormRequest;
use App\Models\productReview;
use Illuminate\Validation\Rule;

/**
 * Class MemberLoginRequest
 * @package App\Http\Controllers\Requests
 */
class UpdateRequest extends BaseFormRequest
{
    const ROUTE_KEY = 'product_review_id';
    /**
     * @return bool
     */
    public function authorize()
    {
        $this->existsRecordById((new ProductReview), (int)$this->route(self::ROUTE_KEY));

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
