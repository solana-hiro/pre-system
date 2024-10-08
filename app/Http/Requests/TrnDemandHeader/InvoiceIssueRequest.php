<?php

namespace App\Http\Requests\TrnDemandHeader;

use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class InvoiceIssueRequest extends FormRequest
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
            'preview' => 'nullable',                //プレビューボタン
            'billing_year' => 'nullable',           //対象請求締日  年
            'billing_month' => 'nullable',          //対象請求締日  月
            'billing_day' => 'nullable',            //対象請求締日  日
            'sort_order' => 'nullable',             //出力順
            'billing_address_code_start' => 'nullable',       //請求先コード範囲  開始
            'billing_address_code_end' => 'nullable',       //請求先コード範囲　終了
            'department_code_start' => 'nullable',       //部門コード範囲  開始
            'department_code_end' => 'nullable',       //部門コード範囲  終了
            'output' => 'nullable',       //出力条件
            'issue_kbn' => 'nullable',       //請求書発行種別
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
