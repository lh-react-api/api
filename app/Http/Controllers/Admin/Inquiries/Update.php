<?php

namespace App\Http\Controllers\Admin\Inquiries;

use App\Enums\Inquiries\InquiriesStatus;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Admin\Inquiries\UpdateRequest;
use App\Models\domains\Inquiries\InquiryEntity;
use App\Models\Inquiry;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class Update extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param UpdateRequest $request
     * @param int $inquiryId
     * @return JsonResponse
     */
    public function __invoke(UpdateRequest $request, int $inquiryId)
    {
        $input = new Collection($request->input());
        $inquiry = Inquiry::find($inquiryId);
        $this->authorize('adminUpdate', $inquiry);
        $inquiry->put(
            new InquiryEntity(
                $input->get('inquiry_type_id'),
                $input->get('email'),
                $input->get('text'),
                $input->get('status')
            )
        );

        return ResponseUtils::success($inquiry);
    }
}
