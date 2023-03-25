<?php

namespace App\Http\Controllers\ProductOrigins;

use App\Http\Controllers\BaseController;
use App\Models\ProductOrigin;
use App\Utilities\ResponseUtils;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Show extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function __invoke(Request $request, int $id)
    {
        $model = ProductOrigin::findForShow($id);

        return ResponseUtils::success(
            $model
        );
    }
}
