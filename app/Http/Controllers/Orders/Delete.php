<?php

namespace App\Http\Controllers\Orders;

use App\Enums\Orders\OrdersProgress;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Orders\DeleteRequest;
use App\Models\Order;
use App\Utilities\ResponseUtils;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use App\Models\Stripe\StripeSubscription;

class Delete extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param ShowRequest $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function __invoke(DeleteRequest $request, int $orderId)
    {
        $order = Order::find($orderId);
        $this->authorize('view', $order);
        $stripe = new StripeSubscription();
        $stripe->setMyCustomerId();
        $stripe->cancelSubscription(
            $order->subscription_id
        );
        return ResponseUtils::success();
    }
}
