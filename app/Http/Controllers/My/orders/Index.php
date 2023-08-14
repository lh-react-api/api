<?php

namespace App\Http\Controllers\My\orders;

use App\Http\Controllers\BaseController;
use App\Models\Order;
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

        $order = Order::query()
            ->where('user_id', $user->id)
        ;

        return $this->paginate($order, $request);
    }
}
