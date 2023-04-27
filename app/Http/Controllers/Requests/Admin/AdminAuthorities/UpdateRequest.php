<?php

namespace App\Http\Controllers\Requests\Admin\AdminAuthorities;

use App\Http\Controllers\Requests\BaseFormRequest;
use App\Models\AdminAuthority;
use Illuminate\Validation\Rule;


/**
 * Class MemberLoginRequest
 * @package App\Http\Controllers\Requests
 */
class UpdateRequest extends BaseFormRequest
{
    const ROUTE_KEY = 'admin_authority_id';
    /**
     * @return bool
     */
    public function authorize()
    {
        $this->existsRecordById((new AdminAuthority), (int)$this->route(self::ROUTE_KEY));

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            'user_id' => ['required', Rule::exists('users', 'id')],
            'role_id' => ['required', Rule::exists('roles', 'id')],
            'action' => ['required'],
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
