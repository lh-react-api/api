<?php

namespace App\Models\Stripe;

class StripeCustomer extends StripeBase
{

    public function __construct($customerId = null) {
        parent::__construct($customerId);
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
     * カード情報の登録
     *
     * @param string $token
     * @return void
     */
    public function createSource(string $token) {
        return $this->stripe->customers->createSource(
            $this->customerId,
            [
                'source' => $token,
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
  
}