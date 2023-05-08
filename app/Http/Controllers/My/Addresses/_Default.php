<?php

namespace App\Http\Controllers\My\Addresses;

use App\Http\Controllers\BaseController;
use App\Models\Address;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// 予約後のため
class _Default extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        $address = Address::query()
            ->where('is_default',true)
            ->where('user_id', Auth::id())
            ->first()
        ;

//        $this->authorize('view', $user);

        return ResponseUtils::success(
            $address
        );
    }
}
