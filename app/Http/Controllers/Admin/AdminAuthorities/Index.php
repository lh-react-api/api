<?php

namespace App\Http\Controllers\Admin\AdminAuthorities;

use App\Http\Controllers\BaseController;
use App\Models\AdminAuthority;
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
        $query = (new AdminAuthority())->newQuery()->searchIndex($request);
        // TODO
        // 一覧表示の場合どういった方法でmodelを渡すか相談
        // $this->authorize('view', new AdminAuthority());
        return $this->paginate($query, $request);
    }
}
