<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class AuthRequest extends FormRequest
{
    /**
     * jsonの形
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_cd' => 'required|max:4',		//ユーザコード
            'password' => 'required|max:64',	//パスワード
        ];
    }

    public function attributes()
    {
        return [
            'user_cd' => __('validation.attributes.mt_users.user_cd'),
            'password' => __('validation.attributes.mt_users.password'),
        ];
    }

}
