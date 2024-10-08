<?php

namespace App\Http\Requests\TrnOrderHeader;

use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class OrderBalanceListItemRequest extends FormRequest
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
            'item_code_start' => 'nullable',
            'item_code_end' => 'nullable',
            'year_start' => 'nullable',
            'month_start' => 'nullable',
            'day_start' => 'nullable',
            'year_end' => 'nullable',
            'month_end' => 'nullable',
            'day_end' => 'nullable',
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
