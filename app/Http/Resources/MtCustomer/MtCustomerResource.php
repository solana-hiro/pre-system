<?php

namespace App\Http\Resources\MtCustomer;

use Illuminate\Http\Resources\Json\JsonResource;

class MtCustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
			"customer_cd" => $this->customer_cd,
			"mt_billing_address_id" => $this->mt_billing_address_id,
			"mt_order_receive_sticky_note_id" => $this->mt_order_receive_sticky_note_id,
			"customer_name" => $this->customer_name,
			"customer_name_kana" => $this->customer_name_kana,
			"honorific_kbn" => $this->honorific_kbn,
			"post_number" => $this->post_number,
			"address_1" => $this->address_1,
			"tel" => $this->tel,
			"fax" => $this->fax,
			"direct_delivery_slip_mailing_flg" => $this->direct_delivery_slip_mailing_flg,
			"def_district_class_id" => $this->def_district_class_id,
			"def_pioneer_year_id" => $this->def_pioneer_year_id,
			"mt_customer_class1_id" => $this->mt_customer_class1_id,
			"mt_customer_class2_id" => $this->mt_customer_class2_id,
			"mt_customer_class3_id" => $this->mt_customer_class3_id,
			"representative_name" => $this->representative_name,
			"representative_mail" => $this->representative_mail,
			"invoice_notification_mail_1" => $this->invoice_notification_mail_1,
			"invoice_notification_mail_2" => $this->invoice_notification_mail_2,
			"payment_guidance_mail" => $this->payment_guidance_mail,
			"payment_guidance_send_flg" => $this->payment_guidance_send_flg,
			"customer_url" => $this->customer_url,
			"delivery_price" => $this->delivery_price,
			"price_rate" => $this->price_rate,
			"mt_user_id" => $this->mt_user_id,
			"credit_limit_amount_check_flg" => $this->credit_limit_amount_check_flg,
			"name_input_kbn" => $this->name_input_kbn,
			"del_kbn" => $this->del_kbn,
			"tax_fare_rate_application" => $this->tax_fare_rate_application,
			"mt_warehouse_order_receive_id" => $this->mt_warehouse_order_receive_id,
			"payment_kbn" => $this->payment_kbn,
			"mt_root_id" => $this->mt_root_id,
			"mt_shipping_companie_id" => $this->mt_shipping_companie_id,
			"mt_slip_kind_sale_id" => $this->mt_slip_kind_sale_id,
			"def_arrival_date_id" => $this->def_arrival_date_id,
			"customer_memo_1" => $this->customer_memo_1,
			"customer_memo_2" => $this->customer_memo_2,
			"customer_memo_3" => $this->customer_memo_3,
			"customer_expansion_1" => $this->customer_expansion_1,
			"customer_expansion_2" => $this->customer_expansion_2,
			"customer_expansion_3" => $this->customer_expansion_3,
			"customer_expansion_4" => $this->customer_expansion_4,
			"customer_expansion_5" => $this->customer_expansion_5,
			"data_decision_date" => $this->data_decision_date,
			"mt_user_last_update_id" => $this->mt_user_last_update_id,
        ];
    }
}


