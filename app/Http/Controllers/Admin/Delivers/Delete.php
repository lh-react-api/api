<?php

namespace App\Http\Controllers\Admin\Delivers;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Admin\Delivers\DeleteRequest;
use App\Models\Deliver;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;

class Delete extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param DeleteRequest $request
     * @param int $deliverId
     * @return JsonResponse
     */
    public function __invoke(DeleteRequest $request, int $deliverId)
    {
        $deliver = Deliver::find($deliverId);
        $this->authorize('adminDelete', $deliver);
        $deliver->delete();

        return ResponseUtils::success(
            $deliver
        );
    }
}
