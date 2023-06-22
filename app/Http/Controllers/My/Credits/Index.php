<?php

namespace App\Http\Controllers\My\Credits;

use App\Http\Controllers\BaseController;
use App\Utilities\ResponseUtils;
use App\Models\Credit;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Stripe;

class Index extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return ResponseUtils
     */
    public function __invoke(Request $request)
    {
        $cardlist = Credit::getCardList();
        return ResponseUtils::success(
            [
                'data' => $cardlist
            ]  
        );
    }
}
