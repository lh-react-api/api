<?php

namespace App\Http\Controllers\Admin\Delivers;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Admin\Delivers\UpdateRequest;
use App\Models\Deliver;
use App\Models\domains\Addresses\AddressContentEntity;
use App\Models\domains\Commons\VersatilityUserEntity;
use App\Models\domains\Delivers\DeliverEntity;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Collection;

class Update extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param UpdateRequest $request
     * @param int $deliverId
     * @return JsonResponse
     */
    public function __invoke(UpdateRequest $request, int $deliverId)
    {
        $input = new Collection($request->input());
        $deliver = Deliver::query()->find($deliverId);
        $this->authorize('adminUpdate', $deliver);
        $deliver->updateEntity(
            new DeliverEntity(
                (int)$input->get('order_id'),
                (int)$input->get('deliver_time_id'),
                new VersatilityUserEntity(
                    $input->get('name'),
                    $input->get('name_kana'),
                    $input->get('phone_number'),
                    $input->get('email'),
                ),
                new AddressContentEntity(
                    $input->get('post_number'),
                    $input->get('prefecture_name'),
                    $input->get('city'),
                    $input->get('block'),
                    $input->get('building') ?? null
                )
            ),
        );
        return ResponseUtils::success($deliver);
    }
}
