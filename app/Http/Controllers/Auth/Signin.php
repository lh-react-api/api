<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Signin extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

//            $user->tokens()->where('name', $user->email.'_Token')->delete();
//            $token = $user->createToken($user->email.'_Token')->plainTextToken;

//            $user->tokens()->where('name', 'token-name')->delete();
//            $token = $user->createToken('token-name')->plainTextToken;

            return ResponseUtils::success();
        }

        return response()->json([], 401);
    }
}
