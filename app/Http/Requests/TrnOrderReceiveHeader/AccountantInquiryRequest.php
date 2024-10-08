<?php

namespace App\Http\Requests\TrnOrderReceiveHeader;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

/**
 * リクエストパラメータ
 */
class AccountantInquiryRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $start_date_time = ($this->filled(['start_date_y', 'start_date_m', 'start_date_d'])) ? $this->start_date_y . "-" . $this-> start_date_m . "-" . $this->start_date_d : '';
        $this->merge([
            'start_date_time' => $start_date_time
        ]);
        $end_date_time = ($this->filled(['end_date_y', 'end_date_m', 'end_date_d'])) ? $this->end_date_y . "-" . $this->end_date_m . "-" . $this->end_date_d : '';
        $this->merge([
            'end_date_time' => $end_date_time
        ]);
    }

    /**
     * jsonの形
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        /*
        if (!empty($this->all()['start_date_y']) && !empty($this->all()['start_date_m']) && !empty($this->all()['start_date_d'])
        ) {
            $this->startDate = Carbon::createFromFormat('Y-m-d', $this->all()['start_date_y'] . "-" . $this->all()['start_date_m'] . "-" . $this->all()['start_date_d']);
        }
        if (!empty($this->all()['end_date_y']) && !empty($this->all()['end_date_m']) && !empty($this->all()['end_date_d'])) {
            $this->endDate = Carbon::createFromFormat('Y-m-d', $this->all()['end_date_y'] . "-" . $this->all()['end_date_m'] . "-" . $this->all()['end_date_d']);
        }
        */
        $rules = array();
        if ($this->has('cancel')) {
            $rules = [
                'cancel' => 'nullable',
            ];
        } elseif ($this->has('redirect')) {
            $rules = [
                'redirect' => 'nullable',
            ];
        } elseif($this->has('search')) {
            $rules = [
                'excel' => 'nullable',
                'preview' => 'nullable',
                'settlement_method' => 'required',
                'end_date_time' => "nullable|after_or_equal:start_date_time",
                'customer_code' => 'nullable|digits:6',
                'item_code' => 'nullable',
                'customer_name_like' => 'nullable|max:60',
                'delivery_destination_name_like' => 'nullable|max:60',
                'complete_kbn' => 'required',
                'sort_order' => 'required',
                'rec_count' => 'nullable',
            ];
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'customer_code' => __('validation.attributes.mt_customers.customer_cd'),
            'item_code' => __('validation.attributes.mt_items.item_cd'),
            'customer_name_like' => __('validation.attributes.mt_customers.customer_name'),
            'delivery_destination_name_like' => __('validation.attributes.mt_delivery_destinations.delivery_destination_name'),
            'complete_kbn' => __('validation.attributes.trn_order_receive_details.order_receive_finish_flg'),
            'sort_order' => __('validation.attributes.mt_customers.customer_name'),
            'start_date_time' => __('validation.attributes.common.start_date'),
            'end_date_time' => __('validation.attributes.common.end_date'),
        ];
	}
}
