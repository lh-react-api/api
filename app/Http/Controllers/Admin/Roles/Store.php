<?php

namespace App\Http\Controllers\Admin\Roles;

use App\Exceptions\DatabaseErrorException;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Admin\Roles\StoreRequest;
use App\Models\Role;
use App\Models\domains\Roles\RoleEntity;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class Store extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param StoreRequest $request
     * @return JsonResponse
     * @throws DatabaseErrorException
     */
    public function __invoke(StoreRequest $request)
    {

        $input = new Collection($request->input());

        $role = Role::create(new RoleEntity(
            $input->get('name'),
        ));

        $this->authorize('adminCreate', $role);
        return ResponseUtils::success($role);
    }
}
