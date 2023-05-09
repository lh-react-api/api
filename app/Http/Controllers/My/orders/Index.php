<?php

namespace App\Http\Controllers\My\orders;

use App\Http\Controllers\BaseController;
use App\Models\Address;
use App\Models\Order;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Index extends BaseController
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
        $user = Auth::user();
        $this->authorize('view', $user);

        $address = Order::query()
            ->where('user_id', $user->id)
            ->get()
        ;

        return ResponseUtils::success(
            $address
        );
    }
}