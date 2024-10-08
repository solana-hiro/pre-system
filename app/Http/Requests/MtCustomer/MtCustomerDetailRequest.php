<?php

namespace App\Http\Requests\MtCustomer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

/**
 * リクエストパラメータ
 */
class MtCustomerDetailRequest extends FormRequest
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
        if ($this->has('next')) {
            $rules = [
                'next' => 'nullable',
            ];
        }
        if ($this->has('prev')) {
            $rules = [
                'prev' => 'nullable',
            ];
        }
        if ($this->has('update')) {
            /**
             * 検証用の関数
             *   $attribute: 検証中の属性名
             *   $value    : 検証中の属性の値
             *   $fail     : 失敗時に呼び出すメソッド?
             **/
            $validate_func = function ($attribute, $value, $fail) {
                $input_data = $this->all();
                if (0 == $input_data['sequentially_kbn']) {
                    $error_msg = '回収月が「当月」の場合は回収日を締日より前に設定してください';
                    if ('closing_date_1' == $attribute && isset($input_data['collect_month_1']) && 0 == $input_data['collect_month_1'] && intval($input_data['closing_date_1']) > intval($input_data['collect_date_1'])) {
                        $fail($error_msg);
                    }
                    if ('closing_date_2' == $attribute && isset($input_data['collect_month_2']) && 0 == $input_data['collect_month_2'] && intval($input_data['closing_date_2']) > intval($input_data['collect_date_2'])) {
                        $fail($error_msg);
                    }
                    if ('closing_date_3' == $attribute && isset($input_data['collect_month_3']) && 0 == $input_data['collect_month_3'] && intval($input_data['closing_date_3']) > intval($input_data['collect_date_3'])) {
                        $fail($error_msg);
                    }
                }
            };

            $rules = [
                'customer_cd' => 'required|max_digits:6',
                'mt_billing_address_cd' => 'required|max_digits:6',
                'mt_order_receive_sticky_note_code' => 'nullable',
                'payment_kbn' => 'required',
                'manager_cd' => 'required|digits:4|exists:mt_users,user_cd',
                'honorific_kbn' => 'required|in:1,2',
                'post_number' => 'nullable|max:8|regex:/\A\d{3}[-]\d{4}\z/',
                'address' => 'nullable|max:90',
                'tel' => 'nullable|max:15|regex:/^[0-9-]+$/',
                'fax' => 'nullable|max:15|regex:/^[0-9-]+$/',
                'representative_name' => 'nullable|max:30',
                'representative_mail' => 'nullable|max:256|email',
                'customer_name' => 'required|max:60',
                'customer_name_kana' => 'nullable|max:10',
                'price_rate' => 'required|numeric|min:0|max:100',
                'credit_limit_amount' => 'nullable|regex:/^[0-9,]+$/',
                'credit_limit_amount_check_flg' => 'nullable',
                'customer_class_cd1' => 'required|exists:mt_customer_classes,customer_class_cd,def_customer_class_thing_id,1',
                'customer_class_cd2' => 'nullable|exists:mt_customer_classes,customer_class_cd,def_customer_class_thing_id,2',
                'customer_class_cd3' => 'nullable|exists:mt_customer_classes,customer_class_cd,def_customer_class_thing_id,3',
                'def_district_class_cd' => 'nullable|exists:def_district_classes,district_class_cd',
                'def_pioneer_year_cd' => 'nullable|exists:def_pioneer_years,pioneer_year_cd',
                'sequentially_kbn' => 'nullable',
                'closing_date_1' => ['required_if:sequentially_kbn,0', 'nullable', $validate_func],
                'closing_date_2' => ['nullable', $validate_func, 'required_with:collect_date_2'],
                'closing_date_3' => ['nullable', $validate_func, 'required_with:collect_date_3'],
                'collect_date_1' => 'required_if:sequentially_kbn,0',
                'collect_date_2' => 'nullable|required_with:closing_date_2',
                'collect_date_3' => 'nullable|required_with:closing_date_3',
                'collect_month_1' => 'required_if:sequentially_kbn,0',
                'collect_month_2' => 'nullable|required_with:closing_date_2,collect_date_2',
                'collect_month_3' => 'nullable|required_with:closing_date_3,collect_date_3',
                'invoice_notification_mail_1' => 'nullable|max:256|email',
                'invoice_notification_mail_2' => 'nullable|max:256|email',
                'payment_guidance_mail' => 'nullable|max:256|email',
                'payment_guidance_send_flg' => 'nullable',
                'customer_url' => 'nullable',
                'name_input_kbn' => 'required',
                'del_kbn' => 'required',
                'price_fraction_process' => 'required',
                'all_amount_fraction_process' => 'required',
                'tax_kbn' => 'required',
                'tax_fare_rate_application' => 'required',
                'tax_calculation_standard' => 'required',
                'tax_fraction_process_yen' => 'required',
                'tax_fraction_process' => 'required',
                'delivery_price' => 'nullable|regex:/^[0-9,]+$/',
                'warehouse_cd' => 'required|exists:mt_warehouses,warehouse_cd',
                // 'hidden_warehouse' => 'nullable',
                'root_cd' => 'required|exists:mt_roots,root_cd',
                'shipping_companie_cd' => 'required|exists:mt_item_classes,item_class_cd,def_item_class_thing_id,1|numeric|between:800000,819999',
                'arrival_date' => 'nullable|exists:def_arrival_dates,arrival_date_cd',
                'slip_kind_sale' => 'required|exists:mt_slip_kinds,slip_kind_cd,def_slip_kind_kbn_id,2',
                'invoice_kind_flg' => 'required',
                'direct_delivery_slip_mailing_flg' => 'required',
                'invoice_mailing_flg' => 'required',
                'sale_decision_print_paper_flg' => 'required',
                'customer_memo_1' => 'nullable',
                'customer_memo_2' => 'nullable',
                'customer_memo_3' => 'nullable',
                'customer_expansion_1' => 'nullable',
                'customer_expansion_2' => 'nullable',
                'customer_expansion_3' => 'nullable',
                'customer_expansion_4' => 'nullable',
                'customer_expansion_5' => 'nullable',
                'update' => 'nullable',
                'update_id' => 'nullable',
                'id.*' => 'nullable',
                'customer_manager_name.*' => 'nullable',
                'customer_manager_mail.*' => 'nullable|max:256|email',
                'ec_login_id.*' => 'nullable',
                'ec_login_password.*' => 'nullable',
                'validity_flg.*' => 'nullable',
                'display_order.*' => 'nullable',
            ];
            if (null != $this->get('manager_id')) {
                foreach ($this->get('manager_id') as $index => $id) {
                    $rules['ec_login_id.' . $index] = 'nullable|string|max:15|distinct|unique:mt_managers,ec_login_id,' . $id;
                    $rules['customer_manager_mail.' . $index] = 'nullable|string|distinct|unique:mt_managers,manager_mail,' . $id;
                }
            }
        }
        return $rules;
    }

    public function withValidator(\Illuminate\Contracts\Validation\Validator $validator)
    {
        if ($this->has('update')) {
            $validator->sometimes('collect_month_1_txt', 'required', function ($input) {
                return ($input->sequentially_kbn == 0 && $input->collect_month_1 == 3);
            });
            $validator->sometimes('collect_month_2_txt', 'required', function ($input) {
                return ($input->sequentially_kbn == 0 && $input->collect_month_2 == 3);
            });
            $validator->sometimes('collect_month_3_txt', 'required', function ($input) {
                return ($input->sequentially_kbn == 0 && $input->collect_month_3 == 3);
            });
        }
    }

    public function attributes()
    {
        return [
            'customer_cd' => __('validation.attributes.mt_customers.customer_cd'),
            'mt_billing_address_cd' => __('validation.attributes.mt_billing_addresses.billing_address_cd'),
            'mt_order_receive_sticky_note_code' => __('validation.attributes.mt_order_receive_sticky_notes.def_sticky_note_kind_id'),
            'payment_kbn' => __('validation.attributes.mt_customers.payment_kbn'),
            'manager_cd' => __('validation.attributes.mt_managers.manager_cd'),
            'honorific_kbn' => __('validation.attributes.mt_customers.honorific_kbn'),
            'post_number' => __('validation.attributes.mt_customers.post_number'),
            'address' => __('validation.attributes.mt_customers.address'),
            'tel' => __('validation.attributes.mt_customers.tel'),
            'fax' => __('validation.attributes.mt_customers.fax'),
            'representative_name' => __('validation.attributes.mt_customers.representative_name'),
            'representative_mail' => __('validation.attributes.mt_customers.representative_mail'),
            'customer_name' => __('validation.attributes.mt_customers.customer_name'),
            'customer_name_kana' => __('validation.attributes.mt_customers.customer_name_kana'),
            'price_rate' => __('validation.attributes.mt_customers.price_rate'),
            'customer_class_cd1' => __('validation.attributes.mt_customers.price_rate'),
            'delivery_price' => __('validation.attributes.mt_customers.delivery_price'),
            'warehouse_cd' => __('validation.attributes.mt_customers.mt_warehouse_order_receive_id'),
            'root_cd' => __('validation.attributes.mt_customers.mt_root_id'),
            'shipping_companie_cd' => __('validation.attributes.mt_customers.mt_item_class_shipping_companie_id'),
            'arrival_date' => __('validation.attributes.def_arrival_dates.arrival_date_cd'),
            'slip_kind_sale' => __('validation.attributes.mt_customers.mt_slip_kind_sale_id'),
            'def_district_class_cd' => __('validation.attributes.mt_customers.def_district_class_id'),
            'def_pioneer_year_cd' => __('validation.attributes.mt_customers.def_pioneer_year_id'),
            'customer_class_cd1' => __('validation.attributes.mt_customers.mt_customer_class1_id'),
            'customer_class_cd2' => __('validation.attributes.mt_customers.mt_customer_class2_id'),
            'customer_class_cd3' => __('validation.attributes.mt_customers.mt_customer_class3_id'),
            'customer_manager_mail.*' => __('validation.attributes.mt_managers.manager_mail'),
            'ec_login_id.*' => __('validation.attributes.mt_managers.ec_login_id'),
            'sequentially_kbn' => __('validation.attributes.mt_billing_addresses.sequentially_kbn'),
            'closing_date_1' => __('validation.attributes.mt_billing_addresses.closing_date_1'),
            'closing_date_2' => __('validation.attributes.mt_billing_addresses.closing_date_2'),
            'closing_date_3' => __('validation.attributes.mt_billing_addresses.closing_date_3'),
            'collect_month_1' => __('validation.attributes.mt_billing_addresses.collect_month_1'),
            'collect_month_2' => __('validation.attributes.mt_billing_addresses.collect_month_2'),
            'collect_month_3' => __('validation.attributes.mt_billing_addresses.collect_month_3'),
            'collect_date_1' => __('validation.attributes.mt_billing_addresses.collect_date_1'),
            'collect_date_2' => __('validation.attributes.mt_billing_addresses.collect_date_2'),
            'collect_date_3' => __('validation.attributes.mt_billing_addresses.collect_date_3'),
            'credit_limit_amount' => __('validation.attributes.mt_billing_addresses.credit_limit_amount'),
            'collect_month_1_txt' => '締日1の回収月 ',
            'collect_month_2_txt' => '締日2の回収月',
            'collect_month_3_txt' => '締日3の回収月',
        ];
    }

    /**
     * エラーメッセージ
     *
     * @return array
     */
    public function messages()
    {
        return [
            'collect_month_1_txt.required_if' => ':attributeは必須項目です。',
            'collect_month_2_txt.required_if' => ':attributeは必須項目です。',
            'collect_month_3_txt.required_if' => ':attributeは必須項目です。',
            'closing_date_1.required_if' => '随時区分が「通常」の場合は:attributeは必須項目です。',
            'collect_date_1.required_if' => '随時区分が「通常」の場合は:attributeは必須項目です。',
            'collect_month_1.required_if' => '随時区分が「通常」の場合は:attributeは必須項目です。',
        ];
    }
}
