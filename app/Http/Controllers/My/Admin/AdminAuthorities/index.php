<?php

namespace App\Http\Controllers\My\Admin\AdminAuthorities;

use App\Http\Controllers\BaseController;
use App\Models\AdminAuthority;
use App\Models\Role;
use App\Utilities\ResponseUtils;
use App\Utilities\AdminAuthorityUtils;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Index extends BaseController
{
    /**
     * 自身のもつ管理者権限を取得し変換して返却する
     *
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user();
        $adminAuthorities = AdminAuthority::query()
            ->where('user_id', $user->id)
            ->get()
        ;
        $adminAuthAry = [];
        foreach ($adminAuthorities as $adminAuthority) {
            $role = Role::find($adminAuthority->role_id);
            $adminAuth = [
                'name'  => $role->name,
                'jaName' => $role->ja_name,
                "authority" => AdminAuthorityUtils::convertAction($adminAuthority->action),
            ];
            array_push($adminAuthAry, $adminAuth);
        }

        return ResponseUtils::success(
            $adminAuthAry
        );
    }
}
