<?php

namespace App\Http\Requests\TrnDemandHeader;

use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class HistoryInquiryRequest extends FormRequest
{
    /**
     * jsonの形
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'cancel' => 'nullable',                    //キャンセルボタン
            'back' => 'nullable',                      //戻るボタン
            'next' => 'nullable',                      //次へボタン
            'execute' => 'nullable',                   //実行ボタン
            'year' => 'nullable',                      //対象請求締日 年
            'month' => 'nullable',                     //対象請求締日　月
            'day' => 'nullable',                       //対象請求締日　日
            'billing_address_code_start' => '',        //請求先コード範囲  開始
            'billing_address_code_end' => '',          //請求先コード範囲　終了
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
