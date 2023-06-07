<?php

namespace App\Http\Controllers\Requests\Admin\ProductRanks;

use App\Http\Controllers\Requests\BaseFormRequest;
use App\Models\ProductRank;

/**
 * Class MemberLoginRequest
 * @package App\Http\Controllers\Requests
 */
class UpdateRequest extends BaseFormRequest
{
    const ROUTE_KEY = 'product_rank_id';
    /**
     * @return bool
     */
    public function authorize()
    {
        $this->existsRecordById((new ProductRank), (int)$this->route(self::ROUTE_KEY));

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            'rank' => ['required', 'max:128'],
            'information' => ['required', 'max:255'],
            'discount_rate' => ['required', 'numeric'],
            'priority' => ['required', 'integer'],
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
