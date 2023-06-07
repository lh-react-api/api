<?php

namespace App\Http\Controllers\Requests\Admin\DeliverTimes;

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
            'deliver_time' => ['required', 'max:32'],
            'order' => ['required'],
            'deadline' => ['required', 'max:32'],
        ];
    }
}
