<?php

namespace App\Http\Controllers\My\Credits;

use App\Http\Controllers\BaseController;
use App\Models\Stripe;
use App\Models\Credit;
use App\Http\Controllers\Requests\My\Credit\StoreRequest;
use App\Utilities\ResponseUtils;
use App\Exceptions\DatabaseErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class Store extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param StoreRequest $request
     * @return JsonResponse
     * @throws DatabaseErrorException
     */
    public function __invoke(StoreRequest $request)
    {
        $input = new Collection($request->input());

        $stripe = new Stripe();
        $stripe->setMyCustomerId();
        $stripe->createSource($input->get('token'));
        $cardlist = Credit::getCardList();
        return ResponseUtils::success(
            [
                'data' => $cardlist
            ]  
        );
    }
}
