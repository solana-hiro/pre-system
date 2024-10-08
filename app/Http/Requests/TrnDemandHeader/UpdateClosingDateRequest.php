<?php

namespace App\Http\Requests\TrnDemandHeader;

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
            'cancel' => 'nullable',		            //キャンセルボタン
            'update' => 'nullable',                 //更新ボタン
            'billing_address_code' => 'nullable',   //請求先コード
            'closing_kbn1' => 'nullable',   //締日1区分
            'closing_date1_month' => 'nullable',  //締日1 何ヶ月後
            'closing_date1_day' => 'nullable',   //締日1 日回収
            'closing_kbn2' => 'nullable',   //締日2区分
            'closing_date3_month' => 'nullable',  //締日2 何ヶ月後
            'closing_date2_day' => 'nullable',   //締日2 日回収
            'closing_kbn3' => 'nullable',   //締日3区分
            'closing_date3_month' => 'nullable',  //締日3 何ヶ月後
            'closing_date3_day' => 'nullable',   //締日3 日回収
            'update_year' => 'nullable',   //更新開始日付 年
            'update_month' => 'nullable',   //更新開始日付 月
            'update_day' => 'nullable',   //更新開始日付 日
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
