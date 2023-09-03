<?php

namespace App\Http\Controllers\Admin\ProductReviews;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Admin\ProductReviews\DeleteRequest;
use App\Models\ProductReview;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;

class Delete extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param DeleteRequest $request
     * @param int $productReviewId
     * @return JsonResponse
     */
    public function __invoke(DeleteRequest $request, int $productReviewId)
    {
        $productReview = ProductReview::find($productReviewId);
        $this->authorize('adminDelete', $productReview);
        $productReview->delete();

        return ResponseUtils::success();
    }
}
