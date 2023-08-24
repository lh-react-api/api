<?php

namespace App\Models\Stripe;

use Illuminate\Support\Facades\Auth;
use App\Models\Credit;

class StripeIntents extends StripeBase
{

    public function __construct($customerId = null) {
        parent::__construct($customerId);
    }

    /**
     * クライアントシークレットの生成
     *
     * @return Object https://stripe.com/docs/api/setup_intents
     */
    public function generateCrientSecret() {
        return $this->stripe->setupIntents->create(
            [
                'customer' => $this->customerId,
                'payment_method_types' => ['card'],
            ]
        );
    }

}