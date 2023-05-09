<?php

namespace App\Http\Controllers\Admin\AdminAuthorities;

use App\Exceptions\DatabaseErrorException;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Requests\Admin\AdminAuthorities\StoreRequest;
use App\Models\AdminAuthority;
use App\Models\domains\AdminAuthorities\InquiryEntity;
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
        // TODO
        // 登録する前にuser_id/role_idに紐づくデータが登録済みかチェックしたい
        // →どこでやるべきか相談s
        // 権限のため組み合わせがユニークである必要がある
        $adminAuthority = AdminAuthority::create(new InquiryEntity(
            $input->get('user_id'),
            $input->get('role_id'),
            $input->get('action'),
        ));

        $this->authorize('adminCreate', $adminAuthority);
        return ResponseUtils::success($adminAuthority);
    }
}
