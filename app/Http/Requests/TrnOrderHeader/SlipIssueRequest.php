<?php

namespace App\Http\Requests\TrnOrderHeader;

use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class SlipIssueRequest extends FormRequest
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
            'preview' => 'nullable',            //プレビュー
            'year_start' => 'nullable',
            'month_start' => 'nullable',
            'day_start' => 'nullable',
            'year_end' => 'nullable',
            'month_end' => 'nullable',
            'day_end' => 'nullable',
            'user_cd_start' => '',
            'user_cd_end' => '',
            'supplier_code_start' => '',
            'supplier_code_end' => '',
            'slip_no_start' => '',
            'slip_no_end' => '',
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
