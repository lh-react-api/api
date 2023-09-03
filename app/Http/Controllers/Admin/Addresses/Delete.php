<?php

namespace App\Http\Controllers\Admin\Addresses;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Admin\Addresses\DeleteRequest;
use App\Models\Address;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;

class Delete extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param DeleteRequest $request
     * @param int $addressId
     * @return JsonResponse
     */
    public function __invoke(DeleteRequest $request, int $addressId)
    {
        $address = Address::find($addressId);
        $this->authorize('adminDelete', $address);
        $address->delete();

        return ResponseUtils::success();
    }
}
