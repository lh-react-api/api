<?php

namespace App\Http\Controllers\Users;

use App\Exceptions\UpdateEmailUserException;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Users\ReissuePasswordRequest;
use App\Http\Controllers\Requests\Users\UpdateEmailRequest;
use App\Models\User;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class ReissuePassword extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param UpdateEmailRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function __invoke(ReissuePasswordRequest $request, string $email)
    {
        $user = User::findByEmail($email);

        $user->email_reissue_token = hash('sha256', uniqid());

        if ($user->social !== null) {
            throw new UpdateEmailUserException('', 403, ['ソーシャル認証のユーザは変更できません。']);
        }

        // sendmail

        return ResponseUtils::success([]);
    }
}
