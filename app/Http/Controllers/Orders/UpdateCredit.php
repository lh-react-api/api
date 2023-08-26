<?php

namespace App\Http\Controllers\Orders;

use App\Exceptions\DatabaseErrorException;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Orders\UpdateCreditRequest;
use App\Models\Credit;
use App\Models\Order;
use App\Models\Stripe\StripeSubscription;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class UpdateCredit extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param StoreRequest $request
     * @return JsonResponse
     * @throws DatabaseErrorException
     */
    public function __invoke(UpdateCreditRequest $request, int $orderId)
    {
        $input = new Collection($request->input());
        $order = Order::find($orderId);
        $credit = Credit::find($input->get('credit_id'));
        $stripe = new StripeSubscription();
        $stripe->setMyCustomerId();
        $stripe->updatePaymentMethod(
            $order->subscription_id,
            $credit->payments_source,
        );
        $order->updateCreditId($input->get('credit_id'));

        return ResponseUtils::success($order);
    }
}
