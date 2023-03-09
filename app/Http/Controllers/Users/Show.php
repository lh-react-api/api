<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\BaseController;
use App\Models\User;
use App\Utilities\ResponseUtils;
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
        return ResponseUtils::success(
            User::findForShow($id)
        );
    }
}
