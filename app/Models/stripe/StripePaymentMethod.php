<?php

namespace App\Models\Stripe;

class StripePaymentMethod extends StripeBase
{

    public function __construct($customerId = null) {
        parent::__construct($customerId);
    }

    public function getRetrievePaymentMethod(string $paymentMethodId) {
        return $this->stripe->paymentMethods->retrieve(
            $paymentMethodId,
            []
        );
    }
  
}