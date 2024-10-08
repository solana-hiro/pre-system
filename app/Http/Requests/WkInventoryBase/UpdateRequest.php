<?php

namespace App\Http\Requests\WkInventoryBase;

use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class UpdateRequest extends FormRequest
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
            'execute' => 'nullable',            //実行ボタン
            'now_date_year' => 'nullable',
            'now_date_month' => 'nullable',
            'now_date_day' => 'nullable',
            'implementation_inventory_date_year' => 'nullable',
            'implementation_inventory_date_month' => 'nullable',
            'implementation_inventory_date_day' => 'nullable',
            'start_warehouse_code' => 'nullable',
            'end_warehouse_code' => 'nullable',
            'item_class' => 'nullable',
            'input_code1_start' => 'nullable',
            'input_code1_end' => 'nullable',
            'input_code2_start' => 'nullable',
            'input_code2_end' => 'nullable',
            'input_code3_start' => 'nullable',
            'input_code3_end' => 'nullable',
            'input_code4_start' => 'nullable',
            'input_code4_end' => 'nullable',
            'input_code5_start' => 'nullable',
            'input_code5_end' => 'nullable',
            'input_code6_start' => 'nullable',
            'input_code6_end' => 'nullable',
            'input_code7_start' => 'nullable',
            'input_code7_end' => 'nullable',
            'item_code_start' => 'nullable',
            'item_code_end' => 'nullable',
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
