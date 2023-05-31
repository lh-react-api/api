<?php

namespace App\Http\Controllers\Notices;

use App\Http\Controllers\BaseController;
use App\Models\Address;
use App\Models\Notice;
use App\Utilities\ResponseUtils;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class Show extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function __invoke(Request $request, $id)
    {
        $notice = Notice::find($id);

        return ResponseUtils::success(
            $notice
        );
    }
}
