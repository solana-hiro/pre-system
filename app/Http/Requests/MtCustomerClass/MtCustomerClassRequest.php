<?php
namespace App\Http\Requests\MtCustomerClass;

use Illuminate\Foundation\Http\FormRequest;
/**
 * リクエストパラメータ
 */
class MtCustomerClassRequest extends FormRequest
{
    /**
     * jsonの形
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'customer_class_thing_name' => 'required',					//対象得意先分類
            'code_start' => 'nullable',									//販売パターン1コード範囲 START
            'code_end' => 'nullable',									//販売パターン1コード範囲 END
        ];
    }

    public function attributes()
    {
        return [
            'customer_class_thing_name' => __('validation.attributes.mt_customer_class.customer_class_thing_name'),
            'code_start' => __('validation.attributes.mt_customer_class.code_start'),
            'code_end' => __('validation.attributes.mt_customer_class.code_end'),
        ];
	}
}
