<?php

namespace App\Http\Requests\MtCustomerOtherItemRate;

use App\Rules\PriceRateForItem;
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
        if ($this->has('update')) {
            $rules = [
                'customer_code' => 'nullable|exists:mt_customers,customer_cd',
                'items.*.item_cd' => $this->getRuleOfItemCode(),
                'items.*.rate' => 'nullable|numeric|min:0|max:100', // attributesに指定するために必要
                'items.*' => [new PriceRateForItem], // 他のフィールドが必要なので配列丸ごと指定、対象はrateとstart.year。
                'items.*.start.month' => 'nullable|digits:2',
                'items.*.start.day' => 'nullable|digits:2',
                'items.*.end.year' => $this->getRuleOfEndYear(),
                'items.*.end.month' => 'nullable|digits:2',
                'items.*.end.day' => 'nullable|digits:2',
            ];
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'customer_code' => __('validation.attributes.mt_customer_other_item_rates.customer_cd'),
            'items.*.item_cd' => __('validation.attributes.mt_customer_other_item_rates.item_cd'),
            'items.*.rate' => __('validation.attributes.mt_customer_other_item_rates.rate'),
            'items.*.start.month' => __('validation.attributes.mt_customer_other_item_rates.start.month'),
            'items.*.start.day' => __('validation.attributes.mt_customer_other_item_rates.start.day'),
            'items.*.end.year' => __('validation.attributes.mt_customer_other_item_rates.end.year'),
            'items.*.end.month' => __('validation.attributes.mt_customer_other_item_rates.end.month'),
            'items.*.end.day' => __('validation.attributes.mt_customer_other_item_rates.end.day'),
        ];
    }

    private function getRuleOfItemCode()
    {
        return [
            'nullable',
            'exists:mt_items,item_cd',
            'required_with:items.*.rate',
            'required_with:items.*.start.year',
            'required_with:items.*.start.month',
            'required_with:items.*.start.day',
            'required_with:items.*.end.year',
            'required_with:items.*.end.month',
            'required_with:items.*.end.day',
        ];
    }

    private function getRuleOfEndYear()
    {
        return [
            'nullable',
            'digits:4',
            'required_with:items.*.end.month',
            'required_with:items.*.end.day',
        ];
    }
}
