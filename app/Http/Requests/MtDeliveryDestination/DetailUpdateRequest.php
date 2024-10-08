<?php

namespace App\Http\Requests\MtDeliveryDestination;

use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class DetailUpdateRequest extends FormRequest
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
                'customer_cd' => 'required|digits:6|exists:mt_customers,customer_cd',
                // 'delivery_destination_cd' => 'required|digits:6|unique:mt_delivery_destinations,delivery_destination_id,' . $this->hidden_detail_id . ',id',
                'delivery_destination_cd' => 'required|digits:6',
                'delivery_destination_name' => 'required|max:60',
                'delivery_destination_name_kana' => 'nullable|max:10',
                'honorific_kbn' => 'required|in:1,2',
                'post_number' => 'nullable|between:6,8|regex:/^[0-9-]+$/',
                'address' => 'nullable|max:90',
                'tel' => 'nullable|max:15|regex:/^[0-9-]+$/',
                'fax' => 'nullable|max:15|regex:/^[0-9-]+$/',
                'representative_name' => 'nullable|max:30',
                'representative_mail' => 'nullable|max:256|email',
                'delivery_destination_manager_name' => 'nullable|max:30',
                'delivery_destination_manager_mail' => 'nullable|max:256|email',
                'delivery_destination_url' => 'nullable|max:2083',
                'name_input_kbn' => 'required|in:0, 1',
                'del_kbn_customer' => 'required|in:0, 1',
                'del_kbn_delivery_destination' => 'required|in:0, 1',
                'register_kind_flg' => 'required|in:0,1,2',
                'delivery_price' => 'nullable|regex:/^[0-9,]+$/',
                'mt_root_cd' => 'required|exists:mt_roots,root_cd',
                'mt_item_class1_cd' => 'required|exists:mt_item_classes,item_class_cd|numeric|between:800000,819999',
                'def_arrival_date_cd' => 'nullable|exists:def_arrival_dates,arrival_date_cd',
                'direct_delivery_commission_demand_flg' => 'required|in:1,2',
                'sale_decision_print_paper_flg' => 'required|in:1,2',
                'delivery_destination_memo_1' => 'nullable:max:30',
                'delivery_destination_memo_2' => 'nullable:max:30',
                'delivery_destination_memo_3' => 'nullable:max:30',
                'update' => 'nullable',
                'hidden_detail_id' => 'nullable',
            ];
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'customer_cd' => __('validation.attributes.mt_customers.customer_cd'),
            'delivery_destination_cd' => __('validation.attributes.mt_delivery_destinations.delivery_destination_id'),
            'delivery_destination_name' => __('validation.attributes.mt_delivery_destinations.delivery_destination_name'),
            'delivery_destination_name_kana' => __('validation.attributes.mt_delivery_destinations.delivery_destination_name_kana'),
            'honorific_kbn' => __('validation.attributes.mt_delivery_destinations.honorific_kbn'),
            'post_number' => __('validation.attributes.mt_delivery_destinations.post_number'),
            'address' => __('validation.attributes.mt_delivery_destinations.address'),
            'tel' => __('validation.attributes.mt_delivery_destinations.tel'),
            'fax' => __('validation.attributes.mt_delivery_destinations.fax'),
            'representative_name' => __('validation.attributes.mt_delivery_destinations.representative_name'),
            'representative_mail' => __('validation.attributes.mt_delivery_destinations.representative_mail'),
            'delivery_destination_manager_name' => __('validation.attributes.mt_delivery_destinations.delivery_destination_manager_name'),
            'delivery_destination_manager_mail' => __('validation.attributes.mt_delivery_destinations.delivery_destination_manager_mail'),
            'delivery_destination_url' => __('validation.attributes.mt_delivery_destinations.delivery_destination_url'),
            'name_input_kbn' => __('validation.attributes.mt_delivery_destinations.name_input_kbn'),
            'del_kbn_customer' => __('validation.attributes.mt_customer_delivery_destinations.del_kbn_customer'),
            'del_kbn_delivery_destination' => __('validation.attributes.mt_delivery_destinations.del_kbn_delivery_destination'),
            'register_kind_flg' => __('validation.attributes.mt_customer_delivery_destinations.register_kind_flg'),
            'delivery_price' => __('validation.attributes.mt_customers.delivery_price'),
            'mt_root_cd' => __('validation.attributes.mt_roots.root_cd'),
            'mt_item_class1_cd' => __('validation.attributes.mt_shipping_companies.shipping_company_cd'),
            'def_arrival_date_cd' => __('validation.attributes.def_arrival_dates.arrival_date_cd'),
            'direct_delivery_commission_demand_flg' => __('validation.attributes.mt_customer_delivery_destinations.direct_delivery_commission_demand_flg'),
            'sale_decision_print_paper_flg' => __('validation.attributes.mt_billing_addresses.sale_decision_print_paper_flg'),
            'delivery_destination_memo_1' => __('validation.attributes.mt_customer_delivery_destinations.delivery_destination_memo_1'),
            'delivery_destination_memo_2' => __('validation.attributes.mt_customer_delivery_destinations.delivery_destination_memo_2'),
            'delivery_destination_memo_3' => __('validation.attributes.mt_customer_delivery_destinations.delivery_destination_memo_3'),
        ];
    }
}
