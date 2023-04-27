<?php

namespace App\Policies;

use App\Exceptions\PolicyException;
use App\Enums\AdminAuthorities\AdminAuthoritiesAction;
use App\Models\AdminAuthority;
use App\Models\Role;
use App\Utilities\AdminAuthorityUtils;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class BasePolicy
{
    use HandlesAuthorization;


    protected function byAuthUser(int $userID) {
        if ($userID !== Auth::id()) {
            throw new PolicyException("", Response::HTTP_FORBIDDEN,
                [__('auth.policy.byAuthUser')]
            );
        }
        return true;
    }

    /**
     * 管理者権限チェック
     *
     * @param AdminAuthoritiesAction $authority
     * @return boolean 権限有無
     */
    protected function byAdminAuthUser(AdminAuthoritiesAction $authority) {
        $role = Role::findNameForId(Str::of(AdminAuthorityUtils::getContorolerName())->snake());
        $adminAuthority = AdminAuthority::findAdminAuthority(Auth::id(), $role[0]->id);
        if (!AdminAuthorityUtils::checkAuthority($adminAuthority[0]->action, $authority)) {
            throw new PolicyException("", Response::HTTP_FORBIDDEN,
                [__('操作権限がありません')]
            );
        }
        return true;        
    }
}
