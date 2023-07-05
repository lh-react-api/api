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
        $activeProductTypeIds = $model->activeProducts->pluck('product_type_id')->unique();

        // TODO: $activeProductTypeIdsがなかったら在庫切れだよね
        // throw new NotFount();

        // 商品ランクの戻り値を生成
        $model->productTypes = ProductType::query()->whereIn('id', $activeProductTypeIds->toArray())->get();
        // 以降利用する商品種別を決定、リクエストがなければデフォルトをサーバーで決めてしまう。
        $productTypeId = $request->get('product_type_ida') ?? $activeProductTypeIds->first();

        // 選択された表品種別に基づいた、商品ランクを取得
        $model->productRanks = $this->getProductRankWithActiveProductByTypeId($model, $productTypeId);

        $productIds = ProductOrigin::with( 'products')->find($id)->products->pluck('id')->unique();

        // これレビューが全てのレビューになっているの注意
        $productReviewsInfos = $this->getProductReviewsInfos($productIds);
        $model->productReviews = $productReviewsInfos->productReviews;
        $model->productReviewNumbers = $productReviewsInfos->productReviewNumbers;
        $model->productReviewNumberAve = $productReviewsInfos->productReviewNumberAve;

        // 画像はproductに紐付ける
        return ResponseUtils::success(
            $model
        );

//        $productTypeIds = $model->activeProducts->pluck('product_type_id')->unique();
//        $productRankIds = $model->activeProducts->pluck('product_rank_id')->unique();
//        // 商品種別と商品原本に紐づく商品
//        $model->productTypes_old = $this->getProductTypeWithActiveProduct($id, $productTypeIds);
//        // 商品ランクと商品原本に紐づく商品
//        $model->productRanks_old = $this->getProductRankWithActiveProduct($id, $productRankIds);

    }

    private function getProductRankWithActiveProductByTypeId($model, $productTypeId) {
        $carry = [];
        ProductRank::all()->map(function ($current) use ($model, $productTypeId, &$carry){
            $current->products = $model
                ->activeProducts
                ->where('product_type_id', $productTypeId)
                ->where('product_rank_id', $current->id)
            ;
            $carry[] = $current;
        });
        return $carry;
    }
    private function getProductTypeWithActiveProduct ($productOriginId, $productTypeIds) {
        return $productTypeIds->reduce(function ($carry, $item) use ($productOriginId) {
            $result = ProductType::with(['products' => function ($query) use ($productOriginId) {
                return $query
                    ->where('product_origin_id', $productOriginId)
                    ->orderBy('price', 'asc');
            }])->find($item);

            return $carry->push($result);
        }, new Collection([]));
    }
    private function getProductRankWithActiveProduct ($productOriginId, $productRankIds) {
        return $productRankIds->reduce(function ($carry, $item) use ($productOriginId) {
            $result = ProductRank::with(['products' => function ($query) use ($productOriginId) {
                return $query
                    ->where('product_origin_id', $productOriginId)
                    ->orderBy('price', 'asc');
            }])->find($item);

            return $carry->push($result);
        }, new Collection([]));
    }

    private function getProductReviewsInfos($productIds) {

        $result = new \stdClass();
        $result->productReviews = ProductReview::query()->whereIn('product_id', $productIds)->get();
        $result->productReviewNumbers = [
            1 => $result->productReviews->where('evaluation', 1)->count(),
            2 => $result->productReviews->where('evaluation', 2)->count(),
            3 => $result->productReviews->where('evaluation', 3)->count(),
            4 => $result->productReviews->where('evaluation', 4)->count(),
            5 => $result->productReviews->where('evaluation', 5)->count()
        ];

        $productReviewCount = 0;
        collect($result->productReviewNumbers)->map(function ($item, $key) use (&$productReviewCount){
            $productReviewCount += $item * $key;
        });

        $result->productReviewNumberAve =
            round($productReviewCount / $result->productReviews->count(), 1);

        return $result;
    }
}
