<?php

namespace App\Http\Controllers\ProductReviews;

use App\Exceptions\DatabaseErrorException;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\ProductReviews\StoreRequest;
use App\Models\domains\ProductReviews\ProductReviewEntity;
use App\Models\ProductReview;
use App\Utilities\ResponseUtils;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class Store extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws DatabaseErrorException
     */
    public function __invoke(StoreRequest $request)
    {
        $input = new Collection($request->input());

        $entity = ProductReview::create(new ProductReviewEntity(
            $input->get('product_id'),
            $input->get('user_id') ?? Auth::id(),
            $input->get('title'),
            $input->get('text'),
            $input->get('evaluation'),
        ));

        $entity->save();

        return ResponseUtils::success();
    }
}
