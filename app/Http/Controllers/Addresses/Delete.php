<?php

namespace App\Http\Controllers\Addresses;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Addresses\DeleteRequest;
use App\Models\Address;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;

class Delete extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param DeleteRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function __invoke(DeleteRequest $request, int $id)
    {
        $address = Address::find($id);

        $this->authorize('delete', $address);

        $address->delete();

        return ResponseUtils::success();
    }
}
