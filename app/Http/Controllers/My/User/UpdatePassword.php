<?php

namespace App\Http\Controllers\My\User;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\My\User\UpdatePasswordRequest;
use App\Utilities\ResponseUtils;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UpdatePassword extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param UpdatePasswordRequest $request
     * @param int $id
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function __invoke(UpdatePasswordRequest $request)
    {
        $user = Auth::user();
        $this->authorize('update', $user);
        $user->updatePassword($request->input()['password']);

        return ResponseUtils::success($user);
    }
}
