<?php

namespace App\Http\Requests\TrnOrderReceiveHeader;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

/**
 * リクエストパラメータ
 */
class AccountantRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $order_receive_date = ($this->filled(['order_date_year', 'order_date_month', 'order_date_day'])) ? $this->order_date_year . "-" . $this-> order_date_month . "-" . $this->order_date_day : '';
        $keep_guidance_expiration_flg = $this->input('keep_guidance_expiration_flg', 0);
        $payment_kbn = $this->input('payment_kbn', 0);
        $payment_guidance_kbn = $this->input('payment_guidance_kbn', 0);
        $payment_guidance_flg = $this->input('payment_guidance_flg', 0);
        $shortage_guidance_flg = $this->input('shortage_guidance_flg', 0);
        $shipping_guidance_flg = $this->input('shipping_guidance_flg', 0);
        $keep_guidance_target_flg = $this->input('keep_guidance_target_flg', 0);
        $keep_guidance_flg = $this->input('keep_guidance_flg', 0);
        $this->merge([
            'order_receive_date' => $order_receive_date,
            'keep_guidance_expiration_flg' => $keep_guidance_expiration_flg,
            'payment_kbn' => $payment_kbn,
            'payment_guidance_kbn' => $payment_guidance_kbn,
            'payment_guidance_flg' => $payment_guidance_flg,
            'shortage_guidance_flg' => $shortage_guidance_flg,
            'shipping_guidance_flg' => $shipping_guidance_flg,
            'keep_guidance_target_flg' => $keep_guidance_target_flg,
            'keep_guidance_flg' => $keep_guidance_flg,
        ]);

        // shortage_flgの値をonの場合は1に、それ以外は0に変換
        $details = $this->input('details', []);
        foreach ($details as $key => $detail) {
            $details[$key]['shortage_flg'] = (isset($detail['shortage_flg']) && $detail['shortage_flg'] == 'on') ? 1 : 0;
            $details[$key]['remaining_flg'] = (isset($detail['remaining_flg']) && $detail['remaining_flg'] == 'on') ? 1 : 0;
            $details[$key]['payment_finish_flg'] = (isset($detail['payment_finish_flg']) && $detail['payment_finish_flg'] == 'on') ? 1 : 0;
            $details[$key]['specify_deadline_none_flg'] = (isset($detail['specify_deadline_none_flg']) && $detail['specify_deadline_none_flg'] == 'on') ? 1 : 0;
            if (!empty($detail['release_start_datetime_year']) && !empty($detail['release_start_datetime_month']) && !empty($detail['release_start_datetime_day'])) {
                $details[$key]['specify_deadline'] = $detail['release_start_datetime_year'] . '-' . str_pad($detail['release_start_datetime_month'], 2, '0', STR_PAD_LEFT) . '-' . str_pad($detail['release_start_datetime_day'], 2, '0', STR_PAD_LEFT);
            } else {
                $details[$key]['specify_deadline'] = null; // 日付が足りない場合は null に設定
            }
        }
        $this->merge([
            'details' => $details,
        ]);
    }

    /**
     * jsonの形
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = array();
        if ($this->has('create')) {
            $rules = [
                'register' => 'nullable',
                'order_receive_number' => 'required | max:8',
                'order_receive_date' => 'nullable',
                'user_cd' => 'nullable',
                'ec_order_receive_number' => 'nullable',
                'mt_order_receive_sticky_note_id' => 'required',
                'mt_customer_id' => 'required',
                'mt_user_manager_id' => 'required',
                'mt_delivery_destination_id' => 'required',
                'order_number' => 'nullable | max:15',
                'mt_warehouse_id' => 'nullable',
                'payment_kbn' => 'required',
                'payment_guidance_kbn' => 'required',
                'payment_guidance_flg' => 'required',
                'shortage_guidance_flg' => 'required',
                'shipping_guidance_flg' => 'required',
                'keep_guidance_target_flg' => 'required',
                'keep_guidance_expiration_flg' => 'required',
                'keep_guidance_flg' => 'required',
                'process_kbn' => 'required',
                'slip_memo' => 'nullable | max:40',
                'customer_order_number' => 'nullable | max:30',
                'separate_mail' => 'nullable | max:30',
                'shipping_document_description_need_column' => 'nullable | max:30',
                'business_memo' => 'nullable | max:80',
                'details' => 'required | array',
                'details.*.order_receive_detail_cd' => 'required | max:3',
                'details.*.price_rate' => 'nullable | max:100',
                'details.*.retail_price' => 'nullable',
                'details.*.order_receive_price' => 'nullable',
                'details.*.order_receive_amount' => 'nullable',
                'details.*.specify_deadline' => 'nullable',
                'details.*.specify_deadline_none_flg' => 'required',
                'details.*.memo_1' => 'nullable | max:10',
                'details.*.memo_2' => 'nullable | max:10',
                'details.*.shortage_flg' => 'required',
                'details.*.remaining_flg' => 'required',
                'details.*.payment_finish_flg' => 'required',
                'details.*.item_name' => 'nullable | max:40',
                'details.*.order_receive_quantity' => 'required',
                'details.*.cost_price' => 'required',
                'details.*.cost_amount' => 'required',
            ];
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'order_receive_number' => __('validation.attributes.trn_order_receive_headers.order_receive_number'),
            'order_receive_date' => __('validation.attributes.trn_order_receive_headers.order_receive_date'),
            'mt_user_input_id' => __('validation.attributes.trn_order_receive_headers.mt_user_input_id'),
            'ec_order_receive_number' => __('validation.attributes.trn_order_receive_headers.ec_order_receive_number'),
            'mt_order_receive_sticky_note_id' => __('validation.attributes.trn_order_receive_headers.mt_order_receive_sticky_note_id'),
            'mt_customer_id' => __('validation.attributes.trn_order_receive_headers.mt_customer_id'),
            'mt_user_manager_id' => __('validation.attributes.trn_order_receive_headers.mt_user_manager_id'),
            'mt_delivery_destination_id' => __('validation.attributes.trn_order_receive_headers.mt_delivery_destination_id'),
            'order_number' => __('validation.attributes.trn_order_receive_headers.order_number'),
            'mt_warehouse_id' => __('validation.attributes.trn_order_receive_headers.mt_warehouse_id'),
            'payment_kbn' => __('validation.attributes.trn_order_receive_headers.payment_kbn'),
            'payment_guidance_kbn' => __('validation.attributes.trn_order_receive_headers.payment_guidance_kbn'),
            'payment_guidance_flg' => __('validation.attributes.trn_order_receive_headers.payment_guidance_flg'),
            'shortage_guidance_flg' => __('validation.attributes.trn_order_receive_headers.shortage_guidance_flg'),
            'shipping_guidance_flg' => __('validation.attributes.trn_order_receive_headers.shipping_guidance_flg'),
            'keep_guidance_target_flg' => __('validation.attributes.trn_order_receive_headers.keep_guidance_target_flg'),
            'keep_guidance_expiration_flg' => __('validation.attributes.trn_order_receive_headers.keep_guidance_expiration_flg'),
            'keep_guidance_flg' => __('validation.attributes.trn_order_receive_headers.keep_guidance_flg'),
            'process_kbn' => __('validation.attributes.trn_order_receive_headers.process_kbn'),
            'slip_memo' => __('validation.attributes.trn_order_receive_headers.slip_memo'),
            'customer_order_number' => __('validation.attributes.trn_order_receive_headers.customer_order_number'),
            'separate_mail' => __('validation.attributes.trn_order_receive_headers.separate_mail'),
            'shipping_document_description_need_column' => __('validation.attributes.trn_order_receive_headers.shipping_document_description_need_column'),
            'business_memo' => __('validation.attributes.trn_order_receive_headers.business_memo'),
            'details' => __('validation.attributes.trn_order_receive_details'),
            'details.*.order_receive_detail_cd' => __('validation.attributes.trn_order_receive_details.order_receive_detail_cd'),
            'details.*.price_rate' => __('validation.attributes.trn_order_receive_details.price_rate'),
            'details.*.retail_price' => __('validation.attributes.trn_order_receive_details.retail_price'),
            'details.*.order_receive_price' => __('validation.attributes.trn_order_receive_details.order_receive_price'),
            'details.*.order_receive_amount' => __('validation.attributes.trn_order_receive_details.order_receive_amount'),
            'details.*.specify_deadline' => __('validation.attributes.trn_order_receive_details.specify_deadline'),
            'details.*.specify_deadline_none_flg' => __('validation.attributes.trn_order_receive_details.specify_deadline_none_flg'),
            'details.*.memo_1' => __('validation.attributes.trn_order_receive_details.memo_1'),
            'details.*.memo_2' => __('validation.attributes.trn_order_receive_details.memo_2'),
            'details.*.shortage_flg' => __('validation.attributes.trn_order_receive_details.shortage_flg'),
            'details.*.remaining_flg' => __('validation.attributes.trn_order_receive_details.remaining_flg'),
            'details.*.payment_finish_flg' => __('validation.attributes.trn_order_receive_details.payment_finish_flg'),
            'details.*.item_name' => __('validation.attributes.trn_order_receive_details.item_name'),
            'details.*.order_receive_quantity' => __('validation.attributes.trn_order_receive_details.order_receive_quantity'),
            'details.*.cost_price' => __('validation.attributes.trn_order_receive_details.cost_price'),
            'details.*.cost_amount' => __('validation.attributes.trn_order_receive_details.cost_amount'),
        ];
    }
}
