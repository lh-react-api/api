<?php

namespace App\Models\stripe;

use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\PaymentSuccessMail;
use App\Mail\PaymentFailedMail;
use App\Mail\CanselSubscriptionMail;
use App\Mail\InvoiceUpcomingMail;
use App\Mail\PaymentMethodUpdateMail;
use App\Models\domains\Stripe\SubscriptionMailEntity;
use App\Models\Stripe\StripeProduct;
use App\Models\Stripe\StripeSubscription;
use App\Models\User;
use App\Models\Credit;
use Stripe\Event;

/**
 * stripe関連のメール送信を行うクラス
 */
class StripeMail
{
    /**
     * 決済成功時のメール送信
     *
     * @param Event $event
     * @return void
     */
    public static function paymentSuccessMail(Event $event){
        $user = User::findByStripeCustomerId($event->data->object->customer);
        $subscriptionInstance = new StripeSubscription();
        $productId = $subscriptionInstance->getSubscription($event->data->object->subscription)->items->data[0]->plan->product;
        $productInstance = new StripeProduct();
        $product = $productInstance->getProduct($productId);
        $date = Carbon::createFromTimestamp($event->data->object->created);
        Mail::to($user->email)->send(
            new PaymentSuccessMail(
                $user,
                new SubscriptionMailEntity(
                    $product->name,
                    $event->data->object->amount_paid,
                    $date->format('Y年m月d日')
                )
            )
        );
    }

    /**
     * 決済成功時のメール送信
     *
     * @param Event $event
     * @return void
     */
    public static function paymentFailedMail(Event $event){
        $user = User::findByStripeCustomerId($event->data->object->customer);
        $subscriptionInstance = new StripeSubscription();
        $productId = $subscriptionInstance->getSubscription($event->data->object->subscription)->items->data[0]->plan->product;
        $productInstance = new StripeProduct();
        $product = $productInstance->getProduct($productId);
        $date = Carbon::createFromTimestamp($event->data->object->created);
        Mail::to($user->email)->send(
            new PaymentFailedMail(
                $user,
                new SubscriptionMailEntity(
                    $product->name,
                    $event->data->object->amount_due,
                    $date->format('Y年m月d日')
                )
            )
        );
    }

    /**
     * サブスク停止時のメール送信
     *
     * @param Event $event
     * @return void
     */
    public static function cancelSubscription(Event $event){
        $user = User::findByStripeCustomerId($event->data->object->customer);
        $productInstance = new StripeProduct();
        $product = $productInstance->getProduct($event->data->object->items->data[0]->plan->product);
        $date = Carbon::createFromTimestamp($event->data->object->created);
        Mail::to($user->email)->send(
            new CanselSubscriptionMail(
                $user,
                new SubscriptionMailEntity(
                    $product->name,
                    $event->data->object->items->data[0]->plan->amount,
                    $date->format('Y年m月d日')
                )
            )
        );
    }

    /**
     * 次回請求日の通知
     *
     * @param Event $event
     * @return void
     */
    public static function invoiceUpcoming(Event $event){
        $user = User::findByStripeCustomerId($event->data->object->customer);
        $subscriptionInstance = new StripeSubscription();
        $productId = $subscriptionInstance->getSubscription($event->data->object->subscription)->items->data[0]->plan->product;
        $productInstance = new StripeProduct();
        $product = $productInstance->getProduct($productId);
        $date = Carbon::createFromTimestamp($event->data->object->created)->addWeek();
        Mail::to($user->email)->send(
            new InvoiceUpcomingMail(
                $user,
                new SubscriptionMailEntity(
                    $product->name,
                    $event->data->object->amount_paid,
                    $date->format('Y年m月d日')
                )
            )
        );
    }

    /**
     * 決済方法の更新
     *
     * @param Event $event
     * @return void
     */
    public static function paymentMethodUpdate(Event $event, Credit $credit){
        $user = User::findByStripeCustomerId($event->data->object->customer);
        $subscriptionInstance = new StripeSubscription();
        $productId = $subscriptionInstance->getSubscription($event->data->object->id)->items->data[0]->plan->product;
        $productInstance = new StripeProduct();
        $product = $productInstance->getProduct($productId);
        Mail::to($user->email)->send(
            new PaymentMethodUpdateMail(
                $user,
                new SubscriptionMailEntity(
                    $product->name,
                    '',
                    '',
                    $credit->brand,
                    $credit->last4,
                )
            )
        );
    }

}