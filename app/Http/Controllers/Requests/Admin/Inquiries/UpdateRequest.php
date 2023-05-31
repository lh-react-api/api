<?php

namespace App\Http\Controllers\Requests\Admin\Inquiries;

use App\Enums\Inquiries\InquiriesStatus;
use App\Http\Controllers\Requests\BaseFormRequest;
use Illuminate\Validation\Rules\Enum;
use App\Models\Inquiry;

/**
 * Class MemberLoginRequest
 * @package App\Http\Controllers\Requests
 */
class UpdateRequest extends BaseFormRequest
{
    const ROUTE_KEY = 'inquiry_id';
    /**
     * @return bool
     */
    public function authorize()
    {
        $this->existsRecordById((new Inquiry), (int)$this->route(self::ROUTE_KEY));

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            'email' => ['required', 'max:256'],
            'text' => ['required'],
            'status' => ['required', 'max:128', new Enum(InquiriesStatus::class)]
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
