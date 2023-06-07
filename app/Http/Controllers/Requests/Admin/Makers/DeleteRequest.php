<?php

namespace App\Http\Controllers\Requests\Admin\makers;


use App\Http\Controllers\Requests\BaseFormRequest;
use App\Models\Maker;
use App\Models\ProductOrigin;

/**
 * Class MemberLoginRequest
 * @package App\Http\Controllers\Requests
 */
class DeleteRequest extends BaseFormRequest
{
    const ROUTE_KEY = 'maker_id';
    /**
     * @return bool
     */
    public function authorize()
    {
        $this->existsRecordById((new Maker()), (int)$this->route(self::ROUTE_KEY));

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
                    $productOrigins = (new ProductOrigin())->query()->where('maker_id', '=' , $value)->get();
                    if (count($productOrigins) > 0) {
                        $fail('紐づく商品原本情報が存在するため削除できません');
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
