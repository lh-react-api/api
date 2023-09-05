<?php

namespace App\Http\Controllers\Requests\Admin\RecommendProducts;

use App\Http\Controllers\Requests\BaseFormRequest;
use App\Models\RecommendProduct;
use Illuminate\Validation\Rule;

/**
 * Class MemberLoginRequest
 * @package App\Http\Controllers\Requests
 */
class UpdateRequest extends BaseFormRequest
{
    const ROUTE_KEY = 'recommend_product_id';
    /**
     * @return bool
     */
    public function authorize()
    {
        $this->existsRecordById((new RecommendProduct), (int)$this->route(self::ROUTE_KEY));

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            'product_id' => [
                'required',
                Rule::exists('products', 'id'),
            ],
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
