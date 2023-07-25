<?php

namespace App\Http\Controllers\Requests\Orders;

use App\Http\Controllers\Requests\BaseFormRequest;
use App\Models\Order;

/**
 * Class MemberLoginRequest
 * @package App\Http\Controllers\Requests
 */
class ShowRequest extends BaseFormRequest
{
    const ROUTE_KEY = 'order_id';
    public function authorize()
    {
        $this->existsRecordById((new Order()), (int)$this->route(self::ROUTE_KEY));

        return true;
    }
}
