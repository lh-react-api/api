<?php

namespace App\Http\Controllers\Addresses;

use App\Exceptions\DatabaseErrorException;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Addresses\StoreRequest;
use App\Models\Address;
use App\Models\domains\Addresses\AddressContentEntity;
use App\Models\domains\Addresses\AddressEntity;
use App\Models\domains\Addresses\FullNameEntity;
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

        $address = Address::create(new AddressEntity(
            (int)$input->get('user_id'),
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
            )
        ));

        return ResponseUtils::success($address);
    }
}
