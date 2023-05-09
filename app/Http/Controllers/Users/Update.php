<?php

namespace App\Http\Controllers\Users;

use App\Exceptions\UpdateResourceException;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Users\UpdateRequest;
use App\Models\User;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class Update extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param UpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function __invoke(UpdateRequest $request, int $id)
    {
        $input = new Collection($request->only(['name', 'email', 'password']));

        $user = User::find($id);

        $input->map(function ($val, $key) use ($user) {
            if (!isset($user->$key)) {
                throw new UpdateResourceException("更新しようとした${key}がモデルに存在しませんでした。");
            }
            $user->$key = $val;
        });

        $user->save();

        return ResponseUtils::success();
    }
}
