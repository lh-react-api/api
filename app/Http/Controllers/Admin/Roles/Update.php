<?php

namespace App\Http\Controllers\Admin\Roles;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Admin\Roles\UpdateRequest;
use App\Models\role;
use App\Models\domains\Roles\RoleEntity;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Collection;

class Update extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param UpdateRequest $request
     * @param int $roleId
     * @return JsonResponse
     */
    public function __invoke(UpdateRequest $request, int $roleId)
    {
        $input = new Collection($request->input());
        $role = Role::find($roleId);
        $this->authorize('adminUpdate', $role);
        $role->put(
            new RoleEntity(
                $input->get('name'),
            )
        );
        return ResponseUtils::success($role);
    }
}
