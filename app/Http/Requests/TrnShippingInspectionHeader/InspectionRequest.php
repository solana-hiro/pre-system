<?php

namespace App\Http\Requests\TrnShippingInspectionHeader;

use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class InspectionRequest extends FormRequest
{
    /**
     * jsonの形
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'cancel' => 'nullable',					//キャンセル
            'inspection' => 'nullable',				//手検品
            'update' => 'nullable',					//登録
            'year' => 'required',                                //年
            'month' => 'required',                                //月
            'day' => 'required',                                //日
            'inspection_code' => 'nullable',                    //検品担当コード
            'customer_code' => 'nullable',                      //得意先コード
            'delivery_code' => 'nullable',                      //納品先コード
            'order_receive_no' => 'nullable',                   //受注No.
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
