<?php

namespace App\Http\Controllers\Items;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Items\StoreRequest;
use App\Models\Item;
use App\Utilities\ResponseUtils;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class Store extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param StoreRequest $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function __invoke(StoreRequest $request): JsonResponse
    {

        $input = new Collection($request->input());

        $item = Item::create(
            $input->get('name'),
            $input->get('price'),
            $input->get('content')
        );

        $this->authorize('create', $item);

        return ResponseUtils::success($item);
    }
}
