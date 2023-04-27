<?php

namespace App\Http\Controllers\Requests\Admin\Roles;

use App\Http\Controllers\Requests\BaseFormRequest;
use App\Models\Role;

/**
 * Class MemberLoginRequest
 * @package App\Http\Controllers\Requests
 */
class UpdateRequest extends BaseFormRequest
{
    const ROUTE_KEY = 'roles_id';
    /**
     * @return bool
     */
    public function authorize()
    {
        $this->existsRecordById((new Role), (int)$this->route(self::ROUTE_KEY));

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:255'],
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
