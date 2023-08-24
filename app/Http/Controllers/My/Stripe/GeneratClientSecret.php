<?php

namespace App\Http\Controllers\My\Stripe;

use App\Http\Controllers\BaseController;
use App\Models\Stripe\StripeIntents;
use App\Utilities\ResponseUtils;
use Illuminate\Http\Request;

class GeneratClientSecret extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return ResponseUtils
     */
    public function __invoke(Request $request)
    {
        $stripe = new StripeIntents();
        $stripe->setMyCustomerId();
        $clientSecret =  $stripe->generateCrientSecret();
        return ResponseUtils::success(
            ['clientSecret' => $clientSecret->client_secret]
        );
    }
}
