<?php

namespace App\Http\Controllers\Requests\Admin\Inquiries;

use App\Enums\Inquiries\InquiriesStatus;
use App\Http\Controllers\Requests\BaseFormRequest;
use App\Models\Inquiry;


/**
 * Class MemberLoginRequest
 * @package App\Http\Controllers\Requests
 */
class DeleteRequest extends BaseFormRequest
{
    const ROUTE_KEY = 'inquiry_id';
    /**
     * @return bool
     */
    public function authorize()
    {
        $this->existsRecordById((new Inquiry()), (int)$this->route(self::ROUTE_KEY));

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
                    $status = Inquiry::find($value)->status;
                    if (strtoupper($status) === InquiriesStatus::YET->value || 
                        strtoupper($status) === InquiriesStatus::DOING->value) {
                        $fail('対応未完了のお問い合わせのため削除できません');
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
