<?php

namespace App\Http\Controllers\Admin\Payments;

use App\Exceptions\DatabaseErrorException;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Admin\Payments\StoreRequest;
use App\Models\Payment;
use App\Models\domains\Payments\PaymentEntity;
use App\Models\domains\Addresses\FullNameEntity;
use App\Models\domains\Addresses\AddressContentEntity;
use App\Utilities\ResponseUtils;
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
        $payment = Payment::create(new PaymentEntity(
            $input->get('order_id'),
            $input->get('credit_id'),
            $input->get('settlement_state'),
        ));

        $this->authorize('adminCreate', $payment);
        return ResponseUtils::success($payment);
    }
}
