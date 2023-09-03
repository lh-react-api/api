<?php

namespace App\Http\Controllers\Admin\ProductReviews;

use App\Http\Controllers\BaseController;
use App\Models\ProductReview;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Show extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param int $productReviewId
     * @return JsonResponse
     */
    public function __invoke(Request $request, int $productReviewId)
    {
        $productReview = ProductReview::findForShow($productReviewId);
        $this->authorize('adminView', $productReview);
        return ResponseUtils::success(
            $productReview
        );
    }
}
