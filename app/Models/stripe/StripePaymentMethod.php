<?php

namespace App\Models\Stripe;

use App\Models\domains\Stripe\MaskCardEntity;

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