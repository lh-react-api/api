<?php

namespace App\Http\Controllers\My\Credits;

use App\Http\Controllers\BaseController;
use App\Models\Credit;
use App\Utilities\ResponseUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowStripeId extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return ResponseUtils
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user();
        $stripeCustomerId = Credit::searchForUserId($user->id);
        return ResponseUtils::success(
            ['stripeCustomerId' => $stripeCustomerId->stripe_customer_id]
        );
    }
}
