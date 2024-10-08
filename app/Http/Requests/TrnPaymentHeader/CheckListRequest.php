<?php

namespace App\Http\Requests\TrnPaymentHeader;

use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class CheckListRequest extends FormRequest
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
            'sort_order' => 'required',       //出力順
            'year_start' => 'required',       //対象日付　開始年
            'month_start' => 'required',       //対象日付　開始月
            'day_start' => 'required',       //対象日付　開始日
            'year_end' => 'required',       //対象日付　終了年
            'month_end' => 'required',       //対象日付　終了月
            'day_end' => 'required',       //対象日付　終了日
            'kbn' => 'required',       //処理区分
            'customer_code_start' => 'nullable',       //得意先コード範囲  開始
            'customer_code_end' => 'nullable',       //得意先コード範囲　終了
            'manager_code_start' => 'nullable',       //担当者コード範囲  開始
            'manager_code_start' => 'nullable',       //担当者コード範囲　終了
            'slip_no_start' => 'nullable',       //入金伝票No.範囲　開始
            'slip_no_end' => 'nullable',       //入金伝票No.範囲　終了
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
