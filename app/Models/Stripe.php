<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use App\Models\ProductRank;
use App\Models\Product;
use App\Models\domains\Products\ProductEntity;
use App\Models\domains\Stripe\MaskCardEntity;

class Stripe
{

    protected $stripe;
    protected $customerId;

    public function __construct($customerId = null) {
        $this->stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        if ($customerId) {
            $this->customerId = $customerId;
        }
    }

    /**
     * 自身のstripe顧客IDをセット
     *
     * @return void
     */
    public function setMyCustomerId() {
        $credit = Credit::searchForUserId(Auth::user()->id);
        if ($credit) {
            $this->customerId = $credit->stripe_customer_id;
        }   
    }

    /**
     * ユーザー登録
     *
     * @param string $email
     * @return Object https://stripe.com/docs/api/customers/object
     */
    public function createCustomer(string $email) {
        return $this->stripe->customers->create([
            'email' => $email
        ]);
    }

    /**
     * メールアドレス更新
     *
     * @param string $email
     * @return Object https://stripe.com/docs/api/customers/object
     */
    public function updateCustomerEmail(string $email) {
        return $this->stripe->customers->update(
            $this->customerId,
            [
                'email' => $email
            ]
        );
    }

    /**
     * ユーザー情報Eメール検索
     *
     * @param string $email
     * @return Object https://stripe.com/docs/api/customers/object
     */
    public function searchEmailToCustomer(string $email) {
        return $this->stripe->customers->search([
            'query' => "email:'$email'",
            'limit' => 1
        ])->data;
    }

    /**
     * 商品データ取得
     *
     * @param string $stripeProductId
     * @return Object https://stripe.com/docs/api/products/object
     */
    private function getProduct(string $stripeProductId){
        return $this->stripe->products->retrieve(
            $stripeProductId,
            []
        );
    }

    /**
     * 金額データ取得
     *
     * @param string $stripePriceId
     * @return Object https://stripe.com/docs/api/prices/object
     */
    private function getPrice(string $stripePriceId){
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
    private function searchPrice(string $productId) {
        return $this->stripe->prices->search([
            'query' => "product:'$productId'",
        ])->data;
    }

    /**
     * 自身の登録済みカード情報を取得
     *
     * @return Cllection<MaskCardEntity>
     */
    public function getCustmerCardlist() {
        $stripeCards = $this->stripe->customers->allSources(
            $this->customerId,
            [
                'object' => 'card',
                'limit' => 100
            ]
        )->data;
        return collect(array_map(function ($card){
            return new MaskCardEntity(
                $card->id,
                $card->brand,
                $card->cvc_check,
                $card->exp_month,
                $card->exp_year,
                $card->last4,
            );
        }, $stripeCards));
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
        $defaultPrice = $this->getPrice($defaultPriceId);
        if($product->price !== $defaultPrice->unit_amount) {
            // すでに登録済みの金額データあればそれを使う
            $filterPricies = array_filter($this->searchPrice($product->stripe_plan_id),
                function($price) use ($product) {
                    return $price->unit_amount === $product->price;
                }
            );
            if (count($filterPricies) > 0) {
                $defaultPriceId = $filterPricies[1]->id;
            } else {
                $price = $this->createPrice($product);
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

    /**
     * サブスクリプション登録
     *
     * @return object
     */
    public function createSubscription(string $productId, string $cardId) {
        $product = $this->getProduct($productId);
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

}