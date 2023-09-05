<?php

namespace App\Http\Controllers\Admin\RecommendProducts;

use App\Http\Controllers\BaseController;
use App\Models\RecommendProduct;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Show extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param int $recommendProductId
     * @return JsonResponse
     */
    public function __invoke(Request $request, int $recommendProductId)
    {
        $recommendProduct = RecommendProduct::findForShow($recommendProductId);
        $this->authorize('adminView', $recommendProduct);
        return ResponseUtils::success(
            $recommendProduct
        );
    }
}
