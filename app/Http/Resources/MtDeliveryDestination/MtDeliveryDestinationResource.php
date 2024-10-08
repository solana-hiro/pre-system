<?php

namespace App\Http\Resources\MtDeliveryDestination;

use Illuminate\Http\Resources\Json\JsonResource;

class MtDeliveryDestinationResource extends JsonResource
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
            "delivery_destination_id" => $this->mt_delivery_destinations.delivery_destination_id,   //納品先マスタ.納品先コード
            "delivery_destination_name" => $this->mt_delivery_destinations.delivery_destination_name,  //納品先マスタ.納品先名
			"delivery_destination_name_kana" => $this->mt_delivery_destinations.delivery_destination_name_kana,	//納品先マスタ.納品先名カナ
			"customer_cd" => $this->mt_customers.customer_cd, //得意先マスタ.得意先コード
			"customer_name" => $this->mt_customers.customer_name,   //得意先マスタ.得意先名
			"honorific_kbn" => $this->mt_delivery_destinations.honorific_kbn, //納品先マスタ.敬称区分
			"post_number" => $this->mt_delivery_destinations.post_number, //納品先マスタ.郵便番号
			"address" => $this->mt_delivery_destinations.address, //納品先マスタ.住所
			"tel" => $this->mt_delivery_destinations.tel, //納品先マスタ.ＴＥＬ
			"fax" => $this->mt_delivery_destinations.fax, //納品先マスタ.ＦＡＸ
			"representative_name" => $this->mt_delivery_destinations.representative_name, //納品先マスタ.代表者名
			"representative_mail" => $this->mt_delivery_destinations.representative_mail, //納品先マスタ.代表者メール
			"delivery_destination_manager_name" => $this->mt_delivery_destinations.delivery_destination_manager_name, //納品先マスタ.納品先担当者名
			"delivery_destination_manager_mail" => $this->mt_delivery_destinations.delivery_destination_manager_mail, //納品先マスタ.納品先担当者メール
			"delivery_destination_url" => $this->mt_delivery_destinations.delivery_destination_url, //納品先マスタ.納品先ＵＲＬ
			"name_input_kbn" => $this->mt_delivery_destinations.name_input_kbn, //納品先マスタ.名称入力区分
			"del_kbn_customer" => $this->mt_customer_delivery_destinations.del_kbn_customer, //得意先別納品先マスタ.削除区分(得意先)
			"del_kbn_delivery_destination" => $this->mt_delivery_destinations.del_kbn_delivery_destination, //納品先マスタ.削除区分(納品先)
			"delivery_price" => $this->mt_delivery_destinations.delivery_price,  //納品先マスタ.館内配送料
			"root_cd" => $this->mt_roots.root_cd, //ルートマスタ.ルートコード
			"root_name" => $this->mt_roots.root_name, //ルートマスタ.ルート名
			"item_class_cd" => $this->mt_item_classes.item_class_cd,  //商品分類マスタ.商品分類コード
			"item_class_name" => $this->mt_item_classes.item_class_name, //商品分類マスタ.商品分類名
			"arrival_date_code" => $this->def_arrival_dates.arrival_date_code, //着日定義.着日コード
			"arrival_date_name" => $this->def_arrival_dates.arrival_date_name, //着日定義.着日名
			"direct_delivery_commission_demand_flg" => $this->mt_customer_delivery_destinations.direct_delivery_commission_demand_flg,  //得意先別納品先マスタ.直送手数料請求フラグ
			"sale_decision_print_paper_flg" => $this->mt_customer_delivery_destinations.sale_decision_print_paper_flg,  //得意先別納品先マスタ.売上確定時印刷用紙フラグ
			"delivery_destination_memo_1" => $this->mt_customer_delivery_destinations.delivery_destination_memo_1,	 //得意先別納品先マスタ.納品先備考１
			"delivery_destination_memo_2" => $this->mt_customer_delivery_destinations.delivery_destination_memo_2,	 //得意先別納品先マスタ.納品先備考２
			"delivery_destination_memo_3" => $this->mt_customer_delivery_destinations.delivery_destination_memo_3,	 //得意先別納品先マスタ.納品先備考３
			"ec_display_flg" => $this->mt_customer_delivery_destinations.ec_display_flg,					 //得意先別納品先マスタ.EC表示フラグ
        ];
    }
}
