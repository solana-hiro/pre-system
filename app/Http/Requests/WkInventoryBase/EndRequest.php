<?php

namespace App\Http\Requests\WkInventoryBase;

use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class EndRequest extends FormRequest
{
    /**
     * jsonの形
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'execute' => 'nullable',            //実行ボタン
            'year' => 'nullable',
            'month' => 'nullable',
            'day' => 'nullable',
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
