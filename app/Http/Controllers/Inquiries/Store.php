<?php

namespace App\Http\Controllers\Inquiries;

use App\Enums\Inquiries\InquiriesStatus;
use App\Exceptions\DatabaseErrorException;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Inquiries\StoreRequest;
use App\Models\domains\Inquiries\InquiryEntity;
use App\Models\Inquiry;
use App\Utilities\ResponseUtils;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class Store extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws DatabaseErrorException
     */
    public function __invoke(StoreRequest $request)
    {
        $input = new Collection($request->input());


        $entity = Inquiry::create(new InquiryEntity(
            $input->get('inquiry_type_id'),
            $input->get('email'),
            $input->get('text'),
            InquiriesStatus::YET,
        ));

        $entity->save();

        return ResponseUtils::success();
    }
}
