<?php

namespace App\Http\Controllers\Admin\ProductReviews;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Admin\ProductReviews\UpdateRequest;
use App\Models\ProductReview;
use App\Models\domains\ProductReviews\ProductReviewEntity;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class Update extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param UpdateRequest $request
     * @param int $productReviewId
     * @return JsonResponse
     */
    public function __invoke(UpdateRequest $request, int $productReviewId)
    {
        $input = new Collection($request->input());
        $productReview = ProductReview::find($productReviewId);
        $this->authorize('adminUpdate', $productReview);
        $productReview->put(new ProductReviewEntity(
            $input->get('product_id'),
            $input->get('user_id'),
            $input->get('title'),
            $input->get('text'),
            $input->get('evaluation'),
        ));
        $productReview->save();

        return ResponseUtils::success($productReview);
    }
}
