<?php
namespace App\Http\Requests\MtCustomer;

use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class MtCustomerRequest extends FormRequest
{
    /**
     * jsonの形
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'customer_cd' => 'required',					//得意先名
            'customer_name_kana' => 'required',				//得意先名カナ
            'representative_name' => 'nullable',			//販売代表者名
        ];
    }

    public function attributes()
    {
        return [
            'customer_name' => __('validation.attributes.mt_customer.customer_name'),
            'customer_name_kana' => __('validation.attributes.mt_customer.customer_name_kana'),
            'representative_name' => __('validation.attributes.mt_customer.representative_name'),
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {

    }
}
