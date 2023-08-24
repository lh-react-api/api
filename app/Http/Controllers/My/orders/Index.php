<?php

namespace App\Http\Controllers\My\orders;

use App\Http\Controllers\BaseController;
use App\Models\Order;
use App\Utilities\ResponseUtils;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();
        $this->authorize('view', $user);

        $query = (new Order)->newQuery()
            ->where('user_id', $user->id)
            ->searchIndex($request);
        return $this->paginate($query, $request);
    }
}
