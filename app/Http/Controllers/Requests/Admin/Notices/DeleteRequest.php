<?php

namespace App\Http\Controllers\Requests\Admin\Notices;


use App\Http\Controllers\Requests\BaseFormRequest;
use App\Models\Notice;


/**
 * Class MemberLoginRequest
 * @package App\Http\Controllers\Requests
 */
class DeleteRequest extends BaseFormRequest
{
    const ROUTE_KEY = 'notice_id';
    /**
     * @return bool
     */
    public function authorize()
    {
        $this->existsRecordById((new Notice()), (int)$this->route(self::ROUTE_KEY));

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            self::ROUTE_KEY => [
                //TODO: 他のリレーションがあって削除できない時のバリデーション
//                new NotExist((new Users)->getTable(), (int)$this->route(self::ROUTE_KEY)),
            ]
        ];
    }

    public function validationData()
    {
        return array_merge($this->request->all(), [
            self::ROUTE_KEY => (int)$this->route(self::ROUTE_KEY),
        ]);
    }
}
