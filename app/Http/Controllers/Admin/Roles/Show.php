<?php

namespace App\Http\Controllers\Admin\Roles;

use App\Http\Controllers\BaseController;
use App\Models\Role;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Show extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param int $roleId
     * @return JsonResponse
     */
    public function __invoke(Request $request, int $roleId)
    {
        $role = Role::findForShow($roleId);
        $this->authorize('adminView', $role);
        return ResponseUtils::success(
            $role
        );
    }
}
