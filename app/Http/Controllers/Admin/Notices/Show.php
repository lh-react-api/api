<?php

namespace App\Http\Controllers\Admin\Notices;

use App\Http\Controllers\BaseController;
use App\Models\Notice;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Show extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param int $noticeId
     * @return JsonResponse
     */
    public function __invoke(Request $request, int $noticeId)
    {
        $Notice = Notice::findForShow($noticeId);
        $this->authorize('adminView', $Notice);
        return ResponseUtils::success(
            $Notice
        );
    }
}
