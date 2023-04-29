<?php

namespace App\Http\Controllers\Admin\Notices;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Admin\Notices\UpdateRequest;
use App\Models\Notice;
use App\Models\domains\Notices\NoticeEntity;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class Update extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param UpdateRequest $request
     * @param int $noticeId
     * @return JsonResponse
     */
    public function __invoke(UpdateRequest $request, int $noticeId)
    {
        $input = new Collection($request->input());
        $notice = Notice::query()->find($noticeId);
        $this->authorize('adminUpdate', $notice);
        $notice->updateEntity(new NoticeEntity(
            $input->get('division'),
            $input->get('title'),
            $input->get('text'),
            $input->get('notice_date'),
            $input->get('close_date'),
        ));
        $notice->save();

        return ResponseUtils::success($notice);
    }
}
