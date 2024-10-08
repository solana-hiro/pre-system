<?php

namespace App\Http\Requests\TrnSaleHeader;

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
            'cancel' => 'nullable',				         //キャンセルボタン
            'preview' => 'nullable',                     //プレビューボタン
            'document_kbn' => 'required',                //帳票区分
            'sort_order' => 'required',                  //順序
            'year_start' => 'nullable',                  //対象日付　開始年
            'month_start' => 'nullable',                 //対象日付　開始月
            'day_start' => 'nullable',                   //対象日付　開始日
            'year_end' => 'nullable',                    //対象日付　終了年
            'month_end' => 'nullable',                   //対象日付　終了月
            'day_end' => 'nullable',                     //対象日付　終了日
            'process_kbn' => 'nullable',                 //処理区分
            'input_user_code_start' => 'nullable|max:4', //入力者コード範囲　開始
            'input_user_code_end' => 'nullable|max:4',   //入力者コード範囲　終了
            'customer_code_start' => 'nullable|max:6',   //得意先コード範囲　開始
            'customer_code_end' => 'nullable|max:6',     //得意先コード範囲　終了
            'manager_code_start' => 'nullable|max:4',    //担当者コード範囲　開始
            'manager_code_end' => 'nullable|max:4',      //担当者コード範囲　終了
            'manager_code_start' => 'nullable|max:8',    //売上伝票No範囲　開始
            'manager_code_end' => 'nullable|max:8',      //売上伝票No範囲　終了
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
