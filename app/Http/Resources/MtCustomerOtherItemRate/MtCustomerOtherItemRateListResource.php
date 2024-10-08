<?php

namespace App\Http\Resources\MtCustomerOtherItemRate;

use Illuminate\Http\Resources\Json\JsonResource;

class MtCustomerOtherItemRateListResource extends JsonResource
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
			'customer_cd' => $this->mt_customers.customer_cd,  //得意先マスタ.得意先マスタＩＤ
			'mt_billing_address_id' => $this->mt_customers.mt_billing_address_id,  //得意先マスタ.得意先マスタＩＤ
			'item_cd' => $this->mt_items.item_cd,  //商品マスタ.商品マスタＩＤ
			'item_name' => $this->mt_items.item_name,  //商品マスタ.商品マスタＩＤ
			'rate' => $this->mt_customer_other_item_rates.rate,  //得意先別商品掛率マスタ.掛率
			'start_date' => $this->mt_customer_other_item_rates.start_date,  //得意先別商品掛率マスタ.開始日付
			'end_date' => $this->mt_customer_other_item_rates.end_date,  //得意先別商品掛率マスタ.終了日付
			'old_rate' => $this->mt_customer_other_item_rates.old_rate,  //得意先別商品掛率マスタ.旧掛率
			'old_start_date' => $this->mt_customer_other_item_rates.old_start_date,  //得意先別商品掛率マスタ.旧開始日付
			'old_end_date' => $this->mt_customer_other_item_rates.old_end_date,  //得意先別商品掛率マスタ.旧終了日付
        ];
    }
}

