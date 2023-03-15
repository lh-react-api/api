<?php

namespace App\Http\Controllers\Users;

use App\Enums\Users\UsersStatus;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Users\UpdateEmailRequest;
use App\Http\Controllers\Requests\Users\UpdateStatusWithdrawalRequest;
use App\Models\User;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;

class UpdateStatusWithdrawal extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param UpdateEmailRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function __invoke(UpdateStatusWithdrawalRequest $request, int $id)
    {
        $user = User::find($id);
        $this->authorize('update', $user);

        $user->updateColumn(UsersStatus::WITHDRAWAL, 'status');

        return ResponseUtils::success($user);
    }
}
