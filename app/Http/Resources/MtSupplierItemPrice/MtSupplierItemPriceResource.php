<?php

namespace App\Http\Resources\MtSupplierItemPrice;

use Illuminate\Http\Resources\Json\JsonResource;

class MtSupplierItemPriceResource extends JsonResource
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
			'supplier_cd' => $this->mt_suppliers.supplier_cd,  //仕入先マスタ.仕入先コード
			'supplier_name' => $this->mt_suppliers.supplier_name,  //仕入先マスタ.仕入先名
			'item_cd' => $this->mt_items.item_cd,  //商品マスタ.商品コード
			'item_name' => $this->mt_items.item_name,  //商品マスタ.商品名
			'set_date' => $this->mt_supplier_item_prices.set_date,  //仕入先商品単価マスタ.設定日付
			'price' => $this->mt_supplier_item_prices.price,  //仕入先商品単価マスタ.単価
			'price' => $this->mt_supplier_item_prices.price,  //仕入先商品単価マスタ.単価
        ];
    }
}
