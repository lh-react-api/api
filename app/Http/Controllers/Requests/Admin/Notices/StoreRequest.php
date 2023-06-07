<?php

namespace App\Http\Controllers\Requests\Admin\Notices;

use App\Http\Controllers\Requests\BaseFormRequest;
use App\Enums\Notices\NoticesDivision;
use Illuminate\Validation\Rules\Enum;

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
            'division' => ['required', new Enum(NoticesDivision::class)],
            'title' => ['required', 'max:128'],
            'text' => ['required'],
            'notice_date' => ['required', 'date', 'after:yesterday'],
            'close_date' => ['required', 'date', 'after:notice_date'],
        ];
    }
}
