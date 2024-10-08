<?php
namespace App\Http\Requests\MtCustomerOtherItemClassRate;

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
        if ($this->has('cancel')) {
            $rules = [
                'cancel' => 'nullable',
            ];
        }
        if ($this->has('excel')) {
            $rules = [
                'excel' => 'nullable',
                'customer_code_start' => 'nullable|numeric',         //得意先コード範囲 開始
                'customer_code_end' => 'nullable|numeric|gte:customer_code_start',            //得意先コード範囲 終了
                'brand_code_start' => 'nullable|numeric',
                'brand_code_end' => 'nullable|numeric|gte:brand_code_start',
            ];
        }
        if ($this->has('preview')) {
            $rules = [
                'preview' => 'nullable',
                'customer_code_start' => 'nullable|numeric',         //得意先コード範囲 開始
                'customer_code_end' => 'nullable|numeric|gte:customer_code_start',            //得意先コード範囲 終了
                'brand_code_start' => 'nullable|numeric',
                'brand_code_end' => 'nullable|numeric|gte:brand_code_start',
            ];
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'customer_code_start' => __('validation.attributes.mt_customers.customer_cd_start'),
            'customer_code_end' => __('validation.attributes.mt_customers.customer_cd_end'),
            'brand_code_start' => __('validation.attributes.mt_customer_classes.customer_class_cd_start'),
            'brand_code_end' => __('validation.attributes.mt_customer_classes.customer_class_cd_end'),
        ];
    }

    public function messages()
    {
        return [
            'customer_code_end.gte' => __('validation.error_messages.range_is_incorrect'),
            'brand_code_end.gte' => __('validation.error_messages.range_is_incorrect'),
        ];
    }
}
