<?php

namespace App\Http\Controllers\Requests\Admin\InquiryTypes;


use App\Http\Controllers\Requests\BaseFormRequest;
use App\Models\Inquiry;
use App\Models\InquiryType;


/**
 * Class MemberLoginRequest
 * @package App\Http\Controllers\Requests
 */
class DeleteRequest extends BaseFormRequest
{
    const ROUTE_KEY = 'inquiry_type_id';
    /**
     * @return bool
     */
    public function authorize()
    {
        $this->existsRecordById((new InquiryType()), (int)$this->route(self::ROUTE_KEY));

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
                    $inquiries = (new Inquiry())->query()->where('inquiry_type_id', '=' , $value)->get();
                    if (count($inquiries) > 0) {
                        $fail('紐づくお問い合わせ情報が存在するため削除できません');
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
