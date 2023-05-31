<?php

namespace App\Http\Controllers\Notices;

use App\Http\Controllers\BaseController;
use App\Models\Notice;
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
        $query = (new Notice)->active()->orderBy('notice_date');

        return $this->paginate($query, $request);
    }
}
