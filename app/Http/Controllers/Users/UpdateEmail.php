<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Users\UpdateEmailRequest;
use App\Models\User;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;

class UpdateEmail extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param UpdateEmailRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function __invoke(UpdateEmailRequest $request, int $id)
    {
        $user = User::find($id);
        $this->authorize('update', $user);

        $user->updateColumn($request->input()['email'], 'email');

        return ResponseUtils::success($user);
    }
}
