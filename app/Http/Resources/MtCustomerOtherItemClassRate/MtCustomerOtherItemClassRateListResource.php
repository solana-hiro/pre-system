<?php

namespace App\Http\Resources\MtCustomerOtherItemClassRate;

use Illuminate\Http\Resources\Json\JsonResource;

class MtCustomerOtherItemClassRateListResource extends JsonResource
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
			'customer_name' => $this->mt_customers.customer_name,  //得意先マスタ.得意先マスタＩＤ
			'item_class_cd' => $this->mt_item_classes.item_class_cd,  //商品分類マスタ.商品分類マスタＩＤ
			'item_class_name' => $this->mt_item_classes.item_class_name,  //商品分類マスタ.商品分類マスタＩＤ
			'rate' => $this->mt_customer_other_item_class_rates.rate,  //得意先別商品分類掛率マスタ.掛率
			'start_date' => $this->mt_customer_other_item_class_rates.start_date,  //得意先別商品分類掛率マスタ.開始日付
			'end_date' => $this->mt_customer_other_item_class_rates.end_date,  //得意先別商品分類掛率マスタ.終了日付
			'old_rate' => $this->mt_customer_other_item_class_rates.old_rate,  //得意先別商品分類掛率マスタ.旧掛率
			'old_start_date' => $this->mt_customer_other_item_class_rates.old_start_date,  //得意先別商品分類掛率マスタ.旧開始日付
			'old_end_date' => $this->mt_customer_other_item_class_rates.old_end_date,  //得意先別商品分類掛率マスタ.旧終了日付
        ];
    }
}

