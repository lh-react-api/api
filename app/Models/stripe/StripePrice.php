<?php

namespace App\Models\Stripe;

use App\Models\Product;

/**
 * Stripe商品関連のAPI実装クラス
 */
class StripePrice extends StripeBase
{

    public function __construct($customerId = null) {
        parent::__construct($customerId);
    }

    /**
     * 金額登録
     *
     * @param Product $product
     * @return Object https://stripe.com/docs/api/prices/object
     */
    public function createPrice(Product $product) {
        return $this->stripe->prices->create([
            'unit_amount' => $product->price,
            'currency' => 'jpy',
            'recurring' => ['interval' => 'month'],
            'product' => $product->stripe_plan_id,
        ]);
    }

    /**
     * 金額データ取得
     *
     * @param string $stripePriceId
     * @return Object https://stripe.com/docs/api/prices/object
     */
    public function getPrice(string $stripePriceId){
        return $this->stripe->prices->retrieve(
            $stripePriceId,
            []
        );
    }

    /**
     * 金額データ検索
     *
     * @param string $productId
     * @return Array https://stripe.com/docs/api/prices/object
     */
    public function searchPrice(string $productId) {
        return $this->stripe->prices->search([
            'query' => "product:'$productId'",
        ])->data;
    }

}