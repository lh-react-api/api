<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Auth\SignupRequest;
use App\Models\domains\Users\Credential;
use App\Models\User;
use App\Models\Stripe;
use App\Models\Credit;
use App\Models\domains\Credits\CreditEntity;

;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class Signup extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param SignupRequest $request
     * @return JsonResponse
     */
    public function __invoke(SignupRequest $request)
    {

        $credentials = new Credential($request->input('email'), $request->input('password'));
        User::create($credentials);
        $stripeCustomer = (new Stripe)->createCustomer($request->input('email'));
        Credit::create(new CreditEntity(
            User::findByEmail($request->input('email'))->id,
            $stripeCustomer->id
        ));
        if (Auth::attempt($credentials->toArray())) {
            $user = Auth::user();
            $user->tokens()->where('name', 'api_token')->delete();
            $token = $request->user()->createToken('api_token');
            return ResponseUtils::success(['token' => $token->plainTextToken]);
        }

        return response()->json(['認証登録失敗'], Response::HTTP_BAD_REQUEST);
    }
}
