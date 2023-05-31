<?php

namespace App\Http\Controllers\Requests\Admin\Roles;


use App\Http\Controllers\Requests\BaseFormRequest;
use App\Models\AdminAuthority;
use App\Models\Role;


/**
 * Class MemberLoginRequest
 * @package App\Http\Controllers\Requests
 */
class DeleteRequest extends BaseFormRequest
{
    const ROUTE_KEY = 'roles_id';
    /**
     * @return bool
     */
    public function authorize()
    {
        $this->existsRecordById((new Role()), (int)$this->route(self::ROUTE_KEY));

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
                    $productOrigins = (new AdminAuthority())->query()->where('role_id', '=' , $value)->get();
                    if (count($productOrigins) > 0) {
                        $fail('紐づく管理者権限情報が存在するため削除できません');
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
