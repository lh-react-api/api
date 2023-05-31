<?php

namespace App\Http\Controllers\Requests\Notices;

use App\Http\Controllers\Requests\BaseFormRequest;
use App\Models\Notice;
use App\Models\User;
use Illuminate\Validation\Rule;

/**
 * Class MemberLoginRequest
 * @package App\Http\Controllers\Requests
 */
class ShowRequest extends BaseFormRequest
{
    const DEFAULT_NAME = 'お知らせ';
    const ROUTE_KEY = 'notice_id';

    public function authorize()
    {
        $this->existsRecordById((new Notice), (int)$this->route(self::ROUTE_KEY));

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

        ];
    }

    public function attributes()
    {
        return [
            'name' => self::DEFAULT_NAME. "名",
        ];
    }
}
