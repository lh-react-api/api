<?php

namespace App\Http\Controllers\Admin\DeliverTimes;

use App\Http\Controllers\BaseController;
use App\Models\DeliverTime;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Show extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param int $deliverTimeId
     * @return JsonResponse
     */
    public function __invoke(Request $request, int $deliverTimeId)
    {
        $deliverTime = DeliverTime::findForShow($deliverTimeId);
        $this->authorize('adminView', $deliverTime);
        return ResponseUtils::success(
            $deliverTime
        );
    }
}
