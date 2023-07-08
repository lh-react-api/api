<?php

namespace App\Models\Stripe;

use Illuminate\Support\Facades\Auth;
use App\Models\Credit;

class StripeBase
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

}