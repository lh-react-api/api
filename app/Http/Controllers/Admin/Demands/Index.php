<?php

namespace App\Http\Controllers\Admin\Demands;

use App\Http\Controllers\BaseController;
use App\Models\Demand;
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
        $query = (new Demand())->newQuery()->searchIndex($request);
        // TODO
        // 一覧表示の場合どういった方法でmodelを渡すか相談
        $this->authorize('adminView', new Demand());
        return $this->paginate($query, $request);
    }
}
