<?php

namespace App\Http\Controllers\Admin\InquiryTypes;

use App\Exceptions\DatabaseErrorException;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Admin\InquiryTypes\StoreRequest;
use App\Models\InquiryType;
use App\Models\domains\InquiryTypes\InquiryTypeEntity;
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

        $inquiryType = InquiryType::create(new InquiryTypeEntity(
            $input->get('text'),
        ));

        $this->authorize('adminCreate', $inquiryType);
        return ResponseUtils::success($inquiryType);
    }
}
