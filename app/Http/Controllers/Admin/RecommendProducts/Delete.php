<?php

namespace App\Http\Controllers\Admin\RecommendProducts;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Admin\RecommendProducts\DeleteRequest;
use App\Models\RecommendProduct;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;

class Delete extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param DeleteRequest $request
     * @param int $recommendProductId
     * @return JsonResponse
     */
    public function __invoke(DeleteRequest $request, int $recommendProductId)
    {
        $recommendProduct = RecommendProduct::find($recommendProductId);
        $this->authorize('adminDelete', $recommendProduct);
        $recommendProduct->delete();

        return ResponseUtils::success();
    }
}
