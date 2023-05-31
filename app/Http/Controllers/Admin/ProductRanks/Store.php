<?php

namespace App\Http\Controllers\Admin\ProductRanks;

use App\Exceptions\DatabaseErrorException;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Admin\ProductRanks\StoreRequest;
use App\Models\ProductRank;
use App\Models\domains\ProductRanks\ProductRankEntity;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class Store extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param StoreRequest $request
     * @return JsonResponse
     * @throws DatabaseErrorException
     */
    public function __invoke(StoreRequest $request)
    {

        $input = new Collection($request->input());

        $productRank = ProductRank::create(new ProductRankEntity(
            $input->get('rank'),
            $input->get('information'),
            (float)$input->get('discount_rate'),
            (int)$input->get('priority')
        ));

        $this->authorize('adminCreate', $productRank);
        return ResponseUtils::success($productRank);
    }
}
