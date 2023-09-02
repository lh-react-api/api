<?php

namespace App\Models\stripe;

use Illuminate\Support\Facades\Auth;

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
        $this->customerId = Auth::user()->stripe_customer_id;
    }

}