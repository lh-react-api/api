<?php

namespace App\Http\Controllers\Admin\InquiryTypes;

use App\Http\Controllers\BaseController;
use App\Models\InquiryType;
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
        $query = (new InquiryType())->newQuery()->searchIndex($request);
        // TODO
        // 一覧表示の場合どういった方法でmodelを渡すか相談
        // $this->authorize('view', $model);
        return $this->paginate($query, $request);
    }
}
