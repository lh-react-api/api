<?php

namespace App\Http\Controllers\Requests\Admin\ProductRanks;

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
            'rank' => ['required', 'max:128'],
            'information' => ['required', 'max:65535'],
            'discount_rate' => ['required', 'numeric'],
            'priority' => ['required', 'integer'],
        ];
    }
}
