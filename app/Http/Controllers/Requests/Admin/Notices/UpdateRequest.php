<?php

namespace App\Http\Controllers\Requests\Admin\Notices;

use App\Http\Controllers\Requests\BaseFormRequest;
use App\Models\Notice;
use App\Enums\Notices\NoticesDivision;
use Illuminate\Validation\Rules\Enum;

/**
 * Class MemberLoginRequest
 * @package App\Http\Controllers\Requests
 */
class UpdateRequest extends BaseFormRequest
{
    const ROUTE_KEY = 'notice_id';
    /**
     * @return bool
     */
    public function authorize()
    {
        $this->existsRecordById((new Notice), (int)$this->route(self::ROUTE_KEY));

        return true;
    }

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
