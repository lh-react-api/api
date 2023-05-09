<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\BaseController;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authed extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        return ResponseUtils::success(
            Auth::user()
        );

    }
}
