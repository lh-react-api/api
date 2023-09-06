<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Admin\Orders\DeleteRequest;
use App\Models\Order;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;

class Delete extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param DeleteRequest $request
     * @param int $orderId
     * @return JsonResponse
     */
    public function __invoke(DeleteRequest $request, int $orderId)
    {
        $order = Order::find($orderId);
        $this->authorize('adminDelete', $order);
        $order->delete();

        return ResponseUtils::success();
    }
}
