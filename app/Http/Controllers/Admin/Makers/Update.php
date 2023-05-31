<?php

namespace App\Http\Controllers\Admin\Makers;

use App\Http\Controllers\BaseController;
use App\Exceptions\UpdateResourceException;
use App\Http\Controllers\Requests\Admin\Makers\UpdateRequest;
use App\Models\domains\makers\MakerEntity;
use App\Models\Maker;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class Update extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param UpdateRequest $request
     * @param int $makerId
     * @return JsonResponse
     */
    public function __invoke(UpdateRequest $request, int $makerId)
    {
        $input = new Collection($request->input());
        $maker = Maker::find($makerId);
        $this->authorize('adminUpdate', $maker);
        $maker->put(
            new MakerEntity(
                $input->get('name'),
                $input->get('information')
            )
        );
        $maker->save();

        return ResponseUtils::success($maker);
    }
}
