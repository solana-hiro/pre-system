<?php

namespace App\Http\Requests\TrnDemandHeader;

use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class DataDecisionRequest extends FormRequest
{
    /**
     * jsonの形
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'cancel' => 'nullable',					//キャンセルボタン
            'remove' => 'nullable',					//解除ボタン
            'execute' => 'nullable',                //実行ボタン
            'year' => 'required',                   //対象請求締日　年
            'month' => 'required',                  //対象請求締日　月
            'day' => 'required',                    //対象請求締日　日
            'code_start' => 'required', //
            'code_end' => 'required|gte:code_start', //
        ];
    }

    public function attributes()
    {
        return [
            'code_start' => __('validation.attributes.mt_billing_addresses.billing_address_cd'),
            'code_end' => __('validation.attributes.mt_billing_addresses.billing_address_cd'),
        ];
	}

    public function messages()
    {
        return [
            'code_end.gte' => __('validation.error_messages.range_is_incorrect'),
        ];
    }
}
