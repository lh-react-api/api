<?php

namespace App\Enums\Products\Users;

use App\Http\Controllers\BaseController;
use App\Models\User;
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
        $query = (new User)->newQuery()->searchIndex($request);

        return $this->paginate($query, $request);
    }
}
