<?php

namespace App\Http\Controllers\Admin\DeliverTimes;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Admin\DeliverTimes\UpdateRequest;
use App\Models\DeliverTime;
use App\Models\domains\DeliverTimes\DeliverTimeEntity;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class Update extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param UpdateRequest $request
     * @param int $deliverTimeId
     * @return JsonResponse
     */
    public function __invoke(UpdateRequest $request, int $deliverTimeId)
    {
        $input = new Collection($request->only(['deliver_time','order','deadline']));
        $deliverTime = DeliverTime::find($deliverTimeId);
        $this->authorize('adminUpdate', $deliverTime);
        $deliverTime->put(
            new DeliverTimeEntity(
                $input->get('deliver_time'),
                $input->get('order'),
                $input->get('deadline')
            )
        );
        return ResponseUtils::success($deliverTime);
    }
}
