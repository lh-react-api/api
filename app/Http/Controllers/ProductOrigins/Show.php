<?php

namespace App\Http\Controllers\ProductOrigins;

use App\Exceptions\NotFoundRequestException;
use App\Http\Controllers\BaseController;
use App\Models\Product;
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
     *
     * このAPIは商品種別によって、商品ランクが変わるそのため商品を特定している状態にしたい。
     * 商品が特定されてるケースは通常処理
     * 商品種別が特定されている場合は、それを用いてその中で一番安いものを選択中の商品とする
     * 何もリクエストがない場合は、一番安い在庫商品を特定状態にする
     * @throws NotFoundRequestException
     */
    public function __invoke(Request $request, int $id)
    {
        $model = ProductOrigin::findForShow($id);

        // activeProductsは安い順に並んでいる
        // 高い順に変える?
        
        // MEMO: 画像はproductのを使うのか、productOriginのサムネイルから使うのか、種別ごとに足すのか相談して決める
        //       product_typeに紐づくテーブルを用意して対応した。


        $model->selectedProduct = (function () use ($request, $model){
            // 商品が特定されている
            if (!empty($request->get('product_id'))) {
                return Product::find($request->get('product_id'));
            }
            // 商品タイプだけ特定されている
            if (!empty($request->get('product_type_id'))) {
                return Product::query()
                    ->where('product_type_id', $request->get('product_type_id'))
                    ->orderBy('price', 'asc')
                    ->first();
            }
            // 何も特定されていないので一番安いのを用いる
            // activeProductsは安い順に並んでいる
            return $model->activeProducts->first();
        })();

         if (empty($model->selectedProduct)) {
             throw new NotFoundRequestException();
         }

        // アクティブな商品に紐づく商品タイプを全て返却
        $activeProductTypeIds = $model->activeProducts->pluck('product_type_id')->unique();
        $model->productTypes = ProductType::with('product_type_images')->whereIn('id', $activeProductTypeIds->toArray())->get();

        // 選択された表品種別に基づいた、商品ランクを取得
        $model->productRanks = $this->getProductRankWithActiveProductByTypeId($model, $model->selectedProduct->product_type_id);

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
            // $model->activeProductsの並び順が用いられるのでここでは順番を意識しなくてOK
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
