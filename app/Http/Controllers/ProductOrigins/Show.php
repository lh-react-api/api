<?php

namespace App\Http\Controllers\ProductOrigins;

use App\Http\Controllers\BaseController;
use App\Models\ProductOrigin;
use App\Models\ProductRank;
use App\Models\ProductReview;
use App\Models\ProductType;
use App\Utilities\ResponseUtils;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class Show extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function __invoke(Request $request, int $id)
    {
        $model = ProductOrigin::findForShow($id);

        $productTypeIds = $model->activeProducts->pluck('product_type_id')->unique();
        $productRankIds = $model->activeProducts->pluck('product_rank_id')->unique();
        $productIds = $model->activeProducts->pluck('id')->unique();

        // MEMO: フロントに伝えるべきこと：「productTypes」もしくは「productRanks」が空の時は飛ばして欲しい
        // フロントに伝えるべきこと：productsの内容は、安い順番で並ぶので、最初と最後を使って貰えば最大値最小値は出せる
        //　　　　　　　　　　　　　　（フロント側で難しければ、よしなにする）
        // とりあえずは在庫にあるものだけ出すようにする

        $model->productTypes = $productTypeIds->reduce(function ($carry, $item) use ($id) {
            $result = ProductType::with(['products' => function ($query) use ($id) {
                return $query
                    ->where('product_origin_id', $id)
                    ->orderBy('price', 'asc');
            }])->find($item);

            return $carry->push($result);
        }, new Collection([]));

        $model->productRanks = $productRankIds->reduce(function ($carry, $item) use ($id) {
            $result = ProductRank::with(['products' => function ($query) use ($id) {
                return $query
                    ->where('product_origin_id', $id)
                    ->orderBy('price', 'asc');
            }])->find($item);

            return $carry->push($result);
        }, new Collection([]));

        //　ProductReview
        $model->productReviews = ProductReview::query()->whereIn('product_id', $productIds)->get();
        $model->productReviewNumbers = [
            1 => $model->productReviews->where('evaluation', 1)->count(),
            2 => $model->productReviews->where('evaluation', 2)->count(),
            3 => $model->productReviews->where('evaluation', 3)->count(),
            4 => $model->productReviews->where('evaluation', 4)->count(),
            5 => $model->productReviews->where('evaluation', 5)->count()
        ];

        $productReviewCount = 0;
        collect($model->productReviewNumbers)->map(function ($item, $key) use (&$productReviewCount){
            $productReviewCount += $item * $key;
        });

        $model->productReviewNumberAve = round($productReviewCount / $model->productReviews->count(), 1);

        return ResponseUtils::success(
            $model
        );
    }
}
