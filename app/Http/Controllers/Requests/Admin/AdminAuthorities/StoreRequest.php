<?php

namespace App\Http\Controllers\Requests\Admin\AdminAuthorities;

use App\Http\Controllers\Requests\BaseFormRequest;
USE APP\Models\AdminAuthority;
use Illuminate\Validation\Rule;

/**
 * Class MemberLoginRequest
 * @package App\Http\Controllers\Requests
 */
class StoreRequest extends BaseFormRequest
{

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
}
