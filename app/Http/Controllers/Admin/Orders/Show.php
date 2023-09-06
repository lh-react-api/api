<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Http\Controllers\BaseController;
use App\Models\Order;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Show extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param int $orderId
     * @return JsonResponse
     */
    public function __invoke(Request $request, int $orderId)
    {
        $order = Order::findForShow($orderId);
        $this->authorize('adminView', $order);
        return ResponseUtils::success(
            $order
        );
    }
}
