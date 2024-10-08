<?php

namespace App\Http\Requests\WkInventoryBase;

use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class SlipRequest extends FormRequest
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
            'excel' => 'nullable',                //EXCEL出力ボタン
            'year' => 'nullable',
            'month' => 'nullable',
            'day' => 'nullable',
            'item_class' => 'nullable',
            'code1_start' => 'nullable',
            'code1_end' => 'nullable',
            'code2_start' => 'nullable',
            'code2_end' => 'nullable',
            'code3_start' => 'nullable',
            'code3_end' => 'nullable',
            'code4_start' => 'nullable',
            'code4_end' => 'nullable',
            'code5_start' => 'nullable',
            'code5_end' => 'nullable',
            'code6_start' => 'nullable',
            'code6_end' => 'nullable',
            'code7_start' => 'nullable',
            'code7_end' => 'nullable',
            'item_code_start' => 'nullable',
            'item_code_end' => 'nullable',
            'output_kbn' => 'nullable',
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
