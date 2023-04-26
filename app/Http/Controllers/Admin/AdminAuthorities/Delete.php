<?php

namespace App\Http\Controllers\Admin\AdminAuthorities;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Admin\AdminAuthorities\DeleteRequest;
use App\Models\AdminAuthority;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;

class Delete extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param DeleteRequest $request
     * @param int $adminAuthorityId
     * @return JsonResponse
     */
    public function __invoke(DeleteRequest $request, int $adminAuthorityId)
    {
        $adminAuthority = AdminAuthority::find($adminAuthorityId);
        $this->authorize('adminDelete', $adminAuthority);
        $adminAuthority->delete();

        return ResponseUtils::success(
            $adminAuthority
        );
    }
}
