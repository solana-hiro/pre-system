<?php

namespace App\Http\Requests\TrnPaymentHeader;

use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class CustomerLedgerRequest extends FormRequest
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
            'excel' => 'nullable',                //Excel
            'year_start' => 'required',               //対象年月日　開始年
            'month_start' => 'required',               //対象年月日　開始月
            'day_start' => 'required',                 //対象年月日　開始日
            'year_end' => 'required',                 //対象年月日　終了年
            'month_end' => 'required',               //対象年月日　終了月
            'day_end' => 'required',                 //対象年月日　終了日
            'billing_address_code_start' => '',                 //請求先コード範囲  開始
            'billing_address_code_end' => '',                 //請求先コード範囲　終了
            'output_kbn' => '',                 //出力条件
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
