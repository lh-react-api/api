<?php

namespace App\Http\Controllers\Requests\Addresses;

use App\Http\Controllers\Requests\BaseFormRequest;
use App\Models\Address;


/**
 * Class MemberLoginRequest
 * @package App\Http\Controllers\Requests
 */
class DeleteRequest extends BaseFormRequest
{
    const DEFAULT_NAME = '住所';
    const ROUTE_KEY = 'address_id';
    /**
     * @return bool
     */
    public function authorize()
    {
        $this->existsRecordById((new Address), (int)$this->route(self::ROUTE_KEY));

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            self::ROUTE_KEY => [
                // デフォルトは削除できない
                function($attribute, $value, $fail) {
                    $address = Address::find($value);
                    if ($address->is_default) {
                        $fail('この住所はデフォルトのため削除することができません。');
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
