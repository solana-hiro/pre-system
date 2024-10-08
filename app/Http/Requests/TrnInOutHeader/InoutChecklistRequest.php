<?php

namespace App\Http\Requests\TrnInOutHeader;

use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class InoutCheckListRequest extends FormRequest
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
            'report_kbn' => 'nullable',
            'output_kbn' => 'nullable',
            'date_year_start' => 'nullable',
            'date_month_start' => 'nullable',
            'date_day_start' => 'nullable',
            'date_year_end' => 'nullable',
            'date_month_end' => 'nullable',
            'date_day_end' => 'nullable',
            'process_kbn' => 'nullable',
            'user_cd_start' => 'nullable',
            'user_cd_end' => 'nullable',
            'warehouse_cd_start' => 'nullable',
            'warehouse_cd_end' => 'nullable',
            'in_out_kbn_cd' => 'nullable',
            'item_cd_start' => 'nullable',
            'item_cd_end' => 'nullable',
            'in_out_number_start' => 'nullable',
            'in_out_number_end' => 'nullable',
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
