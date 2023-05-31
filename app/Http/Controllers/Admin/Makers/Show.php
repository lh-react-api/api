<?php

namespace App\Http\Controllers\Admin\Makers;

use App\Http\Controllers\BaseController;
use App\Models\Maker;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Show extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param int $makerId
     * @return JsonResponse
     */
    public function __invoke(Request $request, int $makerId)
    {
        $maker = Maker::findForShow($makerId);
        $this->authorize('adminView', $maker);
        return ResponseUtils::success(
            $maker
        );
    }
}
