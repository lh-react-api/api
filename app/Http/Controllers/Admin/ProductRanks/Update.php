<?php

namespace App\Http\Controllers\Admin\ProductRanks;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Admin\ProductRanks\UpdateRequest;
use App\Models\domains\ProductRanks\ProductRankEntity;
use App\Models\ProductRank;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Collection;

class Update extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param UpdateRequest $request
     * @param int $productRankId
     * @return JsonResponse
     */
    public function __invoke(UpdateRequest $request, int $productRankId)
    {
        $input = new Collection($request->input());
        $productRank = ProductRank::query()->find($productRankId);
        $this->authorize('adminUpdate', $productRank);
        $productRank->updateEntity(new ProductRankEntity(
            $input->get('rank'),
            $input->get('information'),
            (float)$input->get('discount_rate'),
            (int)$input->get('priority')
        ));
        return ResponseUtils::success($productRank);
    }
}
