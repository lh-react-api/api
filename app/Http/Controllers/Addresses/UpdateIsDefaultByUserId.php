<?php

namespace App\Http\Controllers\Addresses;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Addresses\UpdateIsDefaultByUserIdRequest;
use App\Http\Controllers\Requests\Users\UpdateEmailRequest;
use App\Models\User;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;

class UpdateIsDefaultByUserId extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param UpdateEmailRequest $request
     * @param int $userId
     * @return JsonResponse
     */
    public function __invoke(UpdateIsDefaultByUserIdRequest $request, int $userId)
    {
        $user = User::query()->with('addresses')->find($userId);
        $addresses = $user->addresses;
        $address = $user->addresses->where('id', $request->input()['address_id'])->first();

        $this->authorize('update', $address);

        foreach($addresses as $row) {
            $row->is_default = false;
            $row->save();
        }

        $address->is_default = true;
        $address->save();

        return ResponseUtils::success($addresses);
    }
}
