<?php

namespace App\Http\Controllers\Admin\ProductReviews;

use App\Exceptions\DatabaseErrorException;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Admin\ProductReviews\StoreRequest;
use App\Models\ProductReview;
use App\Models\domains\ProductReviews\ProductReviewEntity;
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

        $productReview = ProductReview::create(new ProductReviewEntity(
            $input->get('product_id'),
            $input->get('user_id'),
            $input->get('title'),
            $input->get('text'),
            $input->get('evaluation'),
        ));

        $this->authorize('adminCreate', $productReview);
        return ResponseUtils::success($productReview);
    }
}
