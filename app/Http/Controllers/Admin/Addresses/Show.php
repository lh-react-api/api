<?php

namespace App\Http\Controllers\Admin\Addresses;

use App\Http\Controllers\BaseController;
use App\Models\Address;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Show extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param int $addressId
     * @return JsonResponse
     */
    public function __invoke(Request $request, int $addressId)
    {
        $address = Address::findForShow($addressId);
        $this->authorize('adminView', $address);
        return ResponseUtils::success(
            $address
        );
    }
}
