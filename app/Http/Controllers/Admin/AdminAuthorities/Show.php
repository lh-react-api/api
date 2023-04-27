<?php

namespace App\Http\Controllers\Admin\AdminAuthorities;

use App\Http\Controllers\BaseController;
use App\Models\AdminAuthority;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Show extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param int $adminAuthorityId
     * @return JsonResponse
     */
    public function __invoke(Request $request, int $adminAuthorityId)
    {
        $adminAuthority = AdminAuthority::findForShow($adminAuthorityId);
        $this->authorize('adminView', $adminAuthority);
        return ResponseUtils::success(
            $adminAuthority
        );
    }
}
