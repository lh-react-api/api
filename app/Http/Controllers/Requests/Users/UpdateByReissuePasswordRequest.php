<?php

namespace App\Http\Controllers\Requests\Users;

use App\Exceptions\BadRequestException;
use App\Http\Controllers\Requests\BaseFormRequest;
use App\Models\User;


/**
 * Class MemberLoginRequest
 * @package App\Http\Controllers\Requests
 */
class UpdateByReissuePasswordRequest extends BaseFormRequest
{
    const DEFAULT_NAME = 'ユーザ';
    const ROUTE_KEY = 'user_id';
    /**
     * @return bool
     */
    public function authorize()
    {
        $entity = User::findByEmailReissueToken($this->email_reissue_token);

        if (!isset($entity)) {//Response::HTTP_BAD_REQUEST
            $exception = new BadRequestException('', 403, ['errors' => [
                'レコードの存在しないtokenです。'
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
            'email_reissue_token' => ['required', 'min:64', 'max:64'],
            'password' => ['required', 'max:255'],

        ];
    }

    public function attributes()
    {
        return [];
    }

    public function validationData()
    {

        return array_merge($this->request->all(), [
            'email_reissue_token' => $this->route('email_reissue_token'),
        ]);
    }
}
