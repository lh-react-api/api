<?php

namespace App\Http\Controllers\ProductOrigins;

use App\Http\Controllers\BaseController;
use App\Models\ProductOrigin;
use App\Models\ProductRank;
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


        // フロントに伝えるべきこと：「productTypes」もしくは「productRanks」が空の時は飛ばして欲しい
        // フロントに伝えるべきこと：productsの内容は、安い順番で並ぶので、最初と最後を使って貰えば最大値最小値は出せる
        //　　　　　　　　　　　　　　（フロント側で難しければ、よしなにする）


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

        return ResponseUtils::success(
            $model
        );
    }
}
