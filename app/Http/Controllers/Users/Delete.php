<?php

namespace App\Http\Controllers\Users;

use App\Exceptions\UpdateResourceException;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Users\DeleteRequest;
use App\Models\User;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class Delete extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param DeleteRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function __invoke(DeleteRequest $request, int $id)
    {
        $user = User::find($id)->delete();

        $this->authorize('delete', $user);

        return ResponseUtils::success();
    }
}
