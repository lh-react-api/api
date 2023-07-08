<?php

namespace App\Http\Controllers\My\User;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\My\User\UpdateEmailRequest;
use App\Utilities\ResponseUtils;
use App\Models\Stripe\StripeCustomer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UpdateEmail extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param UpdateEmailRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function __invoke(UpdateEmailRequest $request)
    {
        $user = Auth::user();
        $this->authorize('update', $user);

        $user->updateColumn($request->input()['email'], 'email');
        $stripe = new StripeCustomer();
        $stripe->setMyCustomerId();
        $stripe->updateCustomerEmail($request->input()['email']);
        return ResponseUtils::success($user);
    }
}
