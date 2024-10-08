<?php

namespace App\Http\Requests\MtCustomerOtherItemClassRate;

use App\Rules\PriceRateForItemClass;
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
                'item_classes.*.item_class_cd' => $this->getRuleOfItemClassCode(),
                'item_classes.*.rate' => 'nullable|numeric|min:0|max:100', // attributesに指定するために必要
                'item_classes.*' => [new PriceRateForItemClass], // 他のフィールドが必要なので配列丸ごと指定、対象はrateとstart.year。
                'item_classes.*.start.month' => 'nullable|digits:2',
                'item_classes.*.start.day' => 'nullable|digits:2',
                'item_classes.*.end.year' => $this->getRuleOfEndYear(),
                'item_classes.*.end.month' => 'nullable|digits:2',
                'item_classes.*.end.day' => 'nullable|digits:2',
            ];
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'customer_code' => __('validation.attributes.mt_customer_other_item_class_rates.customer_cd'),
            'item_classes.*.item_class_cd' => __('validation.attributes.mt_customer_other_item_class_rates.item_class_cd'),
            'item_classes.*.rate' => __('validation.attributes.mt_customer_other_item_class_rates.rate'),
            'item_classes.*.start.month' => __('validation.attributes.mt_customer_other_item_class_rates.start.month'),
            'item_classes.*.start.day' => __('validation.attributes.mt_customer_other_item_class_rates.start.day'),
            'item_classes.*.end.year' => __('validation.attributes.mt_customer_other_item_class_rates.end.year'),
            'item_classes.*.end.month' => __('validation.attributes.mt_customer_other_item_class_rates.end.month'),
            'item_classes.*.end.day' => __('validation.attributes.mt_customer_other_item_class_rates.end.day'),
        ];
    }

    private function getRuleOfItemClassCode()
    {
        return [
            'nullable',
            'exists:mt_item_classes,item_class_cd',
            'required_with:item_classes.*.rate',
            'required_with:item_classes.*.start.year',
            'required_with:item_classes.*.start.month',
            'required_with:item_classes.*.start.day',
            'required_with:item_classes.*.end.year',
            'required_with:item_classes.*.end.month',
            'required_with:item_classes.*.end.day',
        ];
    }

    private function getRuleOfEndYear()
    {
        return [
            'nullable',
            'digits:4',
            'required_with:item_classes.*.end.month',
            'required_with:item_classes.*.end.day',
        ];
    }
}
