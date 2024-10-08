<?php

namespace App\Http\Requests\TrnShippingInspectionHeader;

use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class PickingListRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $date_time = ($this->filled(['date_year', 'date_month', 'date_day'])) ? $this->date_year . "-" . $this->date_month . "-" . $this->date_day : '';
        $this->merge([
            'date_time' => $date_time
        ]);
    }

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
        if ($this->has('preview')) {
            $rules = [
                'preview' => 'nullable',
                'date_time' => "required|after_or_equal:1900-01-01|before_or_equal:2100-01-01|date",
                'order_receive_number_start' => 'required|max_digits:8',
                'order_receive_number_end' => 'required|max_digits:8|gte:order_receive_number_start',
                'customer_start' => 'required|max_digits:6',
                'customer_end' => 'required|max_digits:6|gte:customer_start',
                'delivery_destination_start' => 'required|max_digits:6',
                'delivery_destination_end' => 'required|max_digits:6|gte:delivery_destination_start',
                'root_start' => 'required|max_digits:6',
                'root_end' => 'required|max_digits:6|gte:root_start',
            ];
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'date_time' => __('validation.attributes.common.date'),
            'order_receive_number_start' => __('validation.attributes.trn_order_receive_headers.order_receive_number'),
            'order_receive_number_end' => __('validation.attributes.trn_order_receive_headers.order_receive_number'),
            'customer_start' => __('validation.attributes.mt_customers.customer_cd'),
            'customer_end' => __('validation.attributes.mt_customers.customer_cd'),
            'delivery_destination_start' => __('validation.attributes.mt_delivery_destinations.delivery_destination_cd'),
            'delivery_destination_end' => __('validation.attributes.mt_delivery_destinations.delivery_destination_cd'),
            'root_start' => __('validation.attributes.mt_roots.root_cd'),
            'root_end' => __('validation.attributes.mt_roots.root_cd'),
        ];
    }
}
