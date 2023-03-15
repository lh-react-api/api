<?php

namespace App\Http\Controllers\Requests\Users;

use App\Exceptions\BadRequestException;
use App\Http\Controllers\Requests\BaseFormRequest;
use App\Models\User;


/**
 * Class MemberLoginRequest
 * @package App\Http\Controllers\Requests
 */
class ReissuePasswordRequest extends BaseFormRequest
{
    const DEFAULT_NAME = 'ユーザ';
    const ROUTE_KEY = 'user_id';
    /**
     * @return bool
     */
    public function authorize()
    {
        $entity = User::findByEmail($this->email);

        if (!isset($entity)) {//Response::HTTP_BAD_REQUEST
            $exception = new BadRequestException('', 403, ['errors' => [
                'レコードの存在しないemailです。'
            ]]);

            throw $exception;
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            'email' => ['required', 'max:255'],
        ];
    }

    public function attributes()
    {
        return [];
    }

    public function validationData()
    {
        return array_merge($this->request->all(), [
            'email' => $this->route('email'),
        ]);
    }
}
