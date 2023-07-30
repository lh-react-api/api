<?php

namespace App\Http\Controllers\Webhooks;

use App\Http\Controllers\BaseController;
use App\Models\Order;
use App\Models\Credit;
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
            if ($event->type === 'invoice.payment_succeeded') {
                $order = Order::searchForSubscriptionId($event->data->object->subscription);
                $order->updateSettlementState(OrdersSettlementState::SUCCESS);
            } else if ($event->type === 'invoice.payment_failed') {
                $order = Order::searchForSubscriptionId($event->data->object->subscription);
                $order->updateSettlementState(OrdersSettlementState::FAILED);
            } else if ($event->type === 'payment_method.attached') {
                Credit::createForWebhook(
                    $event->data->object->id,
                    $event->data->object->customer
                );
            } else {
                // 何もしない
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        return response()->json(['message' => 'Webhook processed successfully']);
    }
}
