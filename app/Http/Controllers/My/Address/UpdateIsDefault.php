<?php

namespace App\Http\Controllers\My\Address;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\My\Address\UpdateIsDefaultRequest;
use App\Http\Controllers\Requests\Users\UpdateEmailRequest;
use App\Models\User;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UpdateIsDefault extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param UpdateEmailRequest $request
     * @param int $userId
     * @return JsonResponse
     */
    public function __invoke(UpdateIsDefaultRequest $request)
    {
        $user = User::query()->with('addresses')->find(Auth::id());


        $addresses = $user->addresses ?? '';

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
