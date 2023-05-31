<?php

namespace App\Http\Controllers\Admin\Inquiries;

use App\Exceptions\DatabaseErrorException;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Admin\Inquiries\StoreRequest;
use App\Models\Inquiry;
use App\Models\domains\Inquiries\InquiryEntity;
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
        $inquiry = Inquiry::create(new InquiryEntity(
            $input->get('inquiry_type_id'),
            $input->get('email'),
            $input->get('text'),
            $input->get('status'),
        ));

        $this->authorize('adminCreate', $inquiry);
        return ResponseUtils::success($inquiry);
    }
}
