<?php

namespace App\Http\Controllers\Admin\RecommendProducts;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Admin\RecommendProducts\UpdateRequest;
use App\Models\RecommendProduct;
use App\Models\domains\RecommendProducts\RecommendProductEntity;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class Update extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param UpdateRequest $request
     * @param int $recommendProductId
     * @return JsonResponse
     */
    public function __invoke(UpdateRequest $request, int $recommendProductId)
    {
        $input = new Collection($request->input());
        $recommendProduct = RecommendProduct::find($recommendProductId);
        $this->authorize('adminUpdate', $recommendProduct);
        $recommendProduct->put(new RecommendProductEntity(
            $input->get('product_id'),
        ));
        $recommendProduct->save();

        return ResponseUtils::success($recommendProduct);
    }
}
