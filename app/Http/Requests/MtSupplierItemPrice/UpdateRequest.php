<?php

namespace App\Http\Requests\MtSupplierItemPrice;

use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class UpdateRequest extends FormRequest
{
    /**
     * jsonの形
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $rules = array();
        if ($this->has('cancel')) {
            $rules = [
                'cancel' => 'nullable',
            ];
        }
        if ($this->has('delete')) {
            $rules = [
                'delete' => 'nullable',
            ];
        }
        if ($this->has('update')) {
            $rules = [
                'supplier_code' => 'required|digits:6|exists:mt_suppliers,supplier_cd',
                'items.*.item_cd' => $this->getRuleOfItemCode(),
                'items.*.year' => $this->getRuleOfYear(),
                'items.*.month' => $this->getRuleOfMonth(),
                'items.*.day' => $this->getRuleOfDay(),
                'items.*.price' => $this->getRuleOfPrice(),
            ];
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'supplier_code' => __('validation.attributes.mt_supplier_item_prices.supplier_cd'),
            'items.*.item_cd' => __('validation.attributes.mt_supplier_item_prices.item_cd'),
            'items.*.year' => __('validation.attributes.mt_supplier_item_prices.set_date_y'),
            'items.*.month' => __('validation.attributes.mt_supplier_item_prices.set_date_m'),
            'items.*.day' => __('validation.attributes.mt_supplier_item_prices.set_date_d'),
            'items.*.price' => __('validation.attributes.mt_supplier_item_prices.price'),
        ];
    }

    private function getRuleOfItemCode()
    {
        return [
            'nullable',
            'required_with:items.*.year',
            'required_with:items.*.month',
            'required_with:items.*.day',
            'required_with:items.*.price',
            'max:9',
            'exists:mt_items,item_cd',
        ];
    }

    private function getRuleOfYear()
    {
        return [
            'nullable',
            'required_with:items.*.item_cd',
            'required_with:items.*.month',
            'required_with:items.*.day',
            'required_with:items.*.price',
            'digits:4',
        ];
    }
    private function getRuleOfMonth()
    {
        return [
            'nullable',
            'required_with:items.*.item_cd',
            'required_with:items.*.year',
            'required_with:items.*.day',
            'required_with:items.*.price',
            'digits:2',
        ];
    }
    private function getRuleOfDay()
    {
        return [
            'nullable',
            'required_with:items.*.item_cd',
            'required_with:items.*.year',
            'required_with:items.*.month',
            'required_with:items.*.price',
            'digits:2',
        ];
    }
    private function getRuleOfPrice()
    {
        return [
            'nullable',
            'required_with:items.*.item_cd',
            'required_with:items.*.year',
            'required_with:items.*.month',
            'required_with:items.*.day',
            'regex:/^(0|[1-9]\d{0,11})(\.\d|)$/',
        ];
    }
}
