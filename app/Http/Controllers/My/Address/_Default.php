<?php

namespace App\Http\Controllers\My\Address;

use App\Http\Controllers\BaseController;
use App\Models\Address;
use App\Utilities\ResponseUtils;
use Illuminate\Auth\Access\AuthorizationException;
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
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user();

        $this->authorize('view', $user);

        $address = Address::query()
            ->where('is_default',true)
            ->where('user_id', $user->id)
            ->first()
        ;

        return ResponseUtils::success(
            $address
        );
    }
}
