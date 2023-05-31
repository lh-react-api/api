<?php

namespace App\Http\Controllers\Requests\Admin\DeliverTimes;


use App\Http\Controllers\Requests\BaseFormRequest;
use App\Models\Deliver;
use App\Models\DeliverTime;

/**
 * Class MemberLoginRequest
 * @package App\Http\Controllers\Requests
 */
class DeleteRequest extends BaseFormRequest
{
    const ROUTE_KEY = 'deliver_time_id';
    /**
     * @return bool
     */
    public function authorize()
    {
        $this->existsRecordById((new DeliverTime()), (int)$this->route(self::ROUTE_KEY));

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
                    $delivers = (new Deliver)->query()->where('deliver_time_id', '=' , $value)->get();
                    if (count($delivers) > 0) {
                        $fail('紐づく配達情報が存在するため削除できません');
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
