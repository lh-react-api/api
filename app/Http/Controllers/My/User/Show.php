<?php

namespace App\Http\Controllers\My\User;

use App\Http\Controllers\BaseController;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Show extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user();
        $this->authorize('view', $user);

        return ResponseUtils::success(
            $user
        );
    }
}
