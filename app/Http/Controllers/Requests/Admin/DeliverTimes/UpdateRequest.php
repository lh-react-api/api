<?php

namespace App\Http\Controllers\Requests\Admin\DeliverTimes;

use App\Http\Controllers\Requests\BaseFormRequest;
use App\Models\DeliverTime;

/**
 * Class MemberLoginRequest
 * @package App\Http\Controllers\Requests
 */
class UpdateRequest extends BaseFormRequest
{
    const ROUTE_KEY = 'deliver_time_id';
    /**
     * @return bool
     */
    public function authorize()
    {
        $this->existsRecordById((new DeliverTime), (int)$this->route(self::ROUTE_KEY));

        return true;
    }

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
