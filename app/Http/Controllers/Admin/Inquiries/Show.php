<?php

namespace App\Http\Controllers\Admin\Inquiries;

use App\Http\Controllers\BaseController;
use App\Models\Inquiry;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Show extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param int $inquiryId
     * @return JsonResponse
     */
    public function __invoke(Request $request, int $inquiryId)
    {
        $inquiry = Inquiry::findForShow($inquiryId);
        $this->authorize('adminView', $inquiry);
        return ResponseUtils::success(
            $inquiry
        );
    }
}
