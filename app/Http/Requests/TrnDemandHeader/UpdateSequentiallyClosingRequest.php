<?php

namespace App\Http\Requests\TrnDemandHeader;

use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class UpdateSequentiallyClosingRequest extends FormRequest
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
            'update' => 'nullable',                    //更新ボタン
            'billing_address_code' => 'nullable',      //請求先コード
            'closing_year' => 'nullable',  //締日  年
            'closing_month' => 'nullable', //締日  月
            'closing_day' => 'nullable',   //締日　日
            'collect_year' => 'nullable',   //回収日付 年
            'collect_month' => 'nullable',   //回収日付 月
            'collect_day' => 'nullable',   //回収日付 日
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
