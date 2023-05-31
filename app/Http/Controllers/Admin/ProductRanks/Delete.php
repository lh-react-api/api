<?php

namespace App\Http\Controllers\Admin\ProductRanks;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Admin\ProductRanks\DeleteRequest;
use App\Models\ProductRank;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;

class Delete extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param DeleteRequest $request
     * @param int $productRankId
     * @return JsonResponse
     */
    public function __invoke(DeleteRequest $request, int $productRankId)
    {
        $productRank = ProductRank::find($productRankId);
        $this->authorize('adminDelete', $productRank);
        $productRank->delete();

        return ResponseUtils::success(
            $productRank
        );
    }
}
