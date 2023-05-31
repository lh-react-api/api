<?php

namespace App\Http\Controllers\Admin\InquiryTypes;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Admin\InquiryTypes\UpdateRequest;
use App\Models\InquiryType;
use App\Models\domains\InquiryTypes\InquiryTypeEntity;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class Update extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param UpdateRequest $request
     * @param int $inquiryTypeId
     * @return JsonResponse
     */
    public function __invoke(UpdateRequest $request, int $inquiryTypeId)
    {
        $input = new Collection($request->input());
        $inquiryType = InquiryType::find($inquiryTypeId);
        $this->authorize('adminUpdate', $inquiryType);
        $inquiryType->put(new InquiryTypeEntity(
            $input->get('text'),
        ));

        return ResponseUtils::success($inquiryType);
    }
}
