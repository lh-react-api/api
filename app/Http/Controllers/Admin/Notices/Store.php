<?php

namespace App\Http\Controllers\Admin\Notices;

use App\Exceptions\DatabaseErrorException;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Admin\Notices\StoreRequest;
use App\Models\Notice;
use App\Models\domains\Notices\NoticeEntity;
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

        $notice = Notice::create(new NoticeEntity(
            $input->get('division'),
            $input->get('title'),
            $input->get('text'),
            $input->get('notice_date'),
            $input->get('close_date'),
        ));

        $this->authorize('adminCreate', $notice);
        return ResponseUtils::success($notice);
    }
}
