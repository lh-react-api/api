<?php

namespace App\Http\Controllers\My\User;

use App\Enums\Users\UsersStatus;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\My\User\UpdateStatusWithdrawalRequest;
use App\Utilities\ResponseUtils;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UpdateStatusWithdrawal extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param UpdateStatusWithdrawalRequest $request
     * @param int $id
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function __invoke(UpdateStatusWithdrawalRequest $request)
    {
        $user = Auth::user();
        $this->authorize('update', $user);

        $user->updateColumn(UsersStatus::WITHDRAWAL, 'status');

        return ResponseUtils::success($user);
    }
}
