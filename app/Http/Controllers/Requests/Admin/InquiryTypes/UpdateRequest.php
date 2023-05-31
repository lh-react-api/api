<?php

namespace App\Http\Controllers\Requests\Admin\InquiryTypes;

use App\Http\Controllers\Requests\BaseFormRequest;
use App\Models\InquiryType;

/**
 * Class MemberLoginRequest
 * @package App\Http\Controllers\Requests
 */
class UpdateRequest extends BaseFormRequest
{
    const ROUTE_KEY = 'inquiry_type_id';
    /**
     * @return bool
     */
    public function authorize()
    {
        $this->existsRecordById((new InquiryType), (int)$this->route(self::ROUTE_KEY));

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            'text' => ['required', 'max:128'],
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
