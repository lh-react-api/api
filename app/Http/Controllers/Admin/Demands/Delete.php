<?php

namespace App\Http\Controllers\Admin\Demands;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Admin\Demands\DeleteRequest;
use App\Models\Demand;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;

class Delete extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param DeleteRequest $request
     * @param int $demandId
     * @return JsonResponse
     */
    public function __invoke(DeleteRequest $request, int $demandId)
    {
        $demand = Demand::find($demandId);
        $this->authorize('adminDelete', $demand);
        $demand->delete();

        return ResponseUtils::success();
    }
}
