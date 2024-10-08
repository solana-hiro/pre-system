<?php
namespace App\Http\Requests\MtCustomerOtherItemRate;

use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class ExportRequest extends FormRequest
{
    /**
     * jsonの形
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        /**
         * jsonの形
         *
         * @return array<string, mixed>
         */
        if ($this->has('cancel')) {
            $rules = [
                'cancel' => 'nullable',
            ];
        }
        if ($this->has('excel')) {
            $rules = [
                'excel' => 'nullable',
                'customer_code_start' => 'nullable|numeric',         //得意先コード範囲 開始
                'customer_code_end' => 'nullable|numeric|gte:customer_code_start',      //得意先コード範囲 終了
                'item_code_start' => 'nullable|numeric',
                'item_code_end' => 'nullable|numeric|gte:item_code_start',
            ];
        }
        if ($this->has('preview')) {
            $rules = [
                'preview' => 'nullable',
                'customer_code_start' => 'nullable|numeric',         //得意先コード範囲 開始
                'customer_code_end' => 'nullable|numeric|gte:customer_code_start',      //得意先コード範囲 終了
                'item_code_start' => 'nullable|numeric',
                'item_code_end' => 'nullable|numeric|gte:item_code_start',
            ];
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'customer_code_start' => __('validation.attributes.mt_customers.customer_cd_start'),
            'customer_code_end' => __('validation.attributes.mt_customers.customer_cd_end'),
            'item_code_start' => __('validation.attributes.mt_items.item_cd_start'),
            'item_code_end' => __('validation.attributes.mt_items.item_cd_end'),
        ];
    }

    public function messages()
    {
        return [
            'customer_code_end.gte' => __('validation.error_messages.range_is_incorrect'),
            'item_code_end.gte' => __('validation.error_messages.range_is_incorrect'),
        ];
    }
}
