<?php

namespace App\Http\Requests\MtCustomer;

use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class MtCustomerSearchRequest extends FormRequest
{
    /**
     * jsonの形
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'customer_cd_start' => 'nullable',		//得意先コード 範囲下限
            'customer_cd_end' => 'nullable',		//得意先コード 範囲下限
        ];
    }

    public function attributes()
    {
        return [
            'customer_cd_start' => __('validation.attributes.mt_customer.customer_cd'),
            'customer_cd_end' => __('validation.attributes.mt_customer.customer_cd'),
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {

    }
}
