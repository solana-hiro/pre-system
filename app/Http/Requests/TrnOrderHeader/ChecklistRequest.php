<?php

namespace App\Http\Requests\TrnOrderHeader;

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
            'report_kbn' => 'nullable',
            'output_kbn' => 'nullable',
            'year_start' => 'nullable',
            'month_start' => 'nullable',
            'day_start' => 'nullable',
            'year_end' => 'nullable',
            'month_end' => 'nullable',
            'day_end' => 'nullable',
            'process_kbn' => 'nullable',
            'user_cd_start' => 'nullable',
            'user_cd_end' => 'nullable',
            'supplier_cd_start' => 'nullable',
            'supplier_cd_end' => 'nullable',
            'manager_cd_start' => 'nullable',
            'manager_cd_end' => 'nullable',
            'slip_no_start' => 'nullable',
            'slip_no_end' => 'nullable',
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
