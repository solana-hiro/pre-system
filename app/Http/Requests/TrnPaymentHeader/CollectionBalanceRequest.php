<?php

namespace App\Http\Requests\TrnPaymentHeader;

use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class CollectionBalanceRequest extends FormRequest
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
            'year' => 'required',               //対象年
            'month' => 'required',               //対象月
            'manager_code_start' => 'required',                 //担当者コード範囲  開始
            'manager_code_end' => 'required',                  //担当者コード範囲  開始
            'billing_address_code_start' => 'required',       //請求先コード範囲  開始
            'billing_address_code_end' => '',                 //請求先コード範囲  終了
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
