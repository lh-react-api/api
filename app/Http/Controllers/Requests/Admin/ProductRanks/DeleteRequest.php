<?php

namespace App\Http\Controllers\Requests\Admin\ProductRanks;


use App\Http\Controllers\Requests\BaseFormRequest;
use App\Models\ProductRank;
use App\Models\Product;


/**
 * Class MemberLoginRequest
 * @package App\Http\Controllers\Requests
 */
class DeleteRequest extends BaseFormRequest
{
    const ROUTE_KEY = 'product_rank_id';
    /**
     * @return bool
     */
    public function authorize()
    {
        $this->existsRecordById((new ProductRank()), (int)$this->route(self::ROUTE_KEY));

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            self::ROUTE_KEY => [
                function($attribute, $value, $fail) {
                    $product = (new Product())->query()->where('product_rank_id', '=' , $value)->get();
                    if (count($product) > 0) {
                        $fail('紐づく商品情報が存在するため削除できません');
                    }
                }
            ]
        ];
    }

    public function validationData()
    {
        return array_merge($this->request->all(), [
            self::ROUTE_KEY => (int)$this->route(self::ROUTE_KEY),
        ]);
    }
}
