<?php

namespace App\Http\Controllers\Webhooks;

use App\Http\Controllers\BaseController;
use App\Models\Order;
use App\Enums\Orders\OrdersSettlementState;
use Illuminate\Http\Request;
use Stripe\Webhook;

class StripeWebhook extends BaseController
{
    public function __invoke(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $endpointSecret = env('STRIPE_WEBHOOK');

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $endpointSecret);
            $subscriptionId = $event->data->object->subscription;
            if ($event->type === 'invoice.payment_succeeded') {
                $order = Order::searchForSubscriptionId($subscriptionId);
                $order->updateSettlementState(OrdersSettlementState::SUCCESS);
            } else if ($event->type === 'invoice.payment_failed') {
                $order = Order::searchForSubscriptionId($subscriptionId);
                $order->updateSettlementState(OrdersSettlementState::FAILED);
            } else {
                // 何もしない
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        return response()->json(['message' => 'Webhook processed successfully']);
    }
}
