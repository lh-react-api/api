<?php

namespace App\Http\Controllers\Admin\Payments;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Admin\Payments\UpdateRequest;
use App\Models\Payment;
use App\Models\domains\Payments\PaymentEntity;
use App\Models\domains\Addresses\FullNameEntity;
use App\Models\domains\Addresses\AddressContentEntity;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class Update extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param UpdateRequest $request
     * @param int $paymentId
     * @return JsonResponse
     */
    public function __invoke(UpdateRequest $request, int $paymentId)
    {
        $input = new Collection($request->input());
        $payment = Payment::find($paymentId);
        $this->authorize('adminUpdate', $payment);
        $payment->put(new PaymentEntity(
            $input->get('order_id'),
            $input->get('credit_id'),
            $input->get('settlement_state'),
        ));
        $payment->save();

        return ResponseUtils::success($payment);
    }
}
