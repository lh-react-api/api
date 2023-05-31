<?php

namespace App\Http\Controllers\Admin\ProductRanks;

use App\Http\Controllers\BaseController;
use App\Models\ProductRank;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Show extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param int $productRankId
     * @return JsonResponse
     */
    public function __invoke(Request $request, int $productRankId)
    {
        $productRank = ProductRank::findForShow($productRankId);
        $this->authorize('adminView', $productRank);
        return ResponseUtils::success(
            $productRank
        );
    }
}
