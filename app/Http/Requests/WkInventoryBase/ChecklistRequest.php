<?php

namespace App\Http\Requests\WkInventoryBase;

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
            'excel' => 'nullable',                //EXCEL出力ボタン
            'now_inventory_date_year' => 'nullable',
            'now_inventory_date_month' => 'nullable',
            'implementation_inventory_date_year_start' => 'nullable',
            'implementation_inventory_date_month_start' => 'nullable',
            'implementation_inventory_date_day_start' => 'nullable',
            'implementation_inventory_date_year_end' => 'nullable',
            'implementation_inventory_date_month_end' => 'nullable',
            'implementation_inventory_date_day_end' => 'nullable',
            'user_code_start' => 'nullable',
            'user_code_end' => 'nullable',
            'warehouse_code_start' => 'nullable',
            'warehouse_code_end' => 'nullable',
            'shelf_number_start' => 'nullable',
            'shelf_number_end' => 'nullable',
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
            'output_kbn' => 'nullable',
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
