<?php

namespace App\Http\Controllers\Admin\AdminAuthorities;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Admin\AdminAuthorities\UpdateRequest;
use App\Models\AdminAuthority;
use App\Models\domains\AdminAuthorities\AdminAuthorityEntity;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class Update extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param UpdateRequest $request
     * @param int $userId
     * @param int $adminAuthorityId
     * @return JsonResponse
     */
    public function __invoke(UpdateRequest $request,int $adminAuthorityId)
    {
        $input = new Collection($request->input());
        $adminAuthority = AdminAuthority::find($adminAuthorityId);
        $this->authorize('adminUpdate', $adminAuthority);
        $adminAuthority->put(
            new AdminAuthorityEntity(
                $input->get('user_id'),
                $input->get('role_id'),
                $input->get('action')
            )
        );
        return ResponseUtils::success($adminAuthority);
    }
}
