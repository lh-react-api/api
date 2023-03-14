<?php

namespace App\Policies;

use App\Exceptions\PolicyException;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class BasePolicy
{
    use HandlesAuthorization;


    protected function byAuthUser(int $userID) {
        if ($userID !== Auth::id()) {
            throw new PolicyException("", Response::HTTP_FORBIDDEN,
                [__('auth.policy.byAuthUser')]
            );
        }
        return true;
    }
}
