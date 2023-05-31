<?php

namespace App\Http\Controllers\Admin\Notices;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Admin\Notices\DeleteRequest;
use App\Models\Notice;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;

class Delete extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param DeleteRequest $request
     * @param int $noticeId
     * @return JsonResponse
     */
    public function __invoke(DeleteRequest $request, int $noticeId)
    {
        $notice = Notice::find($noticeId);
        $this->authorize('adminDelete', $notice);
        $notice->delete();

        return ResponseUtils::success(
            $notice
        );
    }
}
