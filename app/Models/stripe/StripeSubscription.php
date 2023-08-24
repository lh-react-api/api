<?php

namespace App\Models\Stripe;

class StripeSubscription extends StripeBase
{

    public function __construct($customerId = null) {
        parent::__construct($customerId);
    }

    /**
     * サブスクリプション登録
     *
     * @return object
     */
    public function createSubscription(string $productId, string $cardId) {
        $product = (new StripeProduct)->getProduct($productId);
        return $this->stripe->subscriptions->create([
            'customer' => $this->customerId,
            'items' => [
                ['price' => $product->default_price],
            ],
            'default_payment_method' => $cardId
        ]);
    }

    /**
     * サブスクリプションの停止
     *
     * @param string $subscriptionId
     * @return object
     */
    public function cancelSubscription(string $subscriptionId) {
        return $this->stripe->subscriptions->cancel(
            $subscriptionId,
            []
        );
    }

    /**
     * サブスクリプション取得
     *
     * @param string $subscriptionId
     * @return object
     */
    public function getSubscription(string $subscriptionId) {
        return $this->stripe->subscriptions->retrieve(
            $subscriptionId,
            []
        );
    }

}