<?php
namespace App\Http\Requests\MtCustomer;

use Illuminate\Foundation\Http\FormRequest;


/**
 * リクエストパラメータ
 */
class MtCustomerBalanceRequest extends FormRequest
{
    /**
     * jsonの形
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'kbn' => 'required',						//区分
            'cancel' => 'nullable',						//キャンセル
            'delete' => 'nullable',						//削除
            'back' => 'nullable',						//次頁
            'next' => 'nullable',						//前頁
            'execute' => 'nullable',					//実行
        ];
    }

    public function attributes()
    {
        return [
            //'start_customer_cd' => __('validation.attributes.mt_customer.customer_cd'),
            //'end_customer_cd' => __('validation.attributes.mt_customer.customer_cd'),
        ];
    }
}
