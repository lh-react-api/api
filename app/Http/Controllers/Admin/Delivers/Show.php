<?php

namespace App\Http\Controllers\Admin\Delivers;

use App\Http\Controllers\BaseController;
use App\Models\Deliver;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Show extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param int $deliverId
     * @return JsonResponse
     */
    public function __invoke(Request $request, int $deliverId)
    {
        $deliver = Deliver::findForShow($deliverId);
        $this->authorize('adminView', $deliver);
        return ResponseUtils::success(
            $deliver
        );
    }
}
