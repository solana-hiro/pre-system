<?php

namespace App\Http\Requests\TrnSaleHeader;

use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class UpdateSalesDecisionRequest extends FormRequest
{
    /**
     * jsonの形
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'cancel' => 'nullable',                 //キャンセルボタン
            'execute' => 'nullable',                //プレビューボタン
            'update' => 'nullable',                 //登録ボタン
            'input_user' => 'nullable',             //入力者
            'year' => 'nullable',                               //納期　年
            'month' => 'nullable',                               //納期　月
            'day' => 'nullable',                               //納期　日
            'customer_code' => 'nullable|max:6',                               //得意先コード
            'delivery_name' => 'nullable|max:6',                               //納品先コード
            'order_receive_id' => 'nullable',                               //受注NO.
            'mt_shipping_company_id' => 'nullable',                        //発送便
            'shipping_document_numbers1' => 'nullable',                  //送り状番号1
            'shipping_document_numbers2' => 'nullable',                  //送り状番号2
            'piece_number' => 'nullable',                               //個口数

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
