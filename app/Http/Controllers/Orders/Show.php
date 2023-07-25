<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Orders\ShowRequest;
use App\Models\Order;
use App\Utilities\ResponseUtils;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
class Show extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param ShowRequest $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function __invoke(ShowRequest $request, int $orderId)
    {
        $order = Order::find($orderId);
        $this->authorize('view', $order);

        return ResponseUtils::success(
            $order
        );
    }
}
