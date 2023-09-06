<?php

namespace App\Http\Controllers\Admin\Demands;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Admin\Demands\UpdateRequest;
use App\Models\Demand;
use App\Models\domains\Demands\DemandEntity;
use App\Models\domains\Addresses\FullNameEntity;
use App\Models\domains\Addresses\AddressContentEntity;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class Update extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param UpdateRequest $request
     * @param int $demandId
     * @return JsonResponse
     */
    public function __invoke(UpdateRequest $request, int $demandId)
    {
        $input = new Collection($request->input());
        $demand = Demand::find($demandId);
        $this->authorize('adminUpdate', $demand);
        $demand->put(new DemandEntity(
            $input->get('order_id'),
            new FullNameEntity(
                $input->get('last_name'),
                $input->get('last_name_kana'),
                $input->get('first_name'),
                $input->get('first_name_kana'),
            ),
            new AddressContentEntity(
                $input->get('post_number'),
                $input->get('prefecture_name'),
                $input->get('city'),
                $input->get('block'),
                $input->get('building') ?? '',
            ),
            $input->get('phone_number'),
            $input->get('email'),
        ));
        $demand->save();

        return ResponseUtils::success($demand);
    }
}
