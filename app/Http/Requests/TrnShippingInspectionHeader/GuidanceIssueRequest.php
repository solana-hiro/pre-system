<?php

namespace App\Http\Requests\TrnShippingInspectionHeader;

use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class GuidanceIssueRequest extends FormRequest
{
    /**
     * jsonの形
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'cancel' => 'nullable',					  //キャンセルボタン
            'excel' => 'nullable',                    //Excel出力
            'target' => 'required',                   //対象
            'issue_kbn' => 'required',                //発行区分
            'year_start' => 'required|max:4',         //範囲開始年
            'month_start' => 'required|max:2',  //範囲開始月
            'day_start' => 'required|max:2',  //範囲開始日
            'year_end' => 'required|max:4',         //範囲終了年
            'month_end' => 'required|max:2',  //範囲終了月
            'day_end' => 'required|max:2',  //範囲終了日
            'issue_kbn' => 'required',      //発行区分
            'customer_code_start' => '',    //得意先コード　開始
            'customer_code_end' => '',    //得意先コード　終了
            'delivery_code_start' => '',    //納品先コード　開始
            'delivery_code_end' => '',    //納品先コード　終了

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
