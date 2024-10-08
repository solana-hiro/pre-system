<?php
namespace App\Http\Requests\MtCustomer;

use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class MtCustomerExportRequest extends FormRequest
{
    /**
     * jsonの形
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'error_output' => 'nullable',								//エラー出力
            'import' => 'nullable',										//インポート
            'execute' => 'nullable',									//実行
            'file' => 'nullable',										//ファイル
            //'code_start' => 'nullable',								//対象得意先分類コード範囲 START
            //'code_end' => 'nullable',									//対象得意先分類コード範囲 END
			//'customer_class_thing_id' => 'required',					//対象得意先分類ID
        ];
    }

    public function attributes()
    {
        return [
            //'customer_class_thing_name' => __('validation.attributes.mt_customer_class.customer_class_thing_name'),
            //'code_start' => __('validation.attributes.mt_customer_class.code_start'),
            //'code_end' => __('validation.attributes.mt_customer_class.code_end'),
            //'customer_class_thing_id' => __('validation.attributes.mt_customer_class.customer_class_thing_name'),
        ];
    }
}
