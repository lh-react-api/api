<?php

namespace App\Http\Controllers\Admin\DeliverTimes;

use App\Exceptions\DatabaseErrorException;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Admin\DeliverTimes\StoreRequest;
use App\Models\DeliverTime;
use App\Models\domains\DeliverTimes\DeliverTimeEntity;
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

        $deliverTime = DeliverTime::create(new DeliverTimeEntity(
            $input->get('deliver_time'),
            $input->get('order'),
            $input->get('deadline'),
        ));

        $this->authorize('adminCreate', $deliverTime);
        return ResponseUtils::success($deliverTime);
    }
}
