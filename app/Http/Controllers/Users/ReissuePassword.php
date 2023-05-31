<?php

namespace App\Http\Controllers\Users;

use App\Exceptions\UpdateEmailUserException;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Users\ReissuePasswordRequest;
use App\Http\Controllers\Requests\Users\UpdateEmailRequest;
use App\Mail\ReissuePasswordMail;
use App\Models\User;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

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

        if ($user->social !== null) {
            throw new UpdateEmailUserException('', 403, ['ソーシャル認証のユーザは変更できません。']);
        }

        $user->updateColumn(hash('sha256', uniqid()), 'email_reissue_token');

        $user->save();

        Mail::send(new ReissuePasswordMail($user));

        return ResponseUtils::success([]);
    }
}
