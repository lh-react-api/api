<?php

namespace App\Http\Controllers\Webhooks;

use App\Http\Controllers\BaseController;
use App\Models\Order;
use App\Models\Credit;
use App\Models\Payment;
use App\Enums\Orders\OrdersProgress;
use App\Enums\Orders\OrdersSettlementState;
use App\Enums\Payments\PaymentsSettlementState;
use App\Models\domains\Payments\PaymentEntity;
use App\Models\Stripe\StripeMail;
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
                Payment::create(new PaymentEntity(
                    $order->id,
                    PaymentsSettlementState::SUCCESS
                ));
                StripeMail::PaymentSuccessMail($event);
            } else if ($event->type === 'invoice.payment_failed') {
                $order = Order::searchForSubscriptionId($event->data->object->subscription);
                $order->updateSettlementState(OrdersSettlementState::FAILED);
                Payment::create(new PaymentEntity(
                    $order->id,
                    PaymentsSettlementState::FAILED
                ));
                StripeMail::PaymentFailedMail($event);
            } else if ($event->type === 'customer.subscription.deleted') {
                $order = Order::searchForSubscriptionId($event->data->object->id);
                $order->updateProgress(OrdersProgress::STOP);
                StripeMail::cancelSubscription($event);
            } else if ($event->type === 'payment_method.attached') {
                Credit::createForWebhook(
                    $event->data->object->id,
                    $event->data->object->customer
                );
            } else if ($event->type === 'invoice.upcoming') {
                // 次回請求日のお知らせ
                StripeMail::invoiceUpcoming($event);
            } else {
                // 何もしない
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        return response()->json(['message' => 'Webhook processed successfully']);
    }
}
