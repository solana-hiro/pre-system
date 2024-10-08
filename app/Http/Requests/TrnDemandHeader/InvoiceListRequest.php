<?php

namespace App\Http\Requests\TrnDemandHeader;

use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class InvoiceListRequest extends FormRequest
{
    /**
     * jsonの形
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if ($this->has('cancel')) {
            $rules = [
                'cancel' => 'nullable',
            ];
        }
        if ($this->has('preview') || $this->has('excel')) {
            return [
                'cancel' => 'nullable',
                'excel' => 'nullable',
                'year' => 'required',
                'month' => 'request',
                'day' => 'request',
                'sort_order' => 'nullable',
                'billing_address_start' => 'required|max:6',
                'billing_address_end' => 'required|max:6|gte:billing_address_start',
                'department_code_start' => 'required|max:4',
                'department_code_end' => 'required|max:4|gte:department_code_start',
                'manager_code_start' => 'required|max:4',
                'manager_code_end' => 'required|max:4|gte:manager_code_start',
            ];
        }
    }

    public function attributes()
    {
        return [
            'billing_address_start' => 'validation.attributes.mt_billing_addresses.billing_address_cd',
            'billing_address_end' => 'validation.attributes.mt_billing_addresses.billing_address_cd',
            'department_code_start' => 'validation.attributes.def_departments.department_cd',
            'department_code_end' => 'validation.attributes.def_departments.department_cd',
            'manager_code_start' => 'validation.attributes.def_departments.manager_cd',
            'manager_code_end' => 'validation.attributes.def_departments.manager_cd',
        ];
	}

    public function messages()
    {
        return [
            'billing_address_end.gte' => __('validation.error_messages.range_is_incorrect'),
            'department_code_end.gte' => __('validation.error_messages.range_is_incorrect'),
            'manager_code_end.gte' => __('validation.error_messages.range_is_incorrect'),
        ];
    }
}
