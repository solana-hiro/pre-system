<?php

namespace App\Http\Requests\TrnInOutHeader;

use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class WarehouseListRequest extends FormRequest
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
            'output_kbn' => 'nullable',
            'item_class' => 'nullable',
            'customer_class_start' => 'nullable',
            'customer_class_end' => 'nullable',
            'customer_class_start_2' => 'nullable',
            'customer_class_end_2' => 'nullable',
            'customer_class_start_3' => 'nullable',
            'customer_class_end_3' => 'nullable',
            'customer_class_start_4' => 'nullable',
            'customer_class_end_4' => 'nullable',
            'customer_class_start_5' => 'nullable',
            'customer_class_end_5' => 'nullable',
            'customer_class_start_6' => 'nullable',
            'customer_class_end_6' => 'nullable',
            'customer_class_start_7' => 'nullable',
            'customer_class_end_7' => 'nullable',
            'item_code_start' => 'nullable',
            'item_code_end' => 'nullable',
            'warehouse_code_start' => 'nullable',
            'warehouse_code_end' => 'nullable',
            'color_code_start' => 'nullable',
            'color_code_end' => 'nullable',
            'size_code_start' => 'nullable',
            'size_code_end' => 'nullable',
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
