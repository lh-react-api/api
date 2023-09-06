<?php

namespace App\Http\Controllers\Admin\Demands;

use App\Exceptions\DatabaseErrorException;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Admin\Demands\StoreRequest;
use App\Models\Demand;
use App\Models\domains\Demands\DemandEntity;
use App\Models\domains\Addresses\FullNameEntity;
use App\Models\domains\Addresses\AddressContentEntity;
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

        $demand = Demand::create(new DemandEntity(
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

        $this->authorize('adminCreate', $demand);
        return ResponseUtils::success($demand);
    }
}
