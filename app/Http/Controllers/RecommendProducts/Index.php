<?php

namespace App\Http\Controllers\RecommendProducts;

use App\Http\Controllers\BaseController;
use App\Models\closure_table\Genres;
use App\Models\RecommendProduct;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class Index extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function __invoke(Request $request)
    {
        $query = (new RecommendProduct)
            ->newQuery()
            ->with(['product'])
            ->searchIndex($request)
        ;

        return $this->paginate($query, $request);
    }
}
