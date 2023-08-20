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
use App\Models\Stripe\StripeSubscription;
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
                // 決済成功
                $order = Order::searchForSubscriptionId($event->data->object->subscription);
                $order->updateSettlementState(OrdersSettlementState::SUCCESS);
                $currentMonth = now()->month;
                // 当月の決済情報を取得しあれば更新なければ作成
                $payment = Payment::where('order_id', $order->id)
                                    ->whereMonth('created_at', $currentMonth)
                                    ->first();
                if ($payment) {
                    $payment->statusUpdate(PaymentsSettlementState::SUCCESS);
                } else {
                    Payment::create(new PaymentEntity(
                        $order->id,
                        PaymentsSettlementState::SUCCESS
                    ));
                }
                StripeMail::PaymentSuccessMail($event);
            } else if ($event->type === 'invoice.payment_failed') {
                // 決済失敗
                $order = Order::searchForSubscriptionId($event->data->object->subscription);
                $order->updateSettlementState(OrdersSettlementState::FAILED);
                if (Payment::where('order_id', $order->id)->exists()) {
                    // 1件以上存在した場合は当月の決済情報を取得しなければ作成
                    $currentMonth = now()->month;
                    $exist = Payment::where('order_id', $order->id)
                                    ->whereMonth('created_at', $currentMonth)
                                    ->first();
                    if (!$exist) {
                        Payment::create(new PaymentEntity(
                            $order->id,
                            PaymentsSettlementState::FAILED
                        ));
                    }
                } else {
                    // サブスク作成時（初回）に失敗
                    // 決済情報の登録に合わせて
                    // 決済のリトライがかからないようにサブスクをキャンセルしておく
                    Payment::create(new PaymentEntity(
                        $order->id,
                        PaymentsSettlementState::FAILED
                    ));
                    (new StripeSubscription)->cancelSubscription($event->data->object->subscription);
                }
                StripeMail::PaymentFailedMail($event);
            } else if ($event->type === 'customer.subscription.deleted') {
                // サブスク停止
                $order = Order::searchForSubscriptionId($event->data->object->id);
                $order->updateProgress(OrdersProgress::STOP);
                StripeMail::cancelSubscription($event);
            } else if ($event->type === 'payment_method.attached') {
                // カード登録
                Credit::createForWebhook($event);
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
