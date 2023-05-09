<?php

namespace App\Enums\Products\Users;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Users\UpdateByReissuePasswordRequest;
use App\Http\Controllers\Requests\Users\UpdateEmailRequest;
use App\Models\User;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;

class UpdateByReissuePassword extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param UpdateEmailRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function __invoke(UpdateByReissuePasswordRequest $request, string $emailReissueToken)
    {

        $user = User::findByEmailReissueToken($emailReissueToken);

        $user->updatePassword($request->input()['password']);
        $user->updateColumn(null, 'email_reissue_token');

        return ResponseUtils::success($user);
    }
}
