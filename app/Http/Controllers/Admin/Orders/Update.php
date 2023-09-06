<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Admin\Orders\UpdateRequest;
use App\Models\Order;
use App\Models\domains\Orders\OrderEntity;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class Update extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param UpdateRequest $request
     * @param int $orderId
     * @return JsonResponse
     */
    public function __invoke(UpdateRequest $request, int $orderId)
    {
        $input = new Collection($request->input());
        $order = Order::find($orderId);
        $this->authorize('adminUpdate', $order);
        $order->put(new OrderEntity(
            $input->get('product_id'),
            $input->get('user_id'),
            $input->get('credit_id'),
            $input->get('progress'),
            $input->get('sent_tracking_number') ?? '',
            $input->get('return_tracking_number') ?? '',
            $input->get('settlement_state'),
            $input->get('subscription_id'),
        ));
        $order->save();

        return ResponseUtils::success($order);
    }
}
