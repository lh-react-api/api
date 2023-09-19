<?php

namespace App\Http\Controllers\Admin\Payments;

use App\Http\Controllers\BaseController;
use App\Models\Payment;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Show extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param int $paymentId
     * @return JsonResponse
     */
    public function __invoke(Request $request, int $paymentId)
    {
        $payment = Payment::findForShow($paymentId);
        $this->authorize('adminView', $payment);
        return ResponseUtils::success(
            $payment
        );
    }
}
