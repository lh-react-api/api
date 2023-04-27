<?php

namespace App\Http\Controllers\Admin\Roles;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Admin\Roles\DeleteRequest;
use App\Models\Role;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;

class Delete extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param DeleteRequest $request
     * @param int $roleId
     * @return JsonResponse
     */
    public function __invoke(DeleteRequest $request, int $roleId)
    {
        $role = Role::find($roleId);
        $this->authorize('adminDelete', $role);
        $role->delete();

        return ResponseUtils::success(
            $role
        );
    }
}
