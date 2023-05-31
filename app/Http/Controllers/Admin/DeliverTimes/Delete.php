<?php

namespace App\Http\Controllers\Admin\DeliverTimes;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Admin\DeliverTimes\DeleteRequest;
use App\Models\DeliverTime;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;

class Delete extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param DeleteRequest $request
     * @param int $deliverTimeId
     * @return JsonResponse
     */
    public function __invoke(DeleteRequest $request, int $deliverTimeId)
    {
        $deliverTime = DeliverTime::find($deliverTimeId);
        $this->authorize('adminDelete', $deliverTime);
        $deliverTime->delete();

        return ResponseUtils::success(
            $deliverTime
        );
    }
}
