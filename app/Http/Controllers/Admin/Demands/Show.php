<?php

namespace App\Http\Controllers\Admin\Demands;

use App\Http\Controllers\BaseController;
use App\Models\Demand;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Show extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param int $demandId
     * @return JsonResponse
     */
    public function __invoke(Request $request, int $demandId)
    {
        $demand = Demand::findForShow($demandId);
        $this->authorize('adminView', $demand);
        return ResponseUtils::success(
            $demand
        );
    }
}
