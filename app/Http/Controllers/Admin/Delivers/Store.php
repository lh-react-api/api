<?php

namespace App\Http\Controllers\Admin\Delivers;

use App\Exceptions\DatabaseErrorException;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Admin\Delivers\StoreRequest;
use App\Models\Deliver;
use App\Models\domains\Addresses\AddressContentEntity;
use App\Models\domains\Addresses\FullNameEntity;
use App\Models\domains\Delivers\DeliverEntity;
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

        $deliver = Deliver::create(new DeliverEntity(
            $input->get('order_id'),
            $input->get('deliver_time_id'),
            new FullNameEntity(
                $input->get('last_name'),
                $input->get('last_name_kana'),
                $input->get('first_name'),
                $input->get('first_name_kana')
            ),
            new AddressContentEntity(
                $input->get('post_number'),
                $input->get('prefecture_name'),
                $input->get('city'),
                $input->get('block'),
                $input->get('building') ?? null
            ),
            $input->get('phone_number'),
            $input->get('email'),
        ));

        $this->authorize('adminCreate', $deliver);
        return ResponseUtils::success($deliver);
    }
}
