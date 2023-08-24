<?php

namespace App\Http\Controllers\My\Credits;

use App\Enums\Credits\CreditsStatus;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\My\Credit\DeleteRequest;
use App\Models\Credit;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;

class Delete extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param DeleteRequest $request
     * @param int $creditId
     * @return JsonResponse
     */
    public function __invoke(DeleteRequest $request, int $creditId)
    {
        $credit = Credit::find($creditId);
        $this->authorize('update', $credit);
        $credit->updateStatus(CreditsStatus::DISABLE);
        return ResponseUtils::success();
    }
}
