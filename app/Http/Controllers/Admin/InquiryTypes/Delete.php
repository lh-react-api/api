<?php

namespace App\Http\Controllers\Admin\InquiryTypes;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Admin\InquiryTypes\DeleteRequest;
use App\Models\InquiryType;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;

class Delete extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param DeleteRequest $request
     * @param int $inquiryTypeId
     * @return JsonResponse
     */
    public function __invoke(DeleteRequest $request, int $inquiryTypeId)
    {
        $inquiryType = InquiryType::find($inquiryTypeId);
        $this->authorize('adminDelete', $inquiryType);
        $inquiryType->delete();

        return ResponseUtils::success(
            $inquiryType
        );
    }
}
