<?php

namespace App\Http\Controllers\DeliverTimes;

use App\Http\Controllers\BaseController;
use App\Models\DeliverTime;
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
        $query = (new DeliverTime)->newQuery()->searchIndex($request);

        return $this->paginate($query, $request);
    }
}
