<?php

namespace App\Http\Requests\TrnSaleHeader;

use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class UpdateSalesDataRequest extends FormRequest
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
            'preview' => 'nullable',				//プレビューボタン
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
