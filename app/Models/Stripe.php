<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
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

    public function setMyCustomerId() {
        $credit = Credit::searchForUserId(Auth::user()->id);
        if ($credit) {
            $this->customerId = $credit->stripe_customer_id;
        }   
    }

    public function createCustomer(string $email) {
        return $this->stripe->customers->create([
            'email' => $email
        ]);
    }

    public function searchEmailToCustomer(string $email) {
        return $this->stripe->customers->search([
            'query' => "email:'$email'",
            'limit' => 1
        ])->data;
    }

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
}