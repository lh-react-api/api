<?php

namespace App\Http\Controllers\Admin\Addresses;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Admin\Addresses\UpdateRequest;
use App\Models\Address;
use App\Models\domains\Addresses\AddressContentEntity;
use App\Models\domains\Addresses\AddressEntity;
use App\Models\domains\Addresses\FullNameEntity;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class Update extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param UpdateRequest $request
     * @param int $addressId
     * @return JsonResponse
     */
    public function __invoke(UpdateRequest $request, int $addressId)
    {
        $input = new Collection($request->input());
        $address = Address::find($addressId);
        $this->authorize('adminUpdate', $address);
        $address->put(
            new AddressEntity(
                $address->user_id,
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
                $input->get('phone_number')
            )
        );
        $address->save();

        return ResponseUtils::success($address);
    }
}
