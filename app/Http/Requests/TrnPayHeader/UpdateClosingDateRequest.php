<?php

namespace App\Http\Requests\TrnPayHeader;

use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class UpdateClosingDateRequest extends FormRequest
{
    /**
     * jsonの形
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'cancel' => 'nullable',					//キャンセルボタン
            'update' => 'nullable',					//更新ボタン
        ];
    }

    public function attributes()
    {
        return [
            //'customer_class_thing_name' => __('validation.attributes.mt_customer_class.customer_class_thing_name'),
            //'code_start' => __('validation.attributes.mt_customer_class.code_start'),
            //'code_end' => __('validation.attributes.mt_customer_class.code_end'),
        ];
	}
}
