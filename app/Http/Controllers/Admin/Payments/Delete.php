<?php

namespace App\Http\Controllers\Admin\Payments;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Admin\Payments\DeleteRequest;
use App\Models\Payment;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;

class Delete extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param DeleteRequest $request
     * @param int $paymentId
     * @return JsonResponse
     */
    public function __invoke(DeleteRequest $request, int $paymentId)
    {
        $payment = Payment::find($paymentId);
        $this->authorize('adminDelete', $payment);
        $payment->delete();

        return ResponseUtils::success();
    }
}
