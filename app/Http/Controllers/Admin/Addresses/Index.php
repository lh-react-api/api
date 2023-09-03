<?php

namespace App\Http\Controllers\Admin\Addresses;

use App\Http\Controllers\BaseController;
use App\Models\Address;
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
        $query = (new Address())->newQuery()->searchIndex($request);
        $this->authorize('adminView', new Address());
        return $this->paginate($query, $request);
    }
}
