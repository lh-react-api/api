<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Users\UpdateEmailRequest;
use App\Http\Controllers\Requests\Users\UpdatePasswordRequest;
use App\Models\User;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UpdatePassword extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param UpdateEmailRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function __invoke(UpdatePasswordRequest $request, int $id)
    {
        $user = User::find($id);
        $this->authorize('update', $user);
        $user->updatePassword($request->input()['password']);

        return ResponseUtils::success($user);
    }
}
