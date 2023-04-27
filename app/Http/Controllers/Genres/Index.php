<?php

namespace App\Http\Controllers\Genres;

use App\Http\Controllers\BaseController;
use App\Models\Genre;
use App\Models\ProductOrigin;
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
        $query = (new Genre)->newQuery()->searchIndex($request);

        return $this->paginate($query, $request);
    }
}
