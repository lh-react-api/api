<?php

namespace App\Http\Controllers\Admin\Makers;

use App\Exceptions\DatabaseErrorException;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Admin\Makers\StoreRequest;
use App\Models\Maker;
use App\Models\domains\Makers\MakerEntity;
use App\Utilities\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class Store extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param StoreRequest $request
     * @return JsonResponse
     * @throws DatabaseErrorException
     */
    public function __invoke(StoreRequest $request)
    {

        $input = new Collection($request->input());

        $makers = Maker::create(new MakerEntity(
            $input->get('name'),
            $input->get('information'),
        ));

        $this->authorize('adminCreate', $makers);
        return ResponseUtils::success($makers);
    }
}
