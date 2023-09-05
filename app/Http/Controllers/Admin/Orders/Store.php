<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Exceptions\DatabaseErrorException;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Admin\Orders\StoreRequest;
use App\Models\Order;
use App\Models\domains\Orders\OrderEntity;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class Store extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param StoreRequest $request
     * @return JsonResponse
     * @throws DatabaseErrorException
     */
    public function __invoke(StoreRequest $request)
    {

        $input = new Collection($request->input());
        $order = Order::create(new OrderEntity(
            $input->get('product_id'),
            $input->get('user_id'),
            $input->get('credit_id'),
            $input->get('progress'),
            $input->get('sent_tracking_number') ?? '',
            $input->get('return_tracking_number') ?? '',
            $input->get('settlement_state'),
            $input->get('subscription_id'),
        ));

        $this->authorize('adminCreate', $order);
        return ResponseUtils::success($order);
    }
}
