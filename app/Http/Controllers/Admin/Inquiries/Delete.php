<?php

namespace App\Http\Controllers\Admin\Inquiries;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Admin\Inquiries\DeleteRequest;
use App\Models\Inquiry;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;

class Delete extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param DeleteRequest $request
     * @param int $inquiryId
     * @return JsonResponse
     */
    public function __invoke(DeleteRequest $request, int $inquiryId)
    {
        $inquiry = Inquiry::find($inquiryId);
        $this->authorize('adminDelete', $inquiry);
        $inquiry->delete();

        return ResponseUtils::success(
            $inquiry
        );
    }
}
