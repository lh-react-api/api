<?php

namespace App\Models\stripe;

use App\Models\ProductRank;
use App\Models\Product;
use App\Models\domains\Products\ProductEntity;

/**
 * Stripe商品関連のAPI実装クラス
 */
class StripeProduct extends StripeBase
{

    public function __construct($customerId = null) {
        parent::__construct($customerId);
    }

    /**
     * 商品データ取得
     *
     * @param string $stripeProductId
     * @return Object https://stripe.com/docs/api/products/object
     */
    public function getProduct(string $stripeProductId){
        return $this->stripe->products->retrieve(
            $stripeProductId,
            []
        );
    }

    /**
     * 商品登録
     *
     * @param ProductEntity $productEntity
     * @return Object https://stripe.com/docs/api/products/object
     */
    public function createProduct(ProductEntity $productEntity) {
        return $this->stripe->products->create([
            'name' => $productEntity->getName(),
            'description' => $this->getDescription($productEntity->getProductRankId()),
            'default_price_data' => [
                'currency' => 'JPY',
                'unit_amount' => $productEntity->getPrice(),
                'recurring' => [
                    'interval' => 'month'
                ],
            ],
        ]);
    }

    /**
     * 商品更新
     * 金額が変わった場合、先に金額登録しそのIDを設定する必要あり
     *
     * @param Product $product
     * @return Object https://stripe.com/docs/api/products/object
     */
    public function updateProduct(Product $product) {
        $defaultPriceId = $this->getProduct($product->stripe_plan_id)->default_price;
        $defaultPrice = (new StripePrice)->getPrice($defaultPriceId);
        if($product->price !== $defaultPrice->unit_amount) {
            // すでに登録済みの金額データあればそれを使う
            $filterPricies = array_filter((new StripePrice)->searchPrice($product->stripe_plan_id),
                function($price) use ($product) {
                    return $price->unit_amount === $product->price;
                }
            );
            if (count($filterPricies) > 0) {
                $defaultPriceId = $filterPricies[1]->id;
            } else {
                $price = (new StripePrice)->createPrice($product);
                $defaultPriceId = $price->id;
            }
        }
        return $this->stripe->products->update(
            $product->stripe_plan_id,
            [
                'name' => $product->name,
                'description' => $this->getDescription($product->product_rank_id),
                'default_price' => $defaultPriceId
            ]
        );
    }

    /**
     * 商品をアーカイブ化する
     * stripeの使用上一度でも決済した商品は削除できないため
     *
     * @param string $stripeProductId
     * @return void
     */
    public function arciveProduct(string $stripeProductId) {
        return $this->stripe->products->update(
            $stripeProductId,
            [
                'active' => false
            ]
        );
    }

    /**
     * 商品登録用の説明作成
     * 商品プランデータの 種別名:商品ランク情報 を返却
     *
     * @param integer $productRankId
     * @return string
     */
    private function getDescription(int $productRankId) {
        $productRnak = ProductRank::find($productRankId);
        return $productRnak->rank . ':' . $productRnak->information;
    }

}