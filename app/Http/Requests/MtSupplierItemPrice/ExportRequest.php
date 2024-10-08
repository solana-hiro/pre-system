<?php
namespace App\Http\Requests\MtSupplierItemPrice;

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
                'supplier_code_start' => 'nullable|numeric',
                'supplier_code_end' => 'nullable|numeric|gte:supplier_code_start',
                'item_code_start' => 'nullable|numeric',
                'item_code_end' => 'nullable|numeric|gte:item_code_start',
            ];
        }
        if ($this->has('preview')) {
            $rules = [
                'preview' => 'nullable',
                'supplier_code_start' => 'nullable|numeric',
                'supplier_code_end' => 'nullable|numeric|gte:supplier_code_start',
                'item_code_start' => 'nullable|numeric',
                'item_code_end' => 'nullable|numeric|gte:item_code_start',
            ];
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'supplier_code_start' => __('validation.attributes.mt_suppliers.supplier_cd_start'),
            'supplier_code_end' => __('validation.attributes.mt_suppliers.supplier_cd_end'),
            'item_code_start' => __('validation.attributes.mt_items.item_cd_start'),
            'item_code_end' => __('validation.attributes.mt_items.item_cd_end'),
        ];
    }

    public function messages()
    {
        return [
            'supplier_code_end.gte' => __('validation.error_messages.range_is_incorrect'),
            'item_code_end.gte' => __('validation.error_messages.range_is_incorrect'),
        ];
    }
}

