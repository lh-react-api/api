<?php

namespace App\Http\Controllers\Admin\RecommendProducts;

use App\Exceptions\DatabaseErrorException;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Admin\RecommendProducts\StoreRequest;
use App\Models\RecommendProduct;
use App\Models\domains\RecommendProducts\RecommendProductEntity;
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

        $recommendProduct = RecommendProduct::create(new RecommendProductEntity(
            $input->get('product_id'),
        ));

        $this->authorize('adminCreate', $recommendProduct);
        return ResponseUtils::success($recommendProduct);
    }
}
