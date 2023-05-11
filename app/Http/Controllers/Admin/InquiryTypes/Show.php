<?php

namespace App\Http\Controllers\Admin\InquiryTypes;

use App\Http\Controllers\BaseController;
use App\Models\InquiryType;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Show extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param int $inquiryTypeId
     * @return JsonResponse
     */
    public function __invoke(Request $request, int $inquiryTypeId)
    {
        $inquiryType = InquiryType::findForShow($inquiryTypeId);
        $this->authorize('adminView', $inquiryType);
        return ResponseUtils::success(
            $inquiryType
        );
    }
}
