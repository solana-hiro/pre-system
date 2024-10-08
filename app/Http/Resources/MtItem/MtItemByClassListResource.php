<?php

namespace App\Http\Resources\MtItem;

use Illuminate\Http\Resources\Json\JsonResource;

class MtItemByClassListResource extends JsonResource
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
			'item_class_cd' => $this->mt_item_classes.item_class_cd,  //商品分類マスタ.商品分類コード
			'item_class_name' => $this->mt_item_classes.item_class_name,  //商品分類マスタ.商品分類名
			'item_cd' => $this->mt_items.item_cd,  //商品マスタ.商品コード
			'item_name' => $this->mt_items.item_name,  //商品マスタ.商品名
			'unit' => $this->mt_items.unit,  //商品マスタ.単位
			'retail_price_tax_out' => $this->mt_items.retail_price_tax_out,  //商品マスタ.上代単価：税抜
			'retail_price_tax_in' => $this->mt_items.retail_price_tax_in,  //商品マスタ.上代単価：税込
			'purchase_price_tax_out' => $this->mt_items.purchase_price_tax_out,  //商品マスタ.仕入単価：税抜
			'purchase_price_tax_in' => $this->mt_items.purchase_price_tax_in,  //商品マスタ.仕入単価：税込
			'cost_price' => $this->mt_items.cost_price,  //商品マスタ.原価単価
        ];
    }
}

