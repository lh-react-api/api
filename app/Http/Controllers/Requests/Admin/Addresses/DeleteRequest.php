<?php

namespace App\Http\Controllers\Requests\Admin\Addresses;


use App\Http\Controllers\Requests\BaseFormRequest;
use App\Models\Address;


/**
 * Class MemberLoginRequest
 * @package App\Http\Controllers\Requests
 */
class DeleteRequest extends BaseFormRequest
{
    const ROUTE_KEY = 'address_id';
    /**
     * @return bool
     */
    public function authorize()
    {
        $this->existsRecordById((new Address()), (int)$this->route(self::ROUTE_KEY));

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            self::ROUTE_KEY => []
        ];
    }

    public function validationData()
    {
        return array_merge($this->request->all(), [
            self::ROUTE_KEY => (int)$this->route(self::ROUTE_KEY),
        ]);
    }
}
