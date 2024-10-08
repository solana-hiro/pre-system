<?php

namespace App\Http\Requests\TrnPaymentHeader;

use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class ListRequest extends FormRequest
{
    /**
     * jsonの形
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'cancel' => 'nullable',				//キャンセルボタン
            'excel' => 'nullable',				//Excel
            'year_start' => 'required',               //対象年月日　年
            'month_start' => 'required',               //対象年月日　月
            'day_start' => 'required',                 //対象年月日　日
            'code_start' => 'nullable',          //請求先コード範囲 開始
            'code_end' => 'nullable',            //請求先コード範囲 終了
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
