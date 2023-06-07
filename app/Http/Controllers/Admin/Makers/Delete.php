<?php

namespace App\Http\Controllers\Admin\Makers;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Admin\Makers\DeleteRequest;
use App\Models\Maker;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;

class Delete extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param DeleteRequest $request
     * @param int $makerId
     * @return JsonResponse
     */
    public function __invoke(DeleteRequest $request, int $makerId)
    {
        $maker = Maker::find($makerId);
        $this->authorize('adminDelete', $maker);
        $maker->delete();

        return ResponseUtils::success(
            $maker
        );
    }
}
